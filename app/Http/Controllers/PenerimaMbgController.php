<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePenerimaMbgRequest;
use App\Http\Requests\UpdatePenerimaMbgRequest;
use App\Models\PenerimaMbg;
use App\Models\Sekolah;
use Illuminate\Http\Request;

class PenerimaMbgController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = PenerimaMbg::with('sekolah');

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->get('search');
            $query->where(function ($q) use ($search) {
                $q->where('nama_siswa', 'like', "%{$search}%")
                  ->orWhere('nis', 'like', "%{$search}%")
                  ->orWhere('kelas', 'like', "%{$search}%")
                  ->orWhere('nama_orang_tua', 'like', "%{$search}%")
                  ->orWhereHas('sekolah', function ($sekolahQuery) use ($search) {
                      $sekolahQuery->where('nama_sekolah', 'like', "%{$search}%");
                  });
            });
        }

        // Filter by sekolah
        if ($request->filled('sekolah_id')) {
            $query->where('sekolah_id', $request->get('sekolah_id'));
        }

        // Filter by jenis kelamin
        if ($request->filled('jenis_kelamin')) {
            $query->where('jenis_kelamin', $request->get('jenis_kelamin'));
        }

        $penerimaMbg = $query->latest()->paginate(10)->withQueryString();
        $sekolahList = Sekolah::orderBy('nama_sekolah')->get();

        return view('penerima-mbg.index', compact('penerimaMbg', 'sekolahList'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sekolahList = Sekolah::orderBy('nama_sekolah')->get();
        
        return view('penerima-mbg.create', compact('sekolahList'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePenerimaMbgRequest $request)
    {
        PenerimaMbg::create($request->validated());

        return redirect()->route('penerima-mbg.index')
            ->with('success', 'Data penerima MBG berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(PenerimaMbg $penerimaMbg)
    {
        $penerimaMbg->load('sekolah');
        
        return view('penerima-mbg.show', compact('penerimaMbg'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PenerimaMbg $penerimaMbg)
    {
        $sekolahList = Sekolah::orderBy('nama_sekolah')->get();
        
        return view('penerima-mbg.edit', compact('penerimaMbg', 'sekolahList'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePenerimaMbgRequest $request, PenerimaMbg $penerimaMbg)
    {
        $penerimaMbg->update($request->validated());

        return redirect()->route('penerima-mbg.show', $penerimaMbg)
            ->with('success', 'Data penerima MBG berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PenerimaMbg $penerimaMbg)
    {
        $penerimaMbg->delete();

        return redirect()->route('penerima-mbg.index')
            ->with('success', 'Data penerima MBG berhasil dihapus.');
    }
}