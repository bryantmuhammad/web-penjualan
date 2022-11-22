@extends('user.layout.app')
@section('content')
    <!-- ##### Breadcumb Area Start ##### -->
    <div class="breadcumb_area bg-img" style="background-image: url({{ asset('essence/img/bg-img/breadcumb.jpg') }});">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="page-title text-center">
                        <h2>List Pembelian</h2>
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
                            <h5>Detail Pembelian</h5>
                        </div>
                        <div class="row">
                            @foreach ($penjualans as $penjualan)
                                <div class="col-md-12 col-lg-12 col-sm-12 mb-3">
                                    <a href="{{ route('penjualan.show', $penjualan->id_penjualan) }}">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th scope="col">
                                                        <p style="font-weight: bold;color:black;">Belanja</p>
                                                        <p style="margin-top:-20px;">
                                                            {{ $penjualan->created_at->isoFormat('D MMMM Y') }}</p>
                                                        @if ($penjualan->status == 1)
                                                            <span class="badge badge-danger">
                                                                Belum Membayar
                                                            </span>
                                                        @endif
                                                        @if ($penjualan->status == 2)
                                                            <span class="badge badge-info">
                                                                Sudah Membayar
                                                            </span>
                                                        @endif
                                                        @if ($penjualan->status == 3)
                                                            <span class="badge badge-warning">
                                                                Sedang Dikirim
                                                            </span>
                                                        @endif
                                                        @if ($penjualan->status == 4)
                                                            <span class="badge badge-success">
                                                                Sudah Diterima
                                                            </span>
                                                        @endif
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                @foreach ($penjualan->detail_penjualan as $detail_penjualan)
                                                    <tr>
                                                        <td>
                                                            <div class="row">
                                                                <div class="col-lg-2">
                                                                    <img src="{{ asset('storage/' . $detail_penjualan->produk->gambar) }}"
                                                                        alt="" style="height: 120px;width:150px;">
                                                                </div>
                                                                <div class="col-lg-6 text-left">
                                                                    <p style="font-weight: bold;color:black;">
                                                                        {{ $detail_penjualan->produk->nama_produk }}</p>
                                                                    <p style="margin-top:-20px;">
                                                                        {{ $detail_penjualan->produk->kategori->nama_kategori }}
                                                                    </p>
                                                                    <p style="margin-top:-20px;">
                                                                        {{ $detail_penjualan->jumlah }} Produk</p>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                <tr>
                                                    <td>
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <p style="font-weight: bold;color:black;">
                                                                    Total Belanja</p>
                                                                <p style="margin-top:-20px;">{{ rupiah($penjualan->total) }}
                                                                </p>
                                                            </div>


                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </a>
                                </div>
                            @endforeach
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
