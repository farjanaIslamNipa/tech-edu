<?php

namespace App\Http\Controllers\Roles;

use App\Http\Controllers\Controller;
use App\Http\Requests\Roles\IndexRoleRequest;
use App\Http\Requests\Roles\StoreRoleRequest;
use App\Http\Requests\Roles\UpdateRoleRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    function __construct()
    {
        $this->middleware('permission:role-list', ['only' => ['index']]);
        $this->middleware('permission:role-create', ['only' => ['create','store']]);
        $this->middleware('permission:role-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     */
    public function index(IndexRoleRequest $request): Factory|View|Application
    {
        $searchQuery = $request->has('search_query') ? $request->get('search_query'): null;

        $roleQuery = Role::query();

        if ($searchQuery) {
            $roleQuery->where('name', 'LIKE', "%{$searchQuery}%");
        }

        $roleQuery->withCount('permissions')
            ->orderBy('id','desc');

        $roles = $roleQuery->paginate(10)->withQueryString();

        return view('backEnd.pages.roles.index')->with([
            'roles' => $roles,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create(): Factory|View|Application
    {
        $permissions = Permission::query()->get();

        return view('backEnd.pages.roles.create')->with(['permissions' => $permissions]);
    }

    /**
     * Store a newly created resource in storage.
     *
     */
    public function store(StoreRoleRequest $request): RedirectResponse
    {
        $roleName = $request->safe()->only('name');

        $assignedPermissions = $request->safe()->only('permission');

        try {
            DB::beginTransaction();

            $role = Role::query()->create($roleName);

            $role->syncPermissions($assignedPermissions);

            DB::commit();

            $message = [
                'status' => 'success',
                'info'  => 'Role created successfully.',
            ];

            $authUser = Auth::user();

            if($authUser->can('role-list')) {

                return redirect()->route('roles.index')->with([
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
                'info' => 'Something is wrong.',
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
     * Display the specified resource.
     *
     */
    public function show(Role $role): Factory|View|Application
    {
        $rolePermissions = Permission::query()
            ->join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
            ->where("role_has_permissions.role_id", $role->id)
            ->get();

        return view('backEnd.pages.roles.show')->with([
            'role' => $role,
            'rolePermissions' => $rolePermissions
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     */
    public function edit(Request $request, Role $role): Factory|View|Application
    {
        $redirectRoute = $request->get('redirect_route');

        $permissions = Permission::query()->get();
        $rolePermissions = DB::table("role_has_permissions")
            ->where("role_has_permissions.role_id",$role->id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();

        return view('backEnd.pages.roles.edit')->with([
            'role' => $role, 'permissions' => $permissions, 'rolePermissions' => $rolePermissions, 'redirectRoute' => $redirectRoute,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     */
    public function update(UpdateRoleRequest $request, Role $role): Redirector|RedirectResponse|Application
    {
        $roleName = $request->safe()->only('name');

        $assignedPermissions = $request->safe()->only('permission');

        $redirectRoute = $request->safe()->only('redirect_route');

        $redirectRoute = array_key_exists('redirect_route', $redirectRoute) ? $redirectRoute['redirect_route'] : null;

        try {
            DB::beginTransaction();


            $role->update($roleName);

            $role->syncPermissions($assignedPermissions);

            DB::commit();

            $message = [
                'status' => 'success',
                'info' => 'Role updated successfully.',
            ];

            if ($redirectRoute) {
                return redirect($redirectRoute)->with(['message' => $message]);
            } else {
                return redirect()->route(route: 'roles.index')->with(['message' => $message]);
            }

        }  catch (Throwable $exception) {
                DB::rollBack();

                $message = [
                'status' => 'error',
                'info' => 'Something is wrong.',
                'exception' => [
                'message' => $exception->getMessage(),
                'status' => $exception->getCode(),
                'line' => $exception->getLine(),
                    ],
                ];

            if ($redirectRoute) {
                return redirect($redirectRoute)->with(['message' => $message]);
            } else {
                return redirect()->route(route: 'roles.index')->with(['message' => $message]);
            }
}
    }
    /**
     * Remove the specified resource from storage.
     *
     */
    public function destroy(Role $role): RedirectResponse
    {
        try {
            DB::beginTransaction();

            $role->delete();

            DB::commit();

            $message = [
                'status' => 'success',
                'info'  => 'Role deleted successfully.',
            ];

            return redirect()->route('roles.index')->with([
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
