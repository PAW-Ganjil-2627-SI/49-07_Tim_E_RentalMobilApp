<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kendaraan extends Model
{
    protected $table = 'kendaraan';

    protected $fillable = [
        'nomor_plat',
        'merk',
        'tahun_pembuatan',
        'tipe_transmisi'
    ];

    public $timestamps = false;
}