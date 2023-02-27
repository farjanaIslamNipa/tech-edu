<?php

namespace App\Http\Controllers\Clients;

use App\Events\Users\UserPasswordGenerated;
use App\Http\Controllers\Controller;
use App\Http\Requests\Clients\IndexClientRequest;
use App\Http\Requests\Clients\StoreClientRequest;
use App\Http\Requests\Clients\UpdateClientRequest;
use App\Models\Address;
use App\Models\Client;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Throwable;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    function __construct()
    {
        $this->middleware('permission:client-list', ['only' => ['index']]);
        $this->middleware('permission:client-create', ['only' => ['create','store']]);
        $this->middleware('permission:client-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:client-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     */
    public function index(IndexClientRequest $request): Factory|View|Application
    {
        $searchQuery    = $request->get('search_query');
        $status         = $request->get('status');

        $clientQuery = Client::query();


        if ($searchQuery) {
            $clientQuery->where(function($query) use ($searchQuery) {
                $query->whereHas(relation: 'user', callback: function ($query) use ($searchQuery) {
                    $query->where('first_name', 'LIKE', "%{$searchQuery}%")
                        ->orWhere('last_name', 'LIKE', "%{$searchQuery}%")
                        ->orWhere('email', 'LIKE', "%{$searchQuery}%")
                        ->orWhere('phone_number', 'LIKE', "%{$searchQuery}%");
                })->orWhereHas(relation: 'address', callback: function ($query) use ($searchQuery) {
                    $query->where('street', 'LIKE', "%{$searchQuery}%")
                        ->orWhere('suburb', 'LIKE', "%{$searchQuery}%")
                        ->orWhere('state', 'LIKE', "%{$searchQuery}%")
                        ->orWhere('country', 'LIKE', "%{$searchQuery}%")
                        ->orWhere('post_code', 'LIKE', "%{$searchQuery}%");
                });
            });
        }

        if ($status !== null) {
            $clientQuery->where(column: 'status', operator: '=', value: $status);
        }

        $clientQuery->with(['user', 'address'])
            ->orderBy('id','desc');;

        $clients = $clientQuery->paginate(perPage: 20)->withQueryString();

        return view(view: 'backEnd.pages.clients.index')->with([
            'clients' => $clients
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create(): Factory|View|Application
    {
        return view('backEnd.pages.clients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     */
    public function store(StoreClientRequest $request): RedirectResponse
    {
        $userValidatedInfo = $request->safe()->only(['first_name', 'last_name', 'email', 'phone_number']);
        $userValidatedEmail = $request->safe()->only(['email']);

        $addressValidatedInfo = $request->safe()->only(['street', 'suburb', 'state', 'post_code', 'country']);

        try {

            DB::beginTransaction();

            $user = User::query()->updateOrCreate($userValidatedEmail, $userValidatedInfo);

            $address = Address::query()->create($addressValidatedInfo);

            $clientInfo = ['user_id' => $user->id, 'address_id' => $address->id,  'status' => 1];

            Client::query()->updateOrCreate(['user_id' => $user->id], $clientInfo);

            DB::commit();

            $message = [
                'status' => 'success',
                'info'  => 'Client created successfully.',
            ];

            $authUser = Auth::user();
            if($authUser->can('client-list')) {

                return redirect()->route('clients.index')->with([
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
     * Show the form for editing the specified resource.
     *
     */
    public function edit(Request $request,Client $client): Factory|View|Application
    {
        $redirectRoute = $request->get('redirect_route');

        $client->load(['user', 'address']);

        return view('backEnd.pages.clients.edit')->with([
            'client' => $client,
            'redirectRoute' => $redirectRoute,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     */
    public function update(UpdateClientRequest $request, Client $client): Redirector|RedirectResponse|Application
    {
        $userValidatedInfo = $request->safe()->only(['first_name', 'last_name', 'email', 'phone_number']);

        $addressValidatedInfo = $request->safe()->only('street', 'suburb', 'state', 'post_code', 'country');

        $redirectRoute = $request->safe()->only(keys: 'redirect_route');

        $redirectRoute = array_key_exists('redirect_route', $redirectRoute) ? $redirectRoute['redirect_route'] : null;

        try {
            DB::beginTransaction();

            $client?->user?->update($userValidatedInfo);

            $client?->address?->update($addressValidatedInfo);

            DB::commit();

            $message = [
                'status' => 'success',
                'info'  => 'Client update successfully.',
            ];

            if ($redirectRoute) {
                return redirect($redirectRoute)->with(['message' => $message]);
            } else {
                return redirect()->route(route: 'clients.index')->with(['message' => $message]);
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
                return redirect()->route(route: 'courseModules.index')->with(['message' => $message]);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     */
    public function destroy(Client $client): RedirectResponse
    {
        try {
            DB::beginTransaction();

            $client->user->delete();

            $client->address->delete();

            $client->delete();

            DB::commit();

            $message = [
                'status' => 'success',
                'info'  => 'Client deleted successfully.',
            ];

            return redirect()->route('clients.index')->with([
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
}
