@extends('user.layout.app')
@section('content')
    <!-- ##### Breadcumb Area Start ##### -->
    <div class="breadcumb_area bg-img" style="background-image: url({{ asset('essence/img/bg-img/breadcumb.jpg') }});">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="page-title text-center">
                        <h2>Keranjang</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ##### Breadcumb Area End ##### -->

    <!-- ##### Checkout Area Start ##### -->
    <div class="checkout_area section-padding-80">
        <div class="container">
            <div class="row">

                <div class="col-lg-12 col-md-12">
                    <div class="checkout_details_area mt-50 clearfix">

                        <div class="cart-page-heading mb-30">
                            <h5>Detail Keranjang Belanja</h5>
                            @if (session()->has('success'))
                                <div class="alert alert-success" role="alert">
                                    {{ session()->get('success') }}
                                </div>
                            @endif

                        </div>
                        <div class="row">
                            <div class="col-md-12 col-lg-12 col-sm-12 mb-3">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center" scope="col" style="width:10%;">Aksi</th>
                                            <th scope="col">Produk</th>
                                            <th scope="col">Harga</th>
                                            <th scope="col" style="width: 15%;">Jumlah</th>
                                            <th scope="col">Sub Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $total = 0;
                                        @endphp
                                        @foreach ($keranjangs as $keranjang)
                                            @php
                                                $total += $keranjang->jumlah * $keranjang->produk->harga;
                                            @endphp
                                            <tr>
                                                <td class="text-center">
                                                    <button class="btn btn-danger hapuskeranjang">
                                                        <i class="fa fa-trash" data-id="{{ $keranjang->id_keranjang }}"></i>
                                                    </button>
                                                </td>
                                                <td>
                                                    <a href="{{ route('produk.detail', $keranjang->produk->id_produk) }}">
                                                        <div class="row">

                                                            <div class="col-lg-3">
                                                                <img src="{{ asset('storage/' . $keranjang->produk->gambar) }}"
                                                                    alt="" style="height: 100px;width:120px;">
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <p style="font-weight: bold;color:black;">
                                                                    {{ $keranjang->produk->nama_produk }}</p>
                                                                <p style="margin-top:-20px;">
                                                                    {{ $keranjang->produk->kategori->nama_kategori }}</p>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </td>
                                                <td>{{ rupiah($keranjang->produk->harga) }}</td>
                                                <td>
                                                    <div class="input-group">
                                                        <span class="input-group-prepend">
                                                            <button type="button"
                                                                class="btn btn-outline-secondary btn-number"
                                                                data-type="minus"
                                                                data-field="jumlah[{{ $keranjang->id_keranjang }}]">
                                                                <span class="fa fa-minus"></span>
                                                            </button>
                                                        </span>
                                                        <input type="text" name="jumlah[{{ $keranjang->id_keranjang }}]"
                                                            class="form-control input-number"
                                                            value="{{ $keranjang->jumlah }}" min="1"
                                                            max="{{ $keranjang->produk->stok }}"
                                                            data-id="{{ $keranjang->id_keranjang }}"
                                                            style="text-align:center;">
                                                        <span class="input-group-append">
                                                            <button type="button"
                                                                class="btn btn-outline-secondary btn-number"
                                                                data-type="plus"
                                                                data-field="jumlah[{{ $keranjang->id_keranjang }}]">
                                                                <span class="fa fa-plus"></span>
                                                            </button>
                                                        </span>
                                                    </div>
                                                </td>
                                                <td>{{ rupiah($keranjang->jumlah * $keranjang->produk->harga) }}</td>
                                            </tr>
                                        @endforeach


                                        <tr>
                                            <td colspan="4" class="text-center"><b>Total</b></td>
                                            <td><b id="grandtotal">{{ rupiah($total) }}</b></td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>

                            <div class="col-md-12 col-lg-12 col-sm-12 mb-3">
                                <a href="{{ route('produk.list') }}" class="btn essence-btn">Lanjut Belanja</a>
                                <a class="btn essence-btn" href="{{ route('penjualan.index') }}">Checkout</a>
                            </div>

                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>

    @push('scripts')
        <script src="{{ asset('essence/js/keranjang.js') }}"></script>
    @endpush
@endsection
