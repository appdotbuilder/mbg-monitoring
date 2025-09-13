<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSekolahRequest;
use App\Http\Requests\UpdateSekolahRequest;
use App\Models\Sekolah;


class SekolahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sekolah = Sekolah::withCount(['penerimaMbg', 'distribusi'])
            ->latest()
            ->paginate(10);
        
        return view('sekolah.index', ['sekolah' => $sekolah]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('sekolah.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSekolahRequest $request)
    {
        $sekolah = Sekolah::create($request->validated());

        return redirect()->route('sekolah.show', $sekolah)
            ->with('success', 'Data sekolah berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Sekolah $sekolah)
    {
        $sekolah->load(['penerimaMbg', 'distribusi.kendaraan']);
        
        return view('sekolah.show', ['sekolah' => $sekolah]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sekolah $sekolah)
    {
        return view('sekolah.edit', ['sekolah' => $sekolah]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSekolahRequest $request, Sekolah $sekolah)
    {
        $sekolah->update($request->validated());

        return redirect()->route('sekolah.show', $sekolah)
            ->with('success', 'Data sekolah berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sekolah $sekolah)
    {
        $sekolah->delete();

        return redirect()->route('sekolah.index')
            ->with('success', 'Data sekolah berhasil dihapus.');
    }
}