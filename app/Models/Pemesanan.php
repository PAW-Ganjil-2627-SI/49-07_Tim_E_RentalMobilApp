<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    // Nama tabel di database (tabel lama dari db_rental_mobil)
    protected $table = 'pemesanan';

    // Primary key tabel
    protected $primaryKey = 'id_pemesanan';

    // Tabel tidak punya kolom created_at dan updated_at
    public $timestamps = false;

    // Kolom yang boleh diisi lewat form
    protected $fillable = [
        'nama_pelanggan',
        'no_hp',
        'paket_rental',
        'tanggal_sewa',
        'jam_mulai',
        'tanggal_selesai',
        'jam_selesai',
        'total_harga',
    ];

    // Daftar harga paket per 24 jam
    public const HARGA_PAKET = [
        'Lepas Kunci' => 350000,
        'All-in' => 500000,
        'Luar Kota' => 750000,
    ];

    // Status otomatis berdasarkan waktu sewa
    public function status()
    {
        $sekarang = Carbon::now('Asia/Jakarta');
        $mulai = Carbon::parse($this->tanggal_sewa . ' ' . $this->jam_mulai, 'Asia/Jakarta');
        $selesai = Carbon::parse($this->tanggal_selesai . ' ' . $this->jam_selesai, 'Asia/Jakarta');

        if ($sekarang->lt($mulai)) {
            return ['Pending', 'badge-pending'];
        }

        if ($sekarang->lte($selesai)) {
            return ['Berjalan', 'badge-berjalan'];
        }

        return ['Selesai', 'badge-selesai'];
    }
}