<?php

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
        static $konfigs = null;

        if ($konfigs === null) {
            $konfigs = KonfigurasiModel::pluck('config_value', 'config_key')->toArray();
        }

        return $konfigs[$key] ?? $default;
    }
}
