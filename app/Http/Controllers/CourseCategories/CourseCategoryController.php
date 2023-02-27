<?php

namespace App\Http\Controllers\CourseCategories;

use App\Http\Controllers\Controller;
use App\Http\Requests\CourseCategories\IndexCourseCategoryRequest;
use App\Http\Requests\CourseCategories\StoreCourseCategoryRequest;
use App\Http\Requests\CourseCategories\UpdateCourseCategoryImageRequest;
use App\Http\Requests\CourseCategories\UpdateCourseCategoryRequest;
use App\Http\Requests\Courses\UpdateCourseImageRequest;
use App\Models\Course;
use App\Models\CourseCategory;
use App\Traits\Base64Codable;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Throwable;

class CourseCategoryController extends Controller
{
    /**
     * Display a permission listing of course categories.
     *
     * @return void
     */
    function __construct()
    {
        $this->middleware('permission:course-category-list', ['only' => ['index']]);
        $this->middleware('permission:course-category-create', ['only' => ['create','store']]);
        $this->middleware('permission:course-category-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:course-category-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the course categories.
     *
     */
    public function index(IndexCourseCategoryRequest $request): Factory|View|Application
    {
        $searchQuery    = $request->get(key: 'search_query');
        $status         = $request->get(key: 'status');
        $isPrimary         = $request->get(key: 'is_primary');

        $courseCategoryQuery = CourseCategory::query();


        if ($searchQuery) {
            $courseCategoryQuery->where(column: 'name', operator: 'LIKE', value: "%{$searchQuery}%")
                ->orWhere(column: 'course_color_code', operator: 'LIKE', value: "%{$searchQuery}%")
                ->orWhere(column: 'background_color_code', operator: 'LIKE', value: "%{$searchQuery}%");
        }

        if ($status !== null) {
            $courseCategoryQuery->where(column: 'status', operator: '=', value: $status);
        }
        if ($isPrimary !== null) {
            $courseCategoryQuery->where(column: 'is_primary', operator: '=', value: $isPrimary);
        }

        $courseCategoryQuery->with(['media'])
            ->orderBy(column: 'id', direction: 'ASC');

        $courseCategories = $courseCategoryQuery->paginate(perPage: 20)->withQueryString();

        return view(view: 'backEnd.pages.courseCategories.index')->with([
            'courseCategories' => $courseCategories
        ]);
    }

    /**
     * Show the form for creating a new course category.
     *
     */
    public function create(): Factory|View|Application
    {
        return view(view: 'backEnd.pages.courseCategories.create');
    }

    /**
     * Store a newly created course category in storage.
     *
     */
    public function store(StoreCourseCategoryRequest $request): RedirectResponse
    {
        $courseCategoryData = $request->safe()->toArray();
        try {

            DB::beginTransaction();

            CourseCategory::query()->create($courseCategoryData);

            DB::commit();

            $message = [
                'status' => 'success',
                'info'  => 'Course category created successfully.',
            ];

            $authUser = Auth::user();

            if($authUser->can(abilities: 'course-category-list')) {

                return redirect()->route(route: 'course-categories.index')->with([
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
     * Display the specified course category.
     *
     */
    public function show(CourseCategory $courseCategory): Factory|View|Application
    {
        return view(view: 'backEnd.pages.courseCategories.show')->with([
            'courseCategory' => $courseCategory
        ]);
    }

    /**
     * Show the form for editing the specified course category.
     *
     */
    public function edit(Request $request, CourseCategory $courseCategory): Factory|View|Application
    {
        $redirectRoute = $request->get(key: 'redirect_route');

        return view(view: 'backEnd.pages.courseCategories.edit')->with([
           'courseCategory' => $courseCategory,
            'redirectRoute' => $redirectRoute,
        ]);
    }

    /**
     * Update the specified course category in storage.
     *
     */
    public function update(UpdateCourseCategoryRequest $request, CourseCategory $courseCategory): Redirector|RedirectResponse|Application
    {
        $courseCategoryValidatedInfo = $request->safe()->except(keys: 'redirect_route');
        $redirectRoute = $request->safe()->only(keys: 'redirect_route');

        $redirectRoute = array_key_exists('redirect_route', $redirectRoute) ? $redirectRoute['redirect_route'] : null;


        try {
            DB::beginTransaction();

            $courseCategory->update($courseCategoryValidatedInfo);

            DB::commit();

            $message = [
                'status' => 'success',
                'info'   => 'Course category update successfully.',
            ];
            if ($redirectRoute) {
                return redirect($redirectRoute)->with(['message' => $message]);
            } else {
                return redirect()->route(route: 'course-categories.index')->with(['message' => $message]);
            }


        } catch (Throwable $exception) {
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
                return redirect()->route(route: 'course-categories.index')->with(['message' => $message]);
            }
        }
    }

    /**
     * Remove the specified course category from storage.
     *
     */
    public function destroy(CourseCategory $courseCategory): RedirectResponse
    {
        try {
            DB::beginTransaction();

            $courseCategory->delete();

            DB::commit();

            $message = [
                'status' => 'success',
                'info'  => 'Course category deleted successfully.',
            ];

            return redirect()->route(route: 'course-categories.index')->with([
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
     * Update a particular course categories image.
     */
    public function updateImage(UpdateCourseCategoryImageRequest $request, CourseCategory $courseCategory): Redirector|RedirectResponse|Application
    {
        $image = $request->input(key: 'image');
        $redirectRoute = $request->input(key: 'redirect_route');

        try {

            DB::beginTransaction();

            $courseCategoryId = $courseCategory->id;
            $time = time();
            $fileExtension = Base64Codable::base64DataFileExtension(base64Data:  $image);

            $name = "course-category-image-{$courseCategoryId}";
            $fileName = "{$name}-{$time}.$fileExtension";

            $courseCategory->addMediaFromBase64(base64data: $image)
                ->usingName(name: $name)
                ->usingFileName(fileName: $fileName)
                ->toMediaCollection(collectionName: 'course-category-image');

            DB::commit();

            $message = [
                'status' => 'success',
                'info'   => 'Course category image update successfully.',
            ];

            if ($redirectRoute) {
                return redirect($redirectRoute)->with(['message' => $message]);
            } else {
                return redirect()->route(route: 'course-categories.index')->with(['message' => $message]);
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
                return redirect()->route(route: 'course-categories.index')->with(['message' => $message]);
            }
        }
    }

    /**
     * Update a specific course category status from storage.
     *
     */
    public function updateStatus(Request $request, CourseCategory $courseCategory): Redirector|RedirectResponse|Application
    {
        $redirectRoute = $request->get(key: 'redirect_route');

        try {

            DB::beginTransaction();

            if ($courseCategory->status == 1) {
                $status = 0;
            }else{
                $status = 1;
            }

            $courseCategory->status = $status;

            $courseCategory->save();

            DB::commit();

            $message = [
                'status' => 'success',
                'info'  => 'course category status update successfully.',
            ];

            if ($redirectRoute) {
                return redirect($redirectRoute)->with(['message' => $message]);
            } else {
                return redirect()->route(route: 'course-categories.index')->with(['message' => $message]);
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
                return redirect()->route(route: 'course-categories.index')->with(['message' => $message]);
            }
        }
    }
}
