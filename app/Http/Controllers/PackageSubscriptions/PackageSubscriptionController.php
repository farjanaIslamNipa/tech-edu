<?php

namespace App\Http\Controllers\PackageSubscriptions;

use App\Http\Controllers\Controller;
use App\Http\Requests\PackageSubscriptions\IndexPackageSubscriptionRequest;
use App\Http\Requests\PackageSubscriptions\UpdatePackageSubscriptionStatusRequest;
use App\Models\PackageSubscription;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use Throwable;

class PackageSubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    function __construct()
    {
        $this->middleware('permission:package-subscription-list', ['only' => ['index', 'show']]);
        $this->middleware('permission:package-subscription-delete', ['only' => ['destroy']]);

    }

    /**
     * Display a listing of the resource.
     *
     */
    public function index(IndexPackageSubscriptionRequest $request)
    {
        $searchQuery            = $request->get('search_query');
        $paymentStatus          = $request->get('payment_status');
        $subscriptionStatus     = $request->get('subscription_status');
        $packageSubscriptionQuery = PackageSubscription::query();

        if ($searchQuery) {
            $packageSubscriptionQuery->where(column: 'reference', operator: 'LIKE', value: "%{$searchQuery}%")
                ->orWhereHas('client.user', function ($query) use ($searchQuery) {
                    $query->where('first_name', 'LIKE', "%{$searchQuery}%")
                        ->orWhere('last_name', 'LIKE', "%{$searchQuery}%")
                        ->orWhere('email', 'LIKE', "%{$searchQuery}%")
                        ->orWhere('phone_number', 'LIKE', "%{$searchQuery}%");
                })->orWhereHas('client.address', function ($query) use ($searchQuery) {
                    $query->where('street', 'LIKE', "%{$searchQuery}%")
                        ->orWhere('suburb', 'LIKE', "%{$searchQuery}%")
                        ->orWhere('state', 'LIKE', "%{$searchQuery}%")
                        ->orWhere('country', 'LIKE', "%{$searchQuery}%")
                        ->orWhere('post_code', 'LIKE', "%{$searchQuery}%");
                });
        }

        if ($subscriptionStatus != null) {
            $packageSubscriptionQuery->where('subscription_status', '=', $subscriptionStatus);
        }
        if ($paymentStatus != null) {
            $packageSubscriptionQuery->where('payment_status', '=', $paymentStatus);
        }
        $packageSubscriptionQuery->with(['client.user', 'client.address', 'package'])
            ->orderBy('created_at','desc');


        $packageSubscriptions = $packageSubscriptionQuery->paginate(perPage: 20)->withQueryString();
//dd($packageSubscriptions);

        return view(view: 'backEnd.pages.packageSubscriptions.index')->with([
            'packageSubscriptions' => $packageSubscriptions
        ]);
    }



    /**
     * Display the specified resource.
     *
     */
    public function show(PackageSubscription $packageSubscription)
    {
        $packageSubscription->load('client.user', 'client.address', 'package', 'courseModules');
        return view('backEnd.pages.packageSubscriptions.show')->with([
            'packageSubscription' => $packageSubscription,
        ]);
    }


    /**
     * Remove the specified resource from storage.
     *
     */
    public function destroy(PackageSubscription $packageSubscription)
    {
        try {
            DB::beginTransaction();
            $packageSubscription->delete();
            DB::commit();
            $message = [
                'status' => 'success',
                'info'  => 'Package subscription deleted successfully.',
            ];

            return redirect()->route(route: 'package-subscriptions.index')->with([
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
     * Update a specified resource's status
     */
    public function updateSubscriptionStatus(UpdatePackageSubscriptionStatusRequest $request, PackageSubscription $packageSubscription): Redirector|RedirectResponse|Application
    {

        $validatedInput = $request->safe()->except('redirect_route');
        $redirectRoute = $request->safe()->only(keys: 'redirect_route');

        $redirectRoute = array_key_exists('redirect_route', $redirectRoute) ? $redirectRoute['redirect_route'] : null;
        try {

            DB::beginTransaction();
            $packageSubscription->update($validatedInput);

            DB::commit();

            $message = [
                'status' => 'success',
                'info'  => 'Package subscription status update successfully.',
            ];

            if ($redirectRoute) {
                return redirect($redirectRoute)->with(['message' => $message]);
            } else {
                return redirect()->route(route: 'package-subscriptions.index')->with(['message' => $message]);
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
                return redirect()->route(route: 'package-subscriptions.index')->with(['message' => $message]);
            }
        }
    }

    /**
     * Update a specific contact status from storage.
     *
     */
    public function updatePaymentStatus(Request $request, PackageSubscription $packageSubscription): Redirector|RedirectResponse|Application
    {
        $redirectRoute = $request->get(key: 'redirect_route');

        try {

            DB::beginTransaction();

            if ($packageSubscription->payment_status == 0) {
                $paymentStatus = 1;
            }else{
                $paymentStatus = 0;
            }

            $packageSubscription->payment_status = $paymentStatus;

            $packageSubscription->save();

            DB::commit();

            $message = [
                'status' => 'success',
                'info'  => 'Package Subscription  payment status update successfully.',
            ];

            if ($redirectRoute) {
                return redirect($redirectRoute)->with(['message' => $message]);
            } else {
                return redirect()->route(route: 'package-subscriptions.index')->with(['message' => $message]);
            }

        } catch (Throwable $exception) {
            DB::rollBack();

            $message = [
                'status' => 'error',
                'info'  => 'something is wrong.',
                'exception' => [
                    'message' => $exception->getMessage(),
                    'status' => $exception->getCode(),
                    'line' => $exception->getLine(),
                ],
            ];

            if ($redirectRoute) {
                return redirect($redirectRoute)->with(['message' => $message]);
            } else {
                return redirect()->route(route: 'package-subscriptions.index')->with(['message' => $message]);
            }
        }
    }
}
