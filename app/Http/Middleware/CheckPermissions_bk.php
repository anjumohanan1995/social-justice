<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Models\RolePermission;

class CheckPermissions
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $permission
     * @return mixed
     */
    public function handle($request, Closure $next, $permission)
    {
        $user = Auth::user();
        $role = $user->role;

        $rolePermission = RolePermission::where('role', $role)->first();

        if (!$rolePermission || !in_array($permission, json_decode($rolePermission->sub_permissions, true))) {
            // If user is not 'Super Admin' or doesn't have the required permission, deny access
            if ($user->role !== 'Admin') {
                abort(403, 'Unauthorized action.');
            }
        }

        return $next($request);
    }
}
