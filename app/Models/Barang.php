<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Barang extends Model
{
    use HasFactory;

    /**
     * Kolom yang dapat diisi secara massal.
     *
     * @var array
     */
    protected $fillable = [
        'nama',
        'harga',
        'stok',
    ];

    /**
     * Relasi ke PembelianItem.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pembelianItems()
    {
        return $this->hasMany(PembelianItem::class);
    }
}
