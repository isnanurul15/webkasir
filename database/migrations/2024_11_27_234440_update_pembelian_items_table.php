<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePembelianItemsTable extends Migration
{
    public function up(): void
    {
        Schema::table('pembelian_items', function (Blueprint $table) {
            // Mengecek apakah kolom 'barang_id' sudah ada, jika belum baru ditambahkan
            if (!Schema::hasColumn('pembelian_items', 'barang_id')) {
                $table->unsignedBigInteger('barang_id')->after('id');
            }

            // Mengecek apakah kolom 'jumlah' sudah ada
            if (!Schema::hasColumn('pembelian_items', 'jumlah')) {
                $table->integer('jumlah')->after('barang_id');
            }

            // Mengecek apakah kolom 'harga' sudah ada
            if (!Schema::hasColumn('pembelian_items', 'harga')) {
                $table->decimal('harga', 10, 2)->after('jumlah');
            }

            // Mengecek apakah kolom 'pembelian_id' sudah ada
            if (!Schema::hasColumn('pembelian_items', 'pembelian_id')) {
                $table->unsignedBigInteger('pembelian_id')->after('harga');
            }
        });
    }

    public function down(): void
    {
        Schema::table('pembelian_items', function (Blueprint $table) {
            $table->dropColumn(['barang_id', 'jumlah', 'harga', 'pembelian_id']);
        });
    }
}
