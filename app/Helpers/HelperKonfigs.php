<?php

use Illuminate\Support\Facades\Cache;
use App\Models\Sistem\KonfigurasiModel;

if (!function_exists('konfigs')) {
    /**
     * Ambil nilai konfigurasi berdasarkan config_key
     *
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    function konfigs(string $key, $default = null)
    {
        $konfigs = Cache::rememberForever('konfigs', function () {
            return KonfigurasiModel::pluck('config_value', 'config_key');
        });

        return $konfigs[$key] ?? $default;
    }
}
