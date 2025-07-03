<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockHistories extends Model
{
    protected $table = 'stock_histories';

    protected $fillable = [
        'product_id',
        'jumlah',
        'tipe',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
