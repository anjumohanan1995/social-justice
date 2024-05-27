<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckPermission
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

        if (!$user) {
            // User is not authenticated
            return redirect('/login');
        }

        $role = $user->role;

        // Fetch the permissions for the current user's role
        $rolePermission = \App\Models\RolePermission::where('role', $role)->first();

        $permissions = $rolePermission && is_string($rolePermission->permission)
            ? json_decode($rolePermission->permission, true)
            : ($rolePermission->permission ?? []);

        if (!in_array($permission, $permissions) && $role !== 'Admin') {
            // Permission denied
            return redirect('/no-permission');
        }

        return $next($request);
    }
}
