<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    // Jika kolom user_id ada di tabel orders
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Jika ada relasi lain misal produk
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
