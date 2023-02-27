<?php

namespace App\Http\Controllers\Admins;

use App\Events\Users\UserPasswordGenerated;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admins\IndexAdminRequest;
use App\Http\Requests\Admins\StoreAdminRequest;
use App\Http\Requests\Admins\UpdateAdminRequest;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Throwable;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    function __construct()
    {
        $this->middleware('permission:admin-list', ['only' => ['index']]);
        $this->middleware('permission:admin-create', ['only' => ['create','store']]);
        $this->middleware('permission:admin-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:admin-delete', ['only' => ['destroy']]);
    }


    /**
     * Display a listing of the resource.
     *
     */
    public function index(IndexAdminRequest $request): Factory|View|Application
    {
        $searchQuery    = $request->get(key: 'search_query');
        $roleQuery      = $request->get(key: 'role_id');
        $status         = $request->get(key: 'status');

        $adminQuery = Admin::query();

        $roles = Role::query()->orderBy(column: 'name', direction: 'ASC')->get();


        if ($searchQuery) {
            $adminQuery->whereHas(relation: 'user', callback: function ($query) use ($searchQuery) {
                $query->where('first_name', 'LIKE', "%{$searchQuery}%")
                    ->orWhere('last_name', 'LIKE', "%{$searchQuery}%")
                    ->orWhere('email', 'LIKE', "%{$searchQuery}%")
                    ->orWhere('phone_number', 'LIKE', "%{$searchQuery}%");
            });
        }
        if ($roleQuery) {
            $adminQuery->whereHas(relation: 'user.roles', callback: function ($query) use ($roleQuery){
                $query->where('roles.id', '=', $roleQuery);
            });
        }

        if ($status !== null) {
            $adminQuery->where(column: 'status', operator: '=', value: $status);
        }

        $adminQuery->with(['user', 'user.roles'])
            ->orderBy(column: 'id', direction: 'desc');

        $admins = $adminQuery->paginate(perPage: 20)->withQueryString();

        return view(view: 'backEnd.pages.admins.index')->with([
            'admins' => $admins, 'roles' => $roles
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create(): Factory|View|Application
    {
        $roles = Role::query()
            ->orderBy('name', 'ASC')
            ->get();

        return view(view: 'backEnd.pages.admins.create')->with(['roles' => $roles]);
    }

    /**
     * Store a newly created resource in storage.
     *
     */
    public function store(StoreAdminRequest $request): RedirectResponse
    {
        $userData = $request->safe()->except(keys: 'role_id');

        $roleId = $request->safe()->only(keys: 'role_id');

        try {

            DB::beginTransaction();

            $plainPassword = Str::random(length: 8);

            $userData['password'] = Hash::make($plainPassword);

            $user = User::query()->create($userData);

            if (array_key_exists('role_id', $roleId)) {
                $user->assignRole($roleId);
            }

            $adminData = ['user_id' => $user->id, 'status' => 1];

            $adminData['role_id'] = $roleId['role_id'] ?? null;

            Admin::query()->create($adminData);

            // event & listener for user email password
            event(new UserPasswordGenerated(user: $user, plainPassword: $plainPassword));

            DB::commit();

            $message = [
                'status' => 'success',
                'info'  => 'Admin created successfully.',
            ];

            $authUser = Auth::user();
            if($authUser->can(abilities: 'admin-list')) {

                return redirect()->route(route: 'admins.index')->with([
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
    public function edit(Request $request,Admin $admin): Factory|View|Application
    {
        $redirectRoute = $request->get(key: 'redirect_route');

        $admin->load('user', 'user.roles');

        $roles = Role::query()->orderBy('name', 'ASC')->get();

        return view(view: 'backEnd.pages.admins.edit')->with([
            'admin' => $admin,
            'roles' => $roles,
            'redirectRoute' => $redirectRoute,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     */
    public function update(UpdateAdminRequest $request, Admin $admin): Redirector|RedirectResponse|Application
    {
        $userValidatedInfo = $request->safe()->except('role', 'redirect_route');

        $roleId = $request->safe()->only('role_id');

        $redirectRoute = $request->safe()->only(keys: 'redirect_route');

        $redirectRoute = array_key_exists('redirect_route', $redirectRoute) ? $redirectRoute['redirect_route'] : null;


        try {
            DB::beginTransaction();

            $admin?->user?->update($userValidatedInfo);

            $admin?->user?->roles()?->detach();

            if (array_key_exists('role_id', $roleId)) {
                $admin?->user?->assignRole($roleId);
            }
            DB::commit();

            $message = [
                'status' => 'success',
                'info'  => 'Admin update successfully.',
            ];

            if ($redirectRoute) {
                return redirect($redirectRoute)->with(['message' => $message]);
            } else {
                return redirect()->route(route: 'admins.index')->with(['message' => $message]);
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
                return redirect()->route(route: 'admins.index')->with(['message' => $message]);
            }
        }
    }

    /**
     * Update a specific admin status from storage.
     *
     */
    public function updateStatus(Request $request, Admin $admin): Redirector|RedirectResponse|Application
    {
        $redirectRoute = $request->get(key: 'redirect_route');

        try {

            DB::beginTransaction();

            if ($admin->status == 1) {
                $status = 0;
            }else{
                $status = 1;
            }

            $admin->status = $status;

            $admin->save();

            DB::commit();

            $message = [
                'status' => 'success',
                'info'  => 'Admin status update successfully.',
            ];

            if ($redirectRoute) {
                return redirect($redirectRoute)->with(['message' => $message]);
            } else {
                return redirect()->route(route: 'admins.index')->with(['message' => $message]);
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
                return redirect()->route(route: 'admins.index')->with(['message' => $message]);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     */
    public function destroy(Admin $admin): RedirectResponse
    {
        try {
            DB::beginTransaction();

            $admin?->user?->roles()->detach();

            $admin?->user->delete();

            $admin->delete();

            DB::commit();

            $message = [
                'status' => 'success',
                'info'  => 'Admin deleted successfully.',
            ];

            return redirect()->route('admins.index')->with([
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
