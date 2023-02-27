<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\Settings\UpdateSettingRequest;
use App\Models\Setting;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class SettingController extends Controller
{
    /**
     * Display a listing of the setting.
     *
     * @return void
     */
    function __construct()
    {
        $this->middleware('permission:setting-edit', ['only' => ['edit','update']]);
    }
    /**
     * Show the form for editing the specified setting.
     *
     */
    public function noticeEdit(Request $request, Setting $setting): Factory|View|Application
    {
        $setting = Setting::query()
            ->where(column: 'key', operator: '=', value: 'notice_home_page_top')
            ->first();
        $settingValue = json_decode($setting->value);

        return view(view: 'backEnd.pages.settings.edit')->with([
            'setting' => $setting,
            'settingValue' => $settingValue,
        ]);
    }

    /**
     * Update a particular setting.
     */
    public function noticeUpdate(UpdateSettingRequest $request, Setting $setting)
    {
        $notice          = $request->input(key: 'notice');
        $status          = $request->input(key: 'status');

        $value = [
            'notice' => $notice,
            'status' => $status,
            ];

        $value = json_encode($value);


        try {
            DB::beginTransaction();
            $setting = self::updateSetting(setting: $setting, value: $value);
            DB::commit();
            $message = [
                'status' => 'success',
                'info'   => 'Setting update successfully.',
            ];

            return redirect()->back()->with(['message' => $message]);

        }
        catch (Throwable $exception) {
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

            return redirect()->back()->with(['message' => $message]);


        }

    }

    /**
     * Update a particular setting.
     * @throws Exception
     */
    public static function updateSetting(Setting $setting, mixed $value = null): Setting
    {
        $attributes = self::getAttributes(value: $value);
        $setting->update($attributes);

        return $setting;
    }

    /**
     * Get attributes.
     */
    public static function getAttributes(mixed $value = null): array
    {
        $attributes = [];

        if ($value) $attributes['value'] = $value;

        return $attributes;
    }
}
