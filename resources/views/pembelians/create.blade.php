@extends('layouts.app') <!-- Gunakan layout utama jika ada -->

@section('content')
<h1>Form Pembelian</h1>

<form method="POST" action="{{ route('pembelians.store') }}">
    @csrf
    <div>
        <label for="tanggal_pembelian">Tanggal Pembelian</label>
        <input type="date" name="tanggal_pembelian" id="tanggal_pembelian" required>
    </div>

    <div>
        <label for="supplier">Supplier</label>
        <input type="text" name="supplier" id="supplier" placeholder="Masukkan nama supplier" required>
    </div>

    <div>
        <label for="email_supplier">Email Supplier</label>
        <input type="email" name="email_supplier" id="email_supplier" placeholder="Masukkan email supplier" required>
    </div>

    <div class="bg-primary-500 text-blue p-4">
    Ini adalah contoh dengan latar belakang warna kustom.
    </div>

    <button type="submit">Simpan</button>
</form>
@endsection
