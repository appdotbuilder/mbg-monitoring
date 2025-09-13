<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreKendaraanRequest;
use App\Http\Requests\UpdateKendaraanRequest;
use App\Models\Kendaraan;
use Inertia\Inertia;

class KendaraanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kendaraan = Kendaraan::withCount('distribusi')
            ->latest()
            ->paginate(10);
        
        return Inertia::render('kendaraan/index', [
            'kendaraan' => $kendaraan
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('kendaraan/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreKendaraanRequest $request)
    {
        $kendaraan = Kendaraan::create($request->validated());

        return redirect()->route('kendaraan.show', $kendaraan)
            ->with('success', 'Data kendaraan berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kendaraan $kendaraan)
    {
        $kendaraan->load(['distribusi.sekolah']);
        
        return Inertia::render('kendaraan/show', [
            'kendaraan' => $kendaraan
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kendaraan $kendaraan)
    {
        return Inertia::render('kendaraan/edit', [
            'kendaraan' => $kendaraan
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKendaraanRequest $request, Kendaraan $kendaraan)
    {
        $kendaraan->update($request->validated());

        return redirect()->route('kendaraan.show', $kendaraan)
            ->with('success', 'Data kendaraan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kendaraan $kendaraan)
    {
        $kendaraan->delete();

        return redirect()->route('kendaraan.index')
            ->with('success', 'Data kendaraan berhasil dihapus.');
    }
}