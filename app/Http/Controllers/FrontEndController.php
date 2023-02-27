<?php

namespace App\Http\Controllers;

use App\Events\Contacts\ContactGenerated;
use App\Events\PackageSubscriptions\PackageSubscriptionReferenceGenerated;
use App\Events\PackageSubscriptions\SendPackageSubscriptionAcknowledgementEmail;
use App\Http\Requests\Contacts\StoreWebsiteContactRequest;
use App\Http\Requests\Packages\StorePackageOrderRequest;
use App\Models\Client;
use App\Models\Contact;
use App\Models\FrequentlyAskedQuestion;
use App\Models\CourseModule;
use App\Models\CourseCategory;
use App\Models\Package;
use App\Models\PackageSubscription;
use App\Models\PackageType;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Throwable;
use function React\Promise\reduce;
use Carbon\Carbon;


class FrontEndController extends Controller
{
    /**
     * website home page view.
     */
    public function getHomePage(): Factory|View|Application
    {
        $courseCategories = CourseCategory::query()
            ->select(['id', 'name', 'slug','course_color_code','background_color_code'])
            ->where('status', '=', 1)
            ->with(['courseModules' => function($query) {
                $query->select('id', 'course_category_id', 'name', 'code', 'slug', 'payment_link', 'price', 'training_type', 'short_description', 'description')
                    ->where('status', '=', 1)
                    ->with('media')
                    ->orderBy('id', 'ASC');
            }, 'media'])
            ->orderBy('id', 'ASC')
            ->get()
            ->map(function ($courseCategory) {
               $courseCategory->courseModules = $courseCategory?->courseModules?->take(3);
               return $courseCategory;
            });

        $packages = Package::query()
            ->select(['id', 'name', 'slug', 'short_description', 'description'])
            ->where('status', '=', 1)
            ->with(['packageTypes', 'media'])
            ->orderBy('id', 'ASC')
            ->get();

        return view('frontEnd.pages.home')->with([
            'courseCategories' => $courseCategories,
            'packages' => $packages
        ]);
    }

    /**
     * website contact page view.
     */
    public function getContactPage(): Factory|View|Application
    {
        return view('frontEnd.pages.contactUs');
    }

    /**
     * website contact form submit.
     */
    public function postContact(StoreWebsiteContactRequest $request): Redirector|RedirectResponse|Application
    {
        $userValidatedInfo = $request->safe()->only(['first_name', 'last_name', 'email', 'phone_number']);
        $userValidatedEmail = $request->safe()->only(['email']);
        $contactValidatedInput = $request->safe()->only(['subject', 'message']);
        $redirectRoute = $request->safe()->only(keys: 'redirect_route');
        $redirectRoute = array_key_exists('redirect_route', $redirectRoute) ? $redirectRoute['redirect_route'] : null;

        try {
            DB::beginTransaction();

            $user = User::query()->updateOrCreate($userValidatedEmail, $userValidatedInfo);

            $clientData = ['user_id' => $user->id, 'status' => 1];

            $client = Client::query()->updateOrCreate(['user_id' => $user->id], $clientData);

            $contactValidatedInput['client_id'] = $client->id;

            $contact = Contact::query()->create($contactValidatedInput);

            DB::commit();

            event(new ContactGenerated($contact));

            $message = [
                'status' => 'success',
                'info'  => 'Message has been successfully submitted',
            ];

            if ($redirectRoute) {
                return redirect($redirectRoute)->with(['message' => $message]);
            } else {
                return redirect()->route(route: 'website.getContactPage')->with(['message' => $message]);
            }


        } catch (Throwable $exception) {
            DB::rollBack();
            $message = [
                'status' => 'error',
                'info'  => 'Something is wrong. Please try later.',
                'exception' => [
                    'message' => $exception->getMessage(),
                    'status' => $exception->getCode(),
                    'line' => $exception->getLine(),
                ],
            ];

            if ($redirectRoute) {
                return redirect($redirectRoute)->with(['message' => $message]);
            } else {
                return redirect()->route(route: 'website.getContactPage')->with(['message' => $message]);
            }
        }
    }


    /**
     * website all course Categories page.
     */
    public function getAllCoursesPage(Request $request): Factory|View|Application
    {
        $courseCategoryQuery = CourseCategory::query();
        $searchQuery = $request->get('search_query');
        if ($searchQuery) {
            $courseCategoryQuery->where(function ($query) use ($searchQuery) {
                $query->where('name', 'like', "%$searchQuery%")
                    ->orWhere('short_description', 'like', "%$searchQuery%");
            })->orWhereHas('courseModules', function ($query) use ($searchQuery) {
                $query->where('name', 'like', "%$searchQuery%")
                    ->orWhere('code', 'like', "%$searchQuery%");
            });
        }
        $courseCategories = $courseCategoryQuery->select(['id', 'name', 'slug'])
            ->where('status', '=', 1)
            ->with(['courseModules' => function($query) {
                $query->select('id', 'course_category_id', 'name', 'code', 'slug')
                    ->where('status', '=', 1)
                    ->orderBy('id', 'ASC');
            }, 'media'])
            ->orderBy('id', 'ASC')
            ->get()
            ->map(function ($courseCategory) {
                $courseCategory->courseModules = $courseCategory?->courseModules?->take(4);
                return $courseCategory;
            });

        return view('frontEnd.pages.all-courses')->with([
            'courseCategories' => $courseCategories
        ]);
    }
    /**
     * website courseCategory page view.
     */
    public function getCourseCategoryPage(CourseCategory $courseCategory): Factory|View|Application
    {
       $courseCategory = $courseCategory->load(['courseModules', 'courseModules.media', 'media']);
        return view('frontEnd.pages.course-categories')->with([
            'courseCategory' => $courseCategory
        ]);
    }

