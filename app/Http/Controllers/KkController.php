<?php

namespace App\Http\Controllers;

use App\Models\Kk;
use App\Exports\KkExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class KkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kks = Kk::with('penduduks')->get();
        return view('kk.index', compact('kks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kk.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kepala_keluarga' => 'required|string|max:255',
            'alamat' => 'required|string',
            'jaga' => 'nullable|string|max:255',
            'anggota' => 'required|array|min:1',
            'anggota.*.nama' => 'required|string|max:255',
            'anggota.*.nik' => 'nullable|string|min:10|max:20',
            'anggota.*.status_keluarga' => 'required|string|max:255',
            'anggota.*.status_perkawinan' => 'nullable|string|max:255',
            'anggota.*.jenis_kelamin' => 'required|in:L,P',
            'anggota.*.tanggal_lahir' => 'required|date',
            'anggota.*.pendidikan' => 'nullable|string|max:255',
            'anggota.*.pekerjaan' => 'nullable|string|max:255',
        ]);

        // Create KK
        $kk = Kk::create([
            'kepala_keluarga' => $request->kepala_keluarga,
            'alamat' => $request->alamat,
            'jaga' => $request->jaga,
        ]);

        // Create family members
        foreach ($request->anggota as $anggota) {
            \App\Models\Penduduk::create([
                'nama' => $anggota['nama'],
                'nik' => $anggota['nik'],
                'tanggal_lahir' => $anggota['tanggal_lahir'],
                'jenis_kelamin' => $anggota['jenis_kelamin'],
                'alamat' => $request->alamat, // Use KK address
                'pekerjaan' => $anggota['pekerjaan'] ?? null,
                'status_perkawinan' => $anggota['status_perkawinan'] ?? null,
                'agama' => null,
                'pendidikan' => $anggota['pendidikan'] ?? null,
                'jaga' => $request->jaga,
                'kk_id' => $kk->id,
                'status_keluarga' => $anggota['status_keluarga'],
            ]);
        }

        return redirect()->route('kk.index')->with('success', 'Data KK dan anggota keluarga berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $kk = Kk::with('penduduks')->findOrFail($id);
        return view('kk.show', compact('kk'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $kk = Kk::with('penduduks')->findOrFail($id);
        return view('kk.edit', compact('kk'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $kk = Kk::findOrFail($id);

        $request->validate([
            'kepala_keluarga' => 'required|string|max:255',
            'alamat' => 'required|string',
            'jaga' => 'nullable|string|max:255',
            'anggota' => 'required|array|min:1',
            'anggota.*.id' => 'nullable|exists:penduduks,id',
            'anggota.*.nama' => 'required|string|max:255',
            'anggota.*.nik' => 'nullable|string|min:10|max:20',
            'anggota.*.status_keluarga' => 'required|string|max:255',
            'anggota.*.status_perkawinan' => 'nullable|string|max:255',
            'anggota.*.jenis_kelamin' => 'required|in:L,P',
            'anggota.*.tanggal_lahir' => 'required|date',
            'anggota.*.pendidikan' => 'nullable|string|max:255',
            'anggota.*.pekerjaan' => 'nullable|string|max:255',
        ]);

        // Update KK data
        $kk->update([
            'kepala_keluarga' => $request->kepala_keluarga,
            'alamat' => $request->alamat,
            'jaga' => $request->jaga,
        ]);

        // Get existing member IDs from request
        $submittedIds = collect($request->anggota)->pluck('id')->filter()->toArray();
        
        // Delete members that are not in the submitted data
        $kk->penduduks()->whereNotIn('id', $submittedIds)->delete();

        // Update or create family members
        foreach ($request->anggota as $anggotaData) {
            if (!empty($anggotaData['id'])) {
                // Update existing member
                \App\Models\Penduduk::where('id', $anggotaData['id'])->update([
                    'nama' => $anggotaData['nama'],
                    'nik' => $anggotaData['nik'],
                    'tanggal_lahir' => $anggotaData['tanggal_lahir'],
                    'jenis_kelamin' => $anggotaData['jenis_kelamin'],
                    'alamat' => $request->alamat,
                    'pekerjaan' => $anggotaData['pekerjaan'] ?? null,
                    'status_perkawinan' => $anggotaData['status_perkawinan'] ?? null,
                    'pendidikan' => $anggotaData['pendidikan'] ?? null,
                    'jaga' => $request->jaga,
                    'status_keluarga' => $anggotaData['status_keluarga'],
                ]);
            } else {
                // Create new member
                \App\Models\Penduduk::create([
                    'nama' => $anggotaData['nama'],
                    'nik' => $anggotaData['nik'],
                    'tanggal_lahir' => $anggotaData['tanggal_lahir'],
                    'jenis_kelamin' => $anggotaData['jenis_kelamin'],
                    'alamat' => $request->alamat,
                    'pekerjaan' => $anggotaData['pekerjaan'] ?? null,
                    'status_perkawinan' => $anggotaData['status_perkawinan'] ?? null,
                    'agama' => null,
                    'pendidikan' => $anggotaData['pendidikan'] ?? null,
                    'jaga' => $request->jaga,
                    'kk_id' => $kk->id,
                    'status_keluarga' => $anggotaData['status_keluarga'],
                ]);
            }
        }

        return redirect()->route('kk.index')->with('success', 'Data KK dan anggota keluarga berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kk = Kk::findOrFail($id);
        $kk->delete();

        return redirect()->route('kk.index')->with('success', 'Data KK berhasil dihapus.');
    }

    /**
     * Export KK data to Excel
     */
    public function export(Request $request)
    {
        $jaga = $request->get('jaga');
        $filename = 'data-kk';
        
        if ($jaga) {
            $filename .= '-jaga-' . $jaga;
        }
        
        $filename .= '-' . date('Y-m-d-His') . '.xlsx';
        
        return Excel::download(new KkExport($jaga), $filename);
    }
}
