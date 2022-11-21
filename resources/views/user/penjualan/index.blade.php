@extends('user.layout.app')
@section('content')
    <!-- ##### Breadcumb Area Start ##### -->
    <div class="breadcumb_area bg-img" style="background-image: url({{ asset('essence/img/bg-img/breadcumb.jpg') }});">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="page-title text-center">
                        <h2>Checkout</h2>
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

                <div class="col-12 col-md-12 col-lg-12 col-sm-12 mb-4">
                    <div class="order-details-confirmation">

                        <div class="cart-page-heading">
                            <h5>Alamat Pengiriman</h5>
                        </div>

                        <ul class="order-details-form mb-4">
                            <li>
                                <span>Provinsi</span> <span>{{ $alamat->kabupaten->provinsi->nama_provinsi }}</span>
                            </li>
                            <li>
                                <span>Kabupaten</span> <span>{{ $alamat->kabupaten->nama_kabupaten }}</span>
                            </li>
                            <li>
                                <span>Kecamatan</span> <span>{{ $alamat->kecamatan }}</span>
                            </li>
                            <li>
                                <span>Kode Pos</span> <span>{{ $alamat->kode_pos }}</span>
                            </li>
                            <li>
                                <span>Nama Penerima</span> <span>{{ $alamat->nama_penerima }}</span>
                            </li>
                            <li>
                                <span>No Telepon</span> <span>{{ $alamat->no_telepon_penerima }}</span>
                            </li>
                        </ul>

                        <a href="{{ route('user.alamat') }}" class="btn essence-btn">Ganti Alamat</a>
                    </div>

                </div>

                <div class="col-12 col-md-6">

                    <div class="checkout_details_area mt-50 clearfix">
                        <div class="cart-page-heading mb-30">
                            <h5>Ekspedisi</h5>
                        </div>

                        <form action="#" method="post">
                            <div class="row">
                                <div class="col-12 mb-3">
                                    <label for="ongkir">Pilih Pengiriman <span>*</span></label>
                                    <select class="w-100" id="ongkir" name="ongkir">
                                        <option value="">- Mohon Tunggu -</option>

                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-5 ml-lg-auto">
                    <div class="order-details-confirmation">

                        <div class="cart-page-heading">
                            <h5>Produk</h5>
                            <p>Detail Produk</p>
                        </div>

                        <ul class="order-details-form mb-4">
                            <li>
                                <span>Produk</span>
                                <span>Jumlah</span>
                                <span>Total</span>
                            </li>
                            @php
                                $total = 0;
                            @endphp
                            @foreach ($keranjangs as $keranjang)
                                @php
                                    $total += $keranjang->jumlah * $keranjang->produk->harga;
                                @endphp
                                <li>
                                    <span>{{ pecah_nama($keranjang->produk->nama_produk) }}</span>
                                    <span>x{{ $keranjang->jumlah }}</span>
                                    <span> {{ rupiah($keranjang->produk->harga) }}</span>
                                </li>
                            @endforeach
                            <input type="hidden" id="subtotal" value="{{ $total }}">

                            <li>
                                <span>Sub Total</span>
                                <span>{{ rupiah($total) }}</span>
                            </li>

                            <li>
                                <span>Ongkir</span>
                                <span id="spanongkir">Rp 0</span>
                            </li>

                            <li>
                                <span>Grand Total</span>
                                <span id="spangrandtotal">{{ rupiah($total) }}</span>
                            </li>
                        </ul>



                        <a href="#" class="btn essence-btn">Checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ##### Checkout Area End ##### -->

    @push('scripts')
        <script src="{{ asset('essence/js/ongkir.js') }}"></script>
    @endpush
@endsection
