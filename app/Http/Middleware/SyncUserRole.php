<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SyncUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if ($user instanceof User) {
            abort_unless(in_array($user->role, ['admin', 'petugas', 'siswa'], true), 403);

            $assignedRoles = $user->getRoleNames();

            if ($assignedRoles->count() !== 1 || ! $assignedRoles->contains($user->role)) {
                $user->syncRoles([$user->role]);
            }
        }

        return $next($request);
    }
}
