@extends('layouts.main')

@section('content')

<div class="container mt-5">
    <div class="text-center mb-3">
        <a href="{{ route('list-product-by-user', ['id' => $user->id]) }}" class="btn btn-primary">Kembali ke Halaman Admin</a>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5>Nama Akun: {{ $user->nama_akun }}</h5>
                    <h5>Email: {{ $user->email }}</h5>
                    <h5>Gender: {{ $user->gender }}</h5>
                    <h5>Umur: {{ $user->umur }}</h5>
                    <h5>Tanggal Lahir: {{ $user->tgl_lahir }}</h5>
                    <h5>Alamat: {{ $user->alamat }}</h5>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5>Nama Toko: {{ $user->nama_toko }}</h5>
                    <h5>Rate: {{ $user->rate }}</h5>
                    <h5>Produk Terbaik: {{ $user->produk_terbaik }}</h5>
                    <h5>Deskripsi: {{ $user->deskripsi }}</h5>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
