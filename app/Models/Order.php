<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id', 'total', 'status', 'metode_pembayaran', 'status_pembayaran', 'bukti_pembayaran', 'tipe_pesanan'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
        public function ulasan()
    {
        return $this->hasOne(\App\Models\Ulasan::class);
    }
}
