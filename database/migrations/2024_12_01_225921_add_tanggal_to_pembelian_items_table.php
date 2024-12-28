<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('pembelian_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('barang_id')->constrained();
            $table->foreignId('pembelian_id')->constrained();
            $table->date('tanggal')->nullable(); // Pastikan `nullable` jika nilai bisa kosong
            $table->integer('jumlah');
            $table->decimal('harga', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pembelian_items', function (Blueprint $table) {
            //
        });
    }
};
