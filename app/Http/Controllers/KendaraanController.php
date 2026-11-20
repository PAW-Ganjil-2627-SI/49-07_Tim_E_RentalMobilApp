<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KendaraanController extends Controller
{
    // READ: menampilkan daftar kendaraan
    public function index()
    {
        $kendaraan = Kendaraan::orderBy('id', 'desc')->get();

        return view('kendaraan.index', compact('kendaraan'));
    }

    // CREATE: menampilkan form tambah
    public function create()
    {
        return view('kendaraan.create');
    }

    // CREATE: menyimpan kendaraan baru
    public function store(Request $request)
    {
        $data = $request->validate([
            'nomor_plat' => 'required|string|max:20',
            'merk' => 'required|string|max:100',
            'tahun_pembuatan' => 'required|integer|min:1900|max:2099',
            'tipe_transmisi' => 'required|in:Manual,Otomatis',
        ]);

        Kendaraan::create($data);

        return redirect()->route('kendaraan.index')
            ->with('success', 'Data kendaraan berhasil ditambahkan.');
    }

    // UPDATE: menampilkan form edit
    public function edit(Kendaraan $kendaraan)
    {
        return view('kendaraan.edit', compact('kendaraan'));
    }

    // UPDATE: menyimpan perubahan
    public function update(Request $request, Kendaraan $kendaraan)
    {
        $data = $request->validate([
            'nomor_plat' => 'required|string|max:20',
            'merk' => 'required|string|max:100',
            'tahun_pembuatan' => 'required|integer|min:1900|max:2099',
            'tipe_transmisi' => 'required|in:Manual,Otomatis',
        ]);

        $kendaraan->update($data);

        return redirect()->route('kendaraan.index')
            ->with('success', 'Data kendaraan berhasil diubah.');
    }

    // DELETE: menghapus kendaraan
    public function destroy(Kendaraan $kendaraan)
    {
        $kendaraan->delete();

        return redirect()->route('kendaraan.index')
            ->with('success', 'Data kendaraan berhasil dihapus.');
    }
}