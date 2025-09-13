<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDistribusiRequest;
use App\Http\Requests\UpdateDistribusiRequest;
use App\Models\Distribusi;
use App\Models\Kendaraan;
use App\Models\Sekolah;
use Inertia\Inertia;

class DistribusiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $distribusi = Distribusi::with(['sekolah', 'kendaraan'])
            ->latest('tanggal_distribusi')
            ->paginate(15);
        
        return Inertia::render('distribusi/index', [
            'distribusi' => $distribusi
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sekolahOptions = Sekolah::select('id', 'nama_sekolah')->get();
        $kendaraanOptions = Kendaraan::aktif()->select('id', 'nama_kendaraan', 'plat_nomor')->get();
        
        return Inertia::render('distribusi/create', [
            'sekolahOptions' => $sekolahOptions,
            'kendaraanOptions' => $kendaraanOptions,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDistribusiRequest $request)
    {
        $data = $request->validated();
        
        // Handle photo upload
        if ($request->hasFile('foto_distribusi')) {
            $data['foto_distribusi'] = $request->file('foto_distribusi')
                ->store('distribusi', 'public');
        }

        $distribusi = Distribusi::create($data);

        return redirect()->route('distribusi.show', $distribusi)
            ->with('success', 'Data distribusi berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Distribusi $distribusi)
    {
        $distribusi->load(['sekolah', 'kendaraan']);
        
        return Inertia::render('distribusi/show', [
            'distribusi' => $distribusi
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Distribusi $distribusi)
    {
        $sekolahOptions = Sekolah::select('id', 'nama_sekolah')->get();
        $kendaraanOptions = Kendaraan::aktif()->select('id', 'nama_kendaraan', 'plat_nomor')->get();
        
        return Inertia::render('distribusi/edit', [
            'distribusi' => $distribusi,
            'sekolahOptions' => $sekolahOptions,
            'kendaraanOptions' => $kendaraanOptions,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDistribusiRequest $request, Distribusi $distribusi)
    {
        $data = $request->validated();
        
        // Handle photo upload
        if ($request->hasFile('foto_distribusi')) {
            $data['foto_distribusi'] = $request->file('foto_distribusi')
                ->store('distribusi', 'public');
        }

        $distribusi->update($data);

        return redirect()->route('distribusi.show', $distribusi)
            ->with('success', 'Data distribusi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Distribusi $distribusi)
    {
        $distribusi->delete();

        return redirect()->route('distribusi.index')
            ->with('success', 'Data distribusi berhasil dihapus.');
    }
}