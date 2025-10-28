<?php

namespace App\Http\Controllers;

use App\Models\Penduduk;
use App\Exports\PendudukExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class PendudukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $penduduks = Penduduk::with('kk')->get()->groupBy(function($penduduk) {
            return $penduduk->kk ? $penduduk->kk->no_kk : 'Tanpa KK';
        });
        return view('penduduk.index', compact('penduduks'));
    }

    /**
     * Export data to Excel
     */
    public function export()
    {
        return Excel::download(new PendudukExport, 'data_penduduk_' . date('Y-m-d') . '.xlsx');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kks = \App\Models\Kk::all();
        return view('penduduk.create', compact('kks'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nik' => 'required|string|unique:penduduks,nik|max:16',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat' => 'required|string',
            'pekerjaan' => 'nullable|string|max:255',
            'status_perkawinan' => 'nullable|string|max:255',
            'agama' => 'nullable|string|max:255',
            'pendidikan' => 'nullable|string|max:255',
            'jaga' => 'nullable|string|max:255',
            'kk_id' => 'nullable|exists:kks,id',
            'status_keluarga' => 'nullable|string|max:255',
        ]);

        Penduduk::create($request->all());

        return redirect()->route('penduduk.index')->with('success', 'Data penduduk berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $penduduk = Penduduk::findOrFail($id);
        return view('penduduk.show', compact('penduduk'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $penduduk = Penduduk::findOrFail($id);
        $kks = \App\Models\Kk::all();
        return view('penduduk.edit', compact('penduduk', 'kks'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $penduduk = Penduduk::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
            'nik' => 'required|string|unique:penduduks,nik,' . $id . '|max:16',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat' => 'required|string',
            'pekerjaan' => 'nullable|string|max:255',
            'status_perkawinan' => 'nullable|string|max:255',
            'agama' => 'nullable|string|max:255',
            'pendidikan' => 'nullable|string|max:255',
            'jaga' => 'nullable|string|max:255',
            'kk_id' => 'nullable|exists:kks,id',
            'status_keluarga' => 'nullable|string|max:255',
        ]);

        $penduduk->update($request->all());

        return redirect()->route('penduduk.index')->with('success', 'Data penduduk berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $penduduk = Penduduk::findOrFail($id);
        $penduduk->delete();

        return redirect()->route('penduduk.index')->with('success', 'Data penduduk berhasil dihapus.');
    }
}
