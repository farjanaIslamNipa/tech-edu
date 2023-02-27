<?php

namespace App\View\Composers;

use App\Models\CourseCategory;
use App\Models\Setting;
use Illuminate\View\View;

class NoticeComposer
{
    /**
     * Create a new CourseModule Categories Composer.
     */
    public function __construct(protected Setting $setting) {}


    /**
     * Bind data to the view.
     *
     */
    public function compose(View $view)
    {
        $noticeSetting = Setting::query()->where('key', '=', 'notice_home_page_top')
            ->where('type', '=', 'notice')->first();
        $noticePageTop = json_decode($noticeSetting?->value?? '');
        $view->with([
            'noticePageTop' => $noticePageTop,
        ]);
    }
}
