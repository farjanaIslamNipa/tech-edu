<?php

namespace App\Http\Controllers\CourseModules;

use App\Http\Controllers\Controller;
use App\Http\Requests\CourseModules\IndexCourseModuleRequest;
use App\Http\Requests\CourseModules\StoreCourseModuleRequest;
use App\Http\Requests\CourseModules\UpdateCourseModuleImageRequest;
use App\Http\Requests\CourseModules\UpdateCourseModuleRequest;
use App\Models\CourseModule;
use App\Models\CourseCategory;
use App\Traits\Base64Codable;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;

class CourseModuleController extends Controller
{
    /**
     * Display a listing of the course module.
     *
     * @return void
     */
    function __construct()
    {
        $this->middleware('permission:course-module-list', ['only' => ['index']]);
        $this->middleware('permission:course-module-create', ['only' => ['create','store']]);
        $this->middleware('permission:course-module-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:course-module-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the course modules.
     *
     */
    public function index(IndexCourseModuleRequest $request): Factory|View|Application
    {
        $searchQuery                = $request->get(key: 'search_query');
        $status                     = $request->get(key: 'status');
        $trainingType               = $request->get(key: 'training_type');
        $courseCategoryId    = $request->get(key: 'course_category_id');

        $courseCategories = CourseCategory::query()
            ->where(column: 'status', operator: '=', value: 1)
            ->orderBy(column: 'id', direction: 'ASC')
            ->get();

        $courseModuleQuery = CourseModule::query();
        if ($searchQuery) {
            $courseModuleQuery->where(column: 'name', operator: 'LIKE', value: "%{$searchQuery}%")
                ->orWhere(column: 'code', operator: 'LIKE', value: "%{$searchQuery}%")
                ->orWhere(column: 'price', operator: 'LIKE', value: "%{$searchQuery}%");
        }
        if ($courseCategoryId) {
            $courseModuleQuery->where(column: 'course_category_id', operator: '=', value:  $courseCategoryId);
        }

        if ($status !== null) {
            $courseModuleQuery->where(column: 'status', operator: '=', value: $status);
        }
        if ($trainingType !== null) {
            $courseModuleQuery->where(column: 'training_type', operator: '=', value: $trainingType);
        }

        $courseModuleQuery->with(['courseCategory', 'media'])
            ->orderBy(column: 'course_category_id', direction: 'ASC');

        $courseModules = $courseModuleQuery->paginate(perPage: 20)->withQueryString();

        return view(view: 'backEnd.pages.courseModules.index')->with([
            'courseCategories' => $courseCategories,
            'courseModules' => $courseModules
        ]);
    }

    /**
     * Show the form for creating a new course module.
     *
     */
    public function create(): Factory|View|Application
    {
        $courseCategories = CourseCategory::query()
            ->where(column: 'status', operator: '=', value: 1)
            ->orderBy(column: 'id', direction:  'ASC')->get();

        return view(view: 'backEnd.pages.courseModules.create')->with(['courseCategories' => $courseCategories]);
    }

    /**
     * Store a newly created course module in storage.
     *
     */
    public function store(StoreCourseModuleRequest $request): RedirectResponse
    {
        $courseModuleData= $request->safe()->toArray();
        try {

            DB::beginTransaction();

            CourseModule::query()->create($courseModuleData);
            DB::commit();

            $message = [
                'status' => 'success',
                'info'   => 'Course Module created successfully.',
            ];

            $authUser = Auth::user();

            if($authUser->can(abilities: 'course-module-list')) {

                return redirect()->route(route: 'course-modules.index')->with([
                    'message' => $message,
                ]);

            } else {
                return redirect()->back()->with([
                    'message' => $message,
                ]);
            }

        } catch (Throwable $exception) {
            DB::rollBack();
            $message = [
                'status' => 'error',
                'info'  => 'Something is wrong.',
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
     * Display the specified course module.
     *
     */
    public function show(CourseModule $courseModule): Factory|View|Application
    {
        $courseModule->load(['media', 'courseCategory']);
        return view(view: 'backEnd.pages.courseModules.show')->with([
            'courseModule' => $courseModule
        ]);
    }

    /**
     * Show the form for editing the specified course module.
     *
     */
    public function edit(Request $request, CourseModule $courseModule): Factory|View|Application
    {
        $redirectRoute = $request->get(key: 'redirect_route');

        $courseCategories = CourseCategory::query()
            ->where(column: 'status', operator: '=', value: 1)
            ->orderBy(column: 'name', direction: 'ASC')
            ->get();

        return view(view: 'backEnd.pages.courseModules.edit')->with([
            'courseModule' => $courseModule,
            'courseCategories' => $courseCategories,
            'redirectRoute' => $redirectRoute,
        ]);
    }

    /**
     * Update the specified course module in storage.
     *
     */
    public function update(UpdateCourseModuleRequest $request, CourseModule $courseModule): Redirector|RedirectResponse|Application
    {
        $courseModuleValidatedInfo = $request->safe()->except('redirect_route');
        $redirectRoute = $request->safe()->only(keys: 'redirect_route');

        $redirectRoute = array_key_exists('redirect_route', $redirectRoute) ? $redirectRoute['redirect_route'] : null;

        try {
            DB::beginTransaction();

            $courseModule->update($courseModuleValidatedInfo);

            DB::commit();

            $message = [
                'status' => 'success',
                'info'   => 'Course Module update successfully.',
            ];

            if ($redirectRoute) {
                return redirect($redirectRoute)->with(['message' => $message]);
            } else {
                return redirect()->route(route: 'course-modules.index')->with(['message' => $message]);
            }

        } catch (Throwable $exception) {
            DB::rollBack();

            $message = [
                'status' => 'error',
                'info'  => 'Something is wrong.',
                'exception' => [
                    'message' => $exception->getMessage(),
                    'status' => $exception->getCode(),
                    'line' => $exception->getLine(),
                ],
            ];

            if ($redirectRoute) {
                return redirect($redirectRoute)->with(['message' => $message]);
            } else {
                return redirect()->route(route: 'course-modules.index')->with(['message' => $message]);
            }
        }
    }

    /**
     * Remove the specified course module from storage.
     *
     */
    public function destroy(CourseModule $courseModule): RedirectResponse
    {
        try {
            DB::beginTransaction();

            $courseModule->delete();

            DB::commit();

            $message = [
                'status' => 'success',
                'info'  => 'Course Module deleted successfully.',
            ];

            return redirect()->route(route: 'course-modules.index')->with([
                'message' => $message,
            ]);

        } catch (Throwable $exception) {
            DB::rollBack();

            $message = [
                'status' => 'error',
                'info'  => 'Something is wrong.',
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
     * Update a particular course module's image.
     */
    public function updateImage(UpdateCourseModuleImageRequest $request, CourseModule $courseModule): Redirector|RedirectResponse|Application
    {
        $image = $request->input(key: 'image');
        $redirectRoute = $request->input(key: 'redirect_route');

        try {

            DB::beginTransaction();

            $courseModuleId = $courseModule->id;
            $time = time();
            $fileExtension = Base64Codable::base64DataFileExtension(base64Data:  $image);

            $name = "course-module-image-{$courseModuleId}";
            $fileName = "{$name}-{$time}.$fileExtension";

            $courseModule->addMediaFromBase64(base64data: $image)
                ->usingName(name: $name)
                ->usingFileName(fileName: $fileName)
                ->toMediaCollection(collectionName: 'course-module-image');

            DB::commit();

            $message = [
                'status' => 'success',
                'info'   => 'Course module image update successfully.',
            ];

            if ($redirectRoute) {
                return redirect($redirectRoute)->with(['message' => $message]);
            } else {
                return redirect()->route(route: 'course-modules.index')->with(['message' => $message]);
            }

        } catch (Throwable $exception) {
            DB::rollBack();

            $message = [
                'status' => 'error',
                'info'  => 'Something is wrong.',
                'exception' => [
                    'message' => $exception->getMessage(),
                    'status' => $exception->getCode(),
                    'line' => $exception->getLine(),
                ],
            ];

            if ($redirectRoute) {
                return redirect($redirectRoute)->with(['message' => $message]);
            } else {
                return redirect()->route(route: 'course-modules.index')->with(['message' => $message]);
            }
        }
    }

    /**
     * Update a specific course category status from storage.
     *
     */
    public function updateStatus(Request $request, CourseModule $courseModule): Redirector|RedirectResponse|Application
    {
        $redirectRoute = $request->get(key: 'redirect_route');

        try {

            DB::beginTransaction();

            if ($courseModule->status == 1) {
                $status = 0;
            }else{
                $status = 1;
            }

            $courseModule->status = $status;

            $courseModule->save();

            DB::commit();

            $message = [
                'status' => 'success',
                'info'  => 'course module status update successfully.',
            ];

            if ($redirectRoute) {
                return redirect($redirectRoute)->with(['message' => $message]);
            } else {
                return redirect()->route(route: 'course-modules.index')->with(['message' => $message]);
            }

        } catch (Throwable $exception) {
            DB::rollBack();

            $message = [
                'status' => 'error',
                'info'  => 'Something is wrong.',
                'exception' => [
                    'message' => $exception->getMessage(),
                    'status' => $exception->getCode(),
                    'line' => $exception->getLine(),
                ],
            ];

            if ($redirectRoute) {
                return redirect($redirectRoute)->with(['message' => $message]);
            } else {
                return redirect()->route(route: 'course-modules.index')->with(['message' => $message]);
            }
        }
    }
}
