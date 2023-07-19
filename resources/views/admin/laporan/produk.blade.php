@extends('layouts.app')

@section('title', $title)

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ $title }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('dashboard.index') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Laporan Produk</div>
            </div>
        </div>


        <div class="section-body">

            <div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">

                                <a class="btn btn-success mb-4" target="_blank"
                                    href="/dashboard/laporan/produk/print">Print</a>


                                <table class="table-md table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Nama Produk</th>
                                            <th>Nama Kategori</th>
                                            <th>Stok</th>
                                            <th>Berat</th>
                                            <th>Harga</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($produks as $produk)
                                        <tr>
                                            <td>{{ $produk->nama_produk }}</td>
                                            <td>{{ $produk->kategori->nama_kategori }}</td>
                                            <td>{{ $produk->stok }}</td>
                                            <td>{{ $produk->berat }}</td>
                                            <td>{{ rupiah($produk->harga) }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
</div>




@endsection