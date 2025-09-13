<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Distribusi;
use App\Models\Kendaraan;
use App\Models\Sekolah;
use App\Models\PenerimaMbg;
use Illuminate\Http\Request;

use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Display the main dashboard.
     */
    public function index(Request $request)
    {
        $kendaraanFilter = $request->get('kendaraan_id');
        $today = Carbon::today();
        
        // Build query with optional vehicle filter
        $distribusiQuery = Distribusi::with(['sekolah', 'kendaraan']);
        if ($kendaraanFilter) {
            $distribusiQuery->where('kendaraan_id', $kendaraanFilter);
        }

        // Today's distributions
        $distribusiHariIni = (clone $distribusiQuery)
            ->where('tanggal_distribusi', $today)
            ->get();

        // Statistics
        $stats = [
            'total_sekolah' => Sekolah::count(),
            'total_siswa' => PenerimaMbg::count(),
            'total_kendaraan' => Kendaraan::aktif()->count(),
            'distribusi_hari_ini' => $distribusiHariIni->count(),
            'distribusi_selesai_hari_ini' => $distribusiHariIni->where('status', 'sudah')->count(),
            'distribusi_belum_selesai_hari_ini' => $distribusiHariIni->where('status', 'belum')->count(),
        ];

        // Weekly distribution chart data
        $weeklyData = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = $today->copy()->subDays($i);
            $query = (clone $distribusiQuery)->where('tanggal_distribusi', $date);
            
            $weeklyData[] = [
                'date' => $date->format('Y-m-d'),
                'label' => $date->format('d M'),
                'sudah' => $query->clone()->where('status', 'sudah')->count(),
                'belum' => $query->clone()->where('status', 'belum')->count(),
                'total' => $query->count(),
            ];
        }

        // Distribution by status (pie chart)
        $statusData = [
            'sudah' => (clone $distribusiQuery)->sudah()->count(),
            'belum' => (clone $distribusiQuery)->belum()->count(),
        ];

        // Recent distributions
        $recentDistribusi = (clone $distribusiQuery)
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        // Vehicle options for filter
        $kendaraanOptions = Kendaraan::aktif()->get();

        return view('dashboard', compact(
            'stats',
            'weeklyData',
            'statusData',
            'recentDistribusi',
            'distribusiHariIni',
            'kendaraanOptions',
            'kendaraanFilter'
        ));
    }
}