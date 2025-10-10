<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class DasborController extends Controller
{
    public function index(): View|RedirectResponse
    {
        $user = auth()->user();
        $role = $user->getRoleNames()->first();

        // Data berdasarkan role
        $data = [
            'title' => konfigs('NAMA_SISTEM'),
            'user_role' => $role,
            'dashboard_data' => $this->getDashboardData($role)
        ];

        return view('sistem.dasbor', $data);
    }

    private function getDashboardData($role)
    {
        switch ($role) {
            case 'superadmin':
                return [
                    'total_users' => \App\Models\User::count(),
                    'total_pengajuan' => 0, // Ganti dengan model yang sesuai
                    'pending_approvals' => 0,
                ];

            case 'baak':
                return [
                    'total_pengajuan' => 0,
                    'pending_approvals' => 0,
                    'approved_today' => 0,
                ];

            case 'prodi':
                return [
                    'total_mahasiswa' => 0,
                    'pengajuan_prodi' => 0,
                ];

            case 'keuangan':
                return [
                    'total_pembayaran' => 0,
                    'pending_payments' => 0,
                ];

            case 'dosen':
                return [
                    'total_mahasiswa_bimbingan' => 0,
                ];

            case 'mahasiswa':
                return [
                    'status_pengajuan' => 'Belum ada pengajuan',
                    'last_activity' => null,
                ];

            default:
                return [];
        }
    }
}
