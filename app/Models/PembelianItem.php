<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PembelianItem extends Model
{
    use HasFactory;

    /**
     * Fillable attributes for mass assignment.
     *
     * @var array
     */
    protected $fillable = [
        'tanggal_pembelian',
        'supplier',
        'email_supplier',
        'jumlah_barang',
        'total_harga',
        'barang_id',
        'jumlah',
        'harga',
        'pembelian_id',
        'tanggal',
        'updated_at',
        'created_at',
    ];

    /**
     * Get the barang that owns the PembelianItem.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function barang(): BelongsTo
    {
        return $this->belongsTo(Barang::class);
    }
}
