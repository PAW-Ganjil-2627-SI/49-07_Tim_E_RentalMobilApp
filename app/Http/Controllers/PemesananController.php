<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class PemesananController extends Controller
{
    // READ: tampilkan form + tabel data pemesanan
    public function index(Request $request)
    {
        $daftar = Pemesanan::orderBy('id_pemesanan', 'desc')->get();
        $paketDipilih = $request->query('paket', '');

        return view('pemesanan.index', [
            'daftar' => $daftar,
            'hargaPaket' => Pemesanan::HARGA_PAKET,
            'paketDipilih' => $paketDipilih,
        ]);
    }

    // CREATE: simpan pemesanan baru
    public function store(Request $request)
    {
        $data = $this->validasi($request);

        Pemesanan::create($data);

        return redirect()->route('pemesanan.index')
            ->with('sukses', 'Data pemesanan berhasil disimpan!');
    }

    // UPDATE (1): tampilkan form edit berisi data lama
    public function edit(Pemesanan $pemesanan)
    {
        return view('pemesanan.edit', [
            'pemesanan' => $pemesanan,
            'hargaPaket' => Pemesanan::HARGA_PAKET,
        ]);
    }

    // UPDATE (2): simpan perubahan data
    public function update(Request $request, Pemesanan $pemesanan)
    {
        $data = $this->validasi($request);

        $pemesanan->update($data);

        return redirect()->route('pemesanan.index')
            ->with('sukses', 'Data pemesanan berhasil diperbarui!');
    }

    // DELETE: hapus data pemesanan
    public function destroy(Pemesanan $pemesanan)
    {
        $pemesanan->delete();

        return redirect()->route('pemesanan.index')
            ->with('sukses', 'Data pemesanan berhasil dihapus!');
    }

    // Validasi input + hitung total harga (dipakai store & update)
    private function validasi(Request $request)
    {
        $data = $request->validate([
            'nama_pelanggan' => 'required|max:100',
            'no_hp' => ['required', 'regex:/^[0-9+() .-]{8,20}$/'],
            'paket_rental' => 'required|in:' . implode(',', array_keys(Pemesanan::HARGA_PAKET)),
            'tanggal_sewa' => 'required|date_format:Y-m-d',
            'jam_mulai' => 'required|date_format:H:i',
            'tanggal_selesai' => 'required|date_format:Y-m-d',
            'jam_selesai' => 'required|date_format:H:i',
        ]);

        $mulai = Carbon::parse($data['tanggal_sewa'] . ' ' . $data['jam_mulai'], 'Asia/Jakarta');
        $selesai = Carbon::parse($data['tanggal_selesai'] . ' ' . $data['jam_selesai'], 'Asia/Jakarta');

        if ($selesai->lte($mulai)) {
            throw ValidationException::withMessages([
                'jam_selesai' => 'Tanggal dan jam selesai harus setelah waktu mulai.',
            ]);
        }

        // Durasi dibulatkan ke atas per 24 jam
        $periode = (int) ceil($mulai->diffInMinutes($selesai) / 1440);

        if ($periode > 365) {
            throw ValidationException::withMessages([
                'tanggal_selesai' => 'Durasi sewa maksimal 365 periode.',
            ]);
        }

        $data['total_harga'] = Pemesanan::HARGA_PAKET[$data['paket_rental']] * $periode;

        return $data;
    }
}