    /**
     * website course module page view.
     *
     */
    public function getSingleCourseModulePage(CourseModule $courseModule): Factory|View|Application
    {
       $courseModule->load('media');
        $faqs = FrequentlyAskedQuestion::query()
            ->select(['question', 'answer'])
            ->where('status', '=', 1)
            ->orderBy('order', 'ASC')
            ->get();

        return view('frontEnd.pages.single-course-view')->with([
           'courseModule' => $courseModule,
            'faqs' => $faqs,
        ]);
    }


    /**
     * Website about us page view.
     */
    public function getAboutUsPage(): Factory|View|Application
    {
        return view('frontEnd.pages.aboutUs');
    }

    /**
     * Website information related page view.
     */
    public function getInformationPage($informationSlug)
    {
        if ($informationSlug == 'how-geeks-learning-works') {
            return view('frontEnd.pages.how-it-Works');
        }

        if ($informationSlug == 'terms-and-conditions') {
            return view('frontEnd.pages.terms-and-conditions');
        }

        if ($informationSlug == 'privacy-policies')
        {
            return view('frontEnd.pages.privacy-policy');
        }

        if ($informationSlug == 'faqs') {
            $faqs = FrequentlyAskedQuestion::query()
                ->select(['question', 'answer'])
                ->where('status', '=', 1)
                ->orderBy('order', 'ASC')
                ->get();

            return view('frontEnd.pages.faqs')->with([
                'faqs' => $faqs,
            ]);
        }
        App::abort(404);
    }
    public function getAllCurrentCourses(){

    $subscriptionCategoryQuery = CourseCategory::query();
    $subscriptionCategories = $subscriptionCategoryQuery->select(['id', 'name', 'slug','course_color_code', 'background_color_code'])
        ->where('status', '=', 1)
        ->with(['courseModules' => function($query) {
            $query->select('id', 'course_category_id', 'name', 'code', 'slug', 'payment_link', 'price', 'training_type', 'short_description', 'description')->with('media')
                ->where('status', '=', 1)
                ->orderBy('id', 'ASC');
        }])
        ->orderBy('id', 'ASC')
        ->get();
    return view('frontEnd.pages.all-course-curriculum')->with([
        'subscriptionCategories' => $subscriptionCategories
    ]);
    }
    public function getPackage(Package $package){

        $package->load(['packageTypes', 'media', 'courseModules']);
        return view('frontEnd.pages.package-details')->with(['package' => $package]);
    }



    public function postPackageSubscriptionOrder(StorePackageOrderRequest $request): JsonResponse
    {
        $validatedInput = $request->safe();

        $packageId = $validatedInput['package_id'] ?? null;
        $packageTypeId = $validatedInput['package_type_id'] ?? null;
        $courseModuleId = $validatedInput['course_module_id'] ?? null;

        $firstName = $validatedInput['first_name'] ?? null;
        $lastName = $validatedInput['last_name'] ?? null;
        $email = $validatedInput['email'] ?? null;
        $phoneNumber = $validatedInput['phone_number'] ?? null;

        try {
            DB::beginTransaction();
            $selectedPackage = Package::query()->firstWhere('id', $packageId);
            $selectedPackageType = PackageType::query()->firstWhere('id', $packageTypeId);
            $selectedCourseModules = CourseModule::query()->whereIn('id', $courseModuleId)->get();

            $courseModulePrices = $selectedCourseModules->reduce(function ($current, $course) {
                return $course->price + $current;
                });
            $discountPrice = (int)ceil($courseModulePrices * $selectedPackageType->discount_percentage /100);

            $gstPrice = (int)ceil(($courseModulePrices - $discountPrice) * .10);

            $totalPrice = $courseModulePrices - $discountPrice + $gstPrice;

            $user = User::query()->updateOrCreate(['first_name' => $firstName,'last_name' => $lastName,'email' => $email,'phone_number' =>$phoneNumber]);
            $clientData = ['user_id' => $user->id, 'status' => 1];

            $client = Client::query()->updateOrCreate(['user_id' => $user->id], $clientData);

            $clientId =  $client->id;

            $date = Carbon::now();
            $nowTimeDate = $date->addMonth();
            $subscriptionEndDate =  date('Y-m-d', strtotime($nowTimeDate))." 23:59:59";
            $packageSubscriptionData = ['client_id' => $clientId, 'package_id' =>$packageId, 'package_price' =>$courseModulePrices,'discount_price'=>$discountPrice, 'gst_price' =>$gstPrice, 'total_price'=>$totalPrice, 'payment_status'=>0, 'subscription_status'=>0, 'subscription_end_date'=>$subscriptionEndDate];

            $packageSubscription = PackageSubscription::query()->create($packageSubscriptionData);

            event(new PackageSubscriptionReferenceGenerated($packageSubscription));

            $packageSubscription->courseModules()->sync($courseModuleId);

            DB::commit();

            event(new SendPackageSubscriptionAcknowledgementEmail($packageSubscription, $selectedPackage, $selectedPackageType, $selectedCourseModules));

            return response()->json(['data' => []], 201);


        } catch (Throwable $exception) {
            DB::rollBack();

            $message = [
                'status' => 'error',
                'info' => 'Something is wrong. Please try later.',
                'exception' => [
                    'message' => $exception->getMessage(),
                    'status' => $exception->getCode(),
                    'line' => $exception->getLine(),
                ],
            ];

            return response()->json(['data' => $message], 500);
        }
    }

}
