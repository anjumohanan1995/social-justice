<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckPermission
{
    public function handle($request, Closure $next, $permission, $subPermission = null)
    {
        //         // Logic to check if the user has any of the required permissions
        // foreach ($permissions as $permission) {
        //     if ($request->user()->hasPermission($permission)) {
        //         return $next($request);
        //     }
        // }

        // abort(403, 'Unauthorized action.');
        // dd($permission);
        $user = Auth::user();

        if (!$user) {
            return redirect('/login');
        }

        $role = $user->role;
        // dd($role);

        $rolePermission = \App\Models\RolePermission::where('role', $role)->first();

        $permissions = $rolePermission && is_string($rolePermission->permission)
            ? json_decode($rolePermission->permission, true)
            : ($rolePermission->permission ?? []);
//dd($permissions);
        $subPermissions = $rolePermission && is_string($rolePermission->sub_permissions)
            ? json_decode($rolePermission->sub_permissions, true)
            : ($rolePermission->sub_permissions ?? []);
             //dd($subPermissions);

        // if (!in_array($permission, $permissions) || $role !== 'Admin') {
        //     return redirect('/no-permission');
        // }

        if ($subPermission && !in_array($subPermission, $subPermissions) && $role !== 'Admin') {
            return redirect('/no-permission');
        }

        return $next($request);
    }
}
