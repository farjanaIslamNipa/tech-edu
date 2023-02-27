<?php

namespace App\View\Composers;

use App\Models\CourseCategory;
use Illuminate\View\View;

class CourseCategoriesComposer
{
    /**
     * Create a new CourseModule Categories Composer.
     */
    public function __construct(protected CourseCategory $courseCategory) {}


    /**
     * Bind data to the view.
     *
     */
    public function compose(View $view)
    {
        $courseCategories = $this->courseCategory->query()
            ->select(['id', 'slug', 'name', 'course_color_code', 'is_primary'])
            ->where('status' , '=', '1')
            ->with(['courseModules' => function($query) {
                $query->select('id', 'course_category_id', 'name', 'code', 'slug')
                    ->where('status', '=', 1)
                    ->orderBy('id', 'ASC');
            }, 'media'])
            ->orderBy('id', 'ASC')->limit(3)->get();
        $view->with([
            'courseCategoriesOnly' => $courseCategories
        ]);
    }
}
