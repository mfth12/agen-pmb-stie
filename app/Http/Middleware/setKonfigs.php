<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Sistem\KonfigurasiModel;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class setKonfigs
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Cek apakah sesi konfigs sudah ada
        if (!Session::has('konfigs')) {
            // Ambil konfigurasi dari database dan simpan ke sesi
            $konfigs = KonfigurasiModel::where('config_group', 'identitas')
                ->select('id', 'config_key', 'config_value')
                ->get();
            Session::put('konfigs', $konfigs);
        }

        return $next($request);
    }
}
