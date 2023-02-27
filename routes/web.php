<?php

use App\Http\Controllers\Admins\AdminController;
use App\Http\Controllers\Clients\ClientController;
use App\Http\Controllers\Contacts\ContactController;
use App\Http\Controllers\FrequentlyAskedQuestions\FrequentlyAskedQuestionController;
use App\Http\Controllers\FrontEndController;
use App\Http\Controllers\CourseCategories\CourseCategoryController;
use App\Http\Controllers\CourseModules\CourseModuleController;
use App\Http\Controllers\Packages\PackageController;
use App\Http\Controllers\PackageSubscriptions\PackageSubscriptionController;
use App\Http\Controllers\Roles\RoleController;
use App\Http\Controllers\Settings\SettingController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',[FrontEndController::class,'getHomePage'])->name('website.getHomePage');

Route::get('contact-us',[FrontEndController::class, 'getContactPage'])->name('website.getContactPage');
Route::post('contact-us',[FrontEndController::class, 'postContact'])->name('website.postContact');

Route::get('all-courses',[FrontEndController::class, 'getAllCoursesPage'])->name('website.getAllCoursesPage');
Route::get('programs/{courseCategory:slug}',[FrontEndController::class, 'getCourseCategoryPage'])->name('website.getCourseCategoryPage');

Route::get('program-module/{courseModule:slug}',[FrontEndController::class, 'getSingleCourseModulePage'])->name('website.getSingleCourseModulePage');


Route::get('about-us', [FrontEndController::class, 'getAboutUsPage'])->name('website.getAboutUsPage');
Route::get('information/{information:slug}',[FrontEndController::class, 'getInformationPage'])->name('website.getInformationPage');
Route::get('/packages/{package:slug}',[FrontEndController::class, 'getPackage'])->name('website.getPackage');
// Route::get('/packages',[FrontEndController::class, 'getPackage'])->name('website.getPackage');
Route::post('/packages-subscription-order', [FrontEndController::class, 'postPackageSubscriptionOrder'])->name('website.postPackageSubscriptionOrder');

Route::get('/all-programs',[FrontEndController::class, 'getAllCurrentCourses'])->name('website.getAllCurrentCourses');


// admin routes
Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('backEnd.pages.dashboard');
    })->name('dashboard');

    Route::resource(name: 'roles', controller: RoleController::class);

    Route::put(uri:'admins/{admin}/status-update', action: [AdminController::class, 'updateStatus'])->name('admins.updateStatus');
    Route::resource(name: 'admins', controller: AdminController::class)->except(methods: ['show']);

    Route::resource(name: 'clients', controller: ClientController::class)->except(methods: ['show']);

    Route::put(uri:'course-categories/{courseCategory}/status-update', action: [CourseCategoryController::class, 'updateStatus'])->name('course-categories.updateStatus');
    Route::put(uri:'course-categories/{courseCategory}/image-update', action: [CourseCategoryController::class, 'updateImage'])->name('course-categories.updateImage');
    Route::resource(name: 'course-categories', controller: CourseCategoryController::class);

    Route::put(uri:'course-modules/{courseModule}/status-update', action: [CourseModuleController::class, 'updateStatus'])->name('courseModules.updateStatus');
    Route::put(uri:'course-modules/{courseModule}/image-update', action: [CourseModuleController::class, 'updateImage'])->name('courseModules.updateImage');
    Route::resource(name: 'course-modules', controller: CourseModuleController::class);

    Route::put(uri:'frequently-asked-questions/{frequentlyAskedQuestion}/status-update', action: [FrequentlyAskedQuestionController::class, 'updateStatus'])->name('frequently-asked-questions.updateStatus');
    Route::resource(name: 'frequently-asked-questions', controller: FrequentlyAskedQuestionController::class);

    Route::put(uri:'contacts/{contact}/status-update', action: [ContactController::class, 'updateStatus'])->name('contacts.updateStatus');
    Route::resource(name: 'contacts', controller: ContactController::class)->only(['index', 'show', 'destroy']);

    Route::prefix('settings')->controller(SettingController::class)->group(function () {
        Route::get('notice/edit',[SettingController::class,'noticeEdit'])->name('settings.noticeEdit');
        Route::put('/{setting}',[SettingController::class,'noticeUpdate'])->name('settings.noticeUpdate');
        });

    Route::put(uri:'packages/{package}/status-update', action: [PackageController::class, 'updateStatus'])->name('packages.updateStatus');
    Route::put(uri:'packages/{package}/image-update', action: [PackageController::class, 'updateImage'])->name('packages.updateImage');
    Route::resource(name: 'packages', controller: PackageController::class);

    Route::put(uri:'package-subscriptions/{packageSubscription}/payment-status-update', action: [PackageSubscriptionController::class, 'updatePaymentStatus'])->name('package-subscriptions.updatePaymentStatus');
    Route::put(uri:'package-subscriptions/{packageSubscription}/subscription-status-update', action: [PackageSubscriptionController::class, 'updateSubscriptionStatus'])->name('package-subscriptions.updateSubscriptionStatus');
    Route::resource(name: 'package-subscriptions', controller: PackageSubscriptionController::class)->only('index', 'show', 'destroy');




});

require __DIR__.'/auth.php';
