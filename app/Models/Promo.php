<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
    protected $fillable = [
        'nama', 'deskripsi', 'diskon', 'status', 'tanggal_mulai', 'tanggal_berakhir'
    ];
    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_berakhir' => 'date',
    ];
}
