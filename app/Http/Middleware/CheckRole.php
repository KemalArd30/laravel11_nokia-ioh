<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $roles): Response
    {
        // Pecah parameter roles menjadi array
        $rolesArray = array_map('trim', explode('|', $roles));

        // Debugging untuk memastikan rolesArray benar
        if (!app()->environment('production')) {
            logger()->info('Middleware CheckRole: Roles required', [
                'roles_required' => $rolesArray,
                'user_roles' => $request->user()?->getRoleNames()->toArray(),
            ]);
        }

        // Periksa apakah user terautentikasi
        if (!$request->user()) {
            abort(401, 'User is not authenticated.');
        }

        // Periksa apakah user memiliki salah satu role yang diperlukan
        if (!$request->user()->hasAnyRole($rolesArray)) {
            abort(403, 'You do not have the required role to access this resource.');
        }

        // Jika validasi berhasil, lanjutkan request
        return $next($request);
    }
}