<?php

namespace App\Http\Controllers\Packages;

use App\Http\Controllers\Controller;
use App\Http\Requests\Packages\IndexPackageRequest;
use App\Http\Requests\Packages\StorePackageRequest;
use App\Http\Requests\Packages\UpdatePackageImageRequest;
use App\Http\Requests\Packages\UpdatePackageRequest;
use App\Models\CourseModule;
use App\Models\Package;
use App\Models\PackageType;
use App\Traits\Base64Codable;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Throwable;

class PackageController extends Controller
{
    /**
     * Display a permission listing of packages.
     *
     * @return void
     */
    function __construct()
    {
        $this->middleware('permission:package-list', ['only' => ['index']]);
        $this->middleware('permission:package-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:package-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:package-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     */
    public function index(IndexPackageRequest $request): Factory|View|Application
    {
        $searchQuery = $request->get(key: 'search_query');
        $status = $request->get(key: 'status');

        $packageTypes = PackageType::query()
            ->where(column: 'status', operator: '=', value: 1)
            ->orderBy(column: 'id', direction: 'ASC')
            ->get();

        $packageQuery = Package::query();

        if ($searchQuery) {
            $packageQuery->where(column: 'name', operator: 'LIKE', value: "%{$searchQuery}%");
        }

        if ($status !== null) {
            $packageQuery->where(column: 'status', operator: '=', value: $status);
        }

        $packageQuery->with(['media'])
            ->orderBy(column: 'id', direction: 'ASC');

        $packages = $packageQuery->paginate(perPage: 20)->withQueryString();

        return view(view: 'backEnd.pages.packages.index')->with([
            'packages' => $packages,
            'packageTypes' => $packageTypes,
        ]);
    }

    /**
     * Show the form for creating a new package.
     *
     */
    public function create(): Factory|View|Application
    {
        $courseModules = CourseModule::query()
            ->where(column: 'status', operator: '=', value: 1)
            ->orderBy(column: 'id', direction: 'ASC')
            ->get();

        return view(view: 'backEnd.pages.packages.create')->with([
            'courseModules' => $courseModules
        ]);
    }

    /**
     * Store a newly created package in storage.
     *
     */
    public function store(StorePackageRequest $request): RedirectResponse
    {
        $validatedInput = $request->safe();
        $validatedPackageInput = $validatedInput->except(['package_type', 'course_module_id']);
        $validatedPackageType = $validatedInput->only('package_type');

        $courseModules = $request->safe()->only('course_module_id');

        try {

            DB::beginTransaction();

            $package = Package::query()->create($validatedPackageInput);
            if ($package->id && array_key_exists('package_type', $validatedPackageType)) {
                $validatedPackageType = $validatedPackageType['package_type'];

                $validatedPackageType = array_map(callback: function ($packageType) use ($package) {
                    $packageType['package_id'] = $package->id;
                    $packageType['created_at'] = date('Y-m-d H:i:s', time());
                    $packageType['updated_at'] = date('Y-m-d H:i:s', time());

                    return $packageType;
                }, array: $validatedPackageType);

                PackageType::query()->insert($validatedPackageType);

                $package->courseModules()->sync($courseModules['course_module_id']);
            }

            DB::commit();


            $message = [
                'status' => 'success',
                'info' => 'Package created successfully.',
            ];

            return redirect()->route(route: 'packages.index')->with([
                'message' => $message,
            ]);

        } catch (Throwable $exception) {

            DB::rollBack();

            $message = [
                'status' => 'error',
                'info' => 'Something is wrong.',
                'exception' => [
                    'message' => $exception->getMessage(),
                    'status' => $exception->getCode(),
                    'line' => $exception->getLine(),
                ],
            ];

            return redirect()->back()->with([
                'message' => $message,
            ]);
        }
    }

    /**
     * Display the specified package.
     *
     */
    public function show(Package $package): Factory|View|Application
    {
        $package->load(relations: ['packageTypes', 'media']);
        return view(view: 'backEnd.pages.packages.show')->with([
            'package' => $package
        ]);
    }

    /**
     * Show the form for editing the specified package.
     *
     */
    public function edit(Request $request, Package $package): Factory|View|Application
    {
        $package->load(relations: ['packageTypes', 'courseModules']);
        $redirectRoute = $request->get('redirect_route');
        $courseModules = CourseModule::query()->select('id', 'name')->where(column: 'status', operator: '=', value: 1)->get();
        return view(view: 'backEnd.pages.packages.edit')->with([
            'package' => $package,
            'redirectRoute' => $redirectRoute,
            'courseModules' => $courseModules
        ]);
    }

    /**
     * Update the specified package in storage.
     *
     */
    public function update(UpdatePackageRequest $request, Package $package): Redirector|RedirectResponse|Application
    {
        $validatedInput = $request->safe();
        $validatedPackageInput = $validatedInput->except(['package_type', 'course_module_id']);
        $validatedPackageType = $validatedInput->only('package_type');

        $validatedCourseModuleId = $validatedInput->only('course_module_id');

        $redirectRoute = $request->safe()->only(keys: 'redirect_route');

        $redirectRoute = array_key_exists('redirect_route', $redirectRoute) ? $redirectRoute['redirect_route'] : null;

        try {
            DB::beginTransaction();

            $package->update($validatedPackageInput);

            $package->packageTypes()->delete();

            foreach ($validatedPackageType['package_type'] as $packageType) {
                $package->packageTypes()->create($packageType);
            }

            if (array_key_exists('course_module_id', $validatedCourseModuleId) && !empty($validatedCourseModuleId['course_module_id'])) {
                $package->courseModules()->sync($validatedCourseModuleId['course_module_id']);
            }

            DB::commit();

            $message = [
                'status' => 'success',
                'info' => 'Package update successfully.',
            ];
            if ($redirectRoute) {
                return redirect($redirectRoute)->with(['message' => $message]);
            } else {
                return redirect()->route(route: 'packages.index')->with(['message' => $message]);
            }


        } catch (Throwable $exception) {
            $message = [
                'status' => 'error',
                'info' => 'Something is wrong.',
                'exception' => [
                    'message' => $exception->getMessage(),
                    'status' => $exception->getCode(),
                    'line' => $exception->getLine(),
                ],
            ];

            if ($redirectRoute) {
                return redirect($redirectRoute)->with(['message' => $message]);
            } else {
                return redirect()->route(route: 'packages.index')->with(['message' => $message]);
            }
        }
    }

    /**
     * Remove the specified package from storage.
     *
     */
    public function destroy(Package $package)
    {
        try {
            DB::beginTransaction();

            $package->packageTypes()->delete();

            $package->courseModules()->detach();

            $package->delete();

            DB::commit();

            $message = [
                'status' => 'success',
                'info' => 'Package deleted successfully.',
            ];

            return redirect()->route(route: 'packages.index')->with([
                'message' => $message,
            ]);

        } catch (Throwable $exception) {
            DB::rollBack();

            $message = [
                'status' => 'error',
                'info' => 'Something is wrong.',
                'exception' => [
                    'message' => $exception->getMessage(),
                    'status' => $exception->getCode(),
                    'line' => $exception->getLine(),
                ],
            ];

            return redirect()->back()->with([
                'message' => $message,
            ]);
        }
    }

    /**
     * Update a particular packages image.
     */
    public function updateImage(UpdatePackageImageRequest $request, Package $package): Redirector|RedirectResponse|Application
    {
        $image = $request->input(key: 'image');
        $redirectRoute = $request->input(key: 'redirect_route');

        try {

            DB::beginTransaction();

            $packageId = $package->id;
            $time = time();
            $fileExtension = Base64Codable::base64DataFileExtension(base64Data: $image);

            $name = "package-image-{$packageId}";
            $fileName = "{$name}-{$time}.$fileExtension";

            $package->addMediaFromBase64(base64data: $image)
                ->usingName(name: $name)
                ->usingFileName(fileName: $fileName)
                ->toMediaCollection(collectionName: 'package-image');
            DB::commit();

            $message = [
                'status' => 'success',
                'info' => 'Package image update successfully.',
            ];

            if ($redirectRoute) {
                return redirect($redirectRoute)->with(['message' => $message]);
            } else {
                return redirect()->route(route: 'packages.index')->with(['message' => $message]);
            }

        } catch (Throwable $exception) {
            DB::rollBack();

            $message = [
                'status' => 'error',
                'info' => 'Something is wrong.',
                'exception' => [
                    'message' => $exception->getMessage(),
                    'status' => $exception->getCode(),
                    'line' => $exception->getLine(),
                ],
            ];

            if ($redirectRoute) {
                return redirect($redirectRoute)->with(['message' => $message]);
            } else {
                return redirect()->route(route: 'packages.index')->with(['message' => $message]);
            }
        }
    }

    /**
     * Update a specific package status from storage.
     *
     */
    public function updateStatus(Request $request, Package $package): Redirector|RedirectResponse|Application
    {
        $redirectRoute = $request->get(key: 'redirect_route');

        try {

            DB::beginTransaction();

            if ($package->status == 1) {
                $status = 0;
            } else {
                $status = 1;
            }

            $package->status = $status;

            $package->save();

            DB::commit();

            $message = [
                'status' => 'success',
                'info' => 'package status update successfully.',
            ];

            if ($redirectRoute) {
                return redirect($redirectRoute)->with(['message' => $message]);
            } else {
                return redirect()->route(route: 'packages.index')->with(['message' => $message]);
            }

        } catch (Throwable $exception) {
            DB::rollBack();

            $message = [
                'status' => 'error',
                'info' => 'Something is wrong.',
                'exception' => [
                    'message' => $exception->getMessage(),
                    'status' => $exception->getCode(),
                    'line' => $exception->getLine(),
                ],
            ];

            if ($redirectRoute) {
                return redirect($redirectRoute)->with(['message' => $message]);
            } else {
                return redirect()->route(route: 'packages.index')->with(['message' => $message]);
            }
        }
    }
}

