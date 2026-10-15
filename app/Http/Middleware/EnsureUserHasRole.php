<?php
 
namespace App\Http\Middleware;
 
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
 
class EnsureUserHasRole
{
    /**
     * Membatasi akses halaman berdasarkan peran (pencari_kerja / perekrut).
     * Dipasang lewat alias 'role' pada bootstrap/app.php.
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (! $request->user() || $request->user()->role !== $role) {
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }
 
        return $next($request);
    }
}
