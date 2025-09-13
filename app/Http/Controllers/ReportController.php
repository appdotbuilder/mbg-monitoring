<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Distribusi;
use App\Models\Sekolah;
use App\Models\Kendaraan;
use Illuminate\Http\Request;
// use Barryvdh\DomPDF\Facade\Pdf; // Uncomment when DomPDF is installed
use Carbon\Carbon;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sekolahList = Sekolah::orderBy('nama_sekolah')->get();
        $kendaraanList = Kendaraan::orderBy('nama_kendaraan')->get();

        return view('reports.index', compact('sekolahList', 'kendaraanList'));
    }

    /**
     * Store a newly created resource in storage (Generate Report).
     */
    public function store(Request $request)
    {
        $request->validate([
            'report_type' => 'required|in:sekolah,kendaraan',
            'sekolah_id' => 'required_if:report_type,sekolah|exists:sekolah,id',
            'kendaraan_id' => 'required_if:report_type,kendaraan|exists:kendaraan,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $startDate = Carbon::parse($request->start_date);
        $endDate = Carbon::parse($request->end_date);

        if ($request->report_type === 'sekolah') {
            return $this->generateSekolahReport($request, $startDate, $endDate);
        } else {
            return $this->generateKendaraanReport($request, $startDate, $endDate);
        }
    }

    /**
     * Generate school report.
     */
    protected function generateSekolahReport(Request $request, Carbon $startDate, Carbon $endDate)
    {
        $sekolah = Sekolah::findOrFail($request->sekolah_id);

        $distribusi = Distribusi::with(['sekolah', 'kendaraan'])
            ->where('sekolah_id', $request->sekolah_id)
            ->whereBetween('tanggal_distribusi', [$startDate, $endDate])
            ->orderBy('tanggal_distribusi')
            ->get();

        $totalPorsi = $distribusi->sum('jumlah_porsi');
        $totalDistribusi = $distribusi->count();
        $distribusiSelesai = $distribusi->where('status', 'sudah')->count();
        $distribusiBelum = $distribusi->where('status', 'belum')->count();

        // For now, return HTML view instead of PDF (until DomPDF is installed)
        return view('reports.distribusi-by-sekolah', compact(
            'sekolah',
            'distribusi',
            'startDate',
            'endDate',
            'totalPorsi',
            'totalDistribusi',
            'distribusiSelesai',
            'distribusiBelum'
        ))->with('Content-Type', 'text/html');
    }

    /**
     * Generate vehicle report.
     */
    protected function generateKendaraanReport(Request $request, Carbon $startDate, Carbon $endDate)
    {
        $kendaraan = Kendaraan::findOrFail($request->kendaraan_id);

        $distribusi = Distribusi::with(['sekolah', 'kendaraan'])
            ->where('kendaraan_id', $request->kendaraan_id)
            ->whereBetween('tanggal_distribusi', [$startDate, $endDate])
            ->orderBy('tanggal_distribusi')
            ->get();

        $totalPorsi = $distribusi->sum('jumlah_porsi');
        $totalDistribusi = $distribusi->count();
        $distribusiSelesai = $distribusi->where('status', 'sudah')->count();
        $distribusiBelum = $distribusi->where('status', 'belum')->count();

        // For now, return HTML view instead of PDF (until DomPDF is installed)
        return view('reports.distribusi-by-kendaraan', compact(
            'kendaraan',
            'distribusi',
            'startDate',
            'endDate',
            'totalPorsi',
            'totalDistribusi',
            'distribusiSelesai',
            'distribusiBelum'
        ))->with('Content-Type', 'text/html');
    }
}