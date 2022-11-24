@extends('user.layout.app')
@section('content')
    <!-- ##### Breadcumb Area Start ##### -->
    <div class="breadcumb_area bg-img" style="background-image: url({{ asset('essence/img/bg-img/breadcumb.jpg') }});">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="page-title text-center">
                        <h2>Produk</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ##### Breadcumb Area End ##### -->

    <!-- ##### Shop Grid Area Start ##### -->
    <section class="shop_grid_area section-padding-80">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-4 col-lg-3">
                    <div class="shop_sidebar_area">

                        <!-- ##### Single Widget ##### -->
                        <div class="widget catagory mb-50">
                            <!-- Widget Title -->
                            <h6 class="widget-title mb-30">Kategori</h6>

                            <!--  Catagories  -->
                            <div class="catagories-menu">
                                <ul id="menu-content2" class="menu-content collapse show">
                                    <!-- Single Item -->

                                    <li>
                                        <a href="{{ route('produk.list') }}"
                                            style="color:black;@if ($id_kategori == 0) text-decoration:underline; @endif">Semua</a>
                                    </li>
                                    @foreach ($kategoris as $kategori)
                                        <li>
                                            <a href="{{ route('produk.list.category', $kategori->id_kategori) }}"
                                                style="color:black;@if ($id_kategori == $kategori->id_kategori) text-decoration:underline; @endif">
                                                {{ $kategori->nama_kategori }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                                <input type="hidden" name="id_kategori" value="{{ $id_kategori }}" id="id_kategori">
                            </div>
                        </div>

                        <!-- ##### Single Widget ##### -->
                        <div class="widget price mb-50">
                            <!-- Widget Title -->
                            <h6 class="widget-title mb-30">Filter</h6>
                            <!-- Widget Title 2 -->
                            <p class="widget-title2 mb-30">Harga</p>
                            <div class="widget-desc">
                                <div class="slider-range">
                                    <div data-min="{{ $min_harga }}" data-max="{{ $max_harga }}" data-unit="Rp "
                                        class="slider-range-price ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all"
                                        data-value-min="{{ $min_harga }}" data-value-max="{{ $max_harga }}"
                                        data-label-result="Range:">
                                        <div class="ui-slider-range ui-widget-header ui-corner-all"></div>
                                        <span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0"></span>
                                        <span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0"></span>
                                    </div>
                                    <div class="range-price">Range: {{ rupiah($min_harga) }} - {{ rupiah($max_harga) }}
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>

                <div class="col-12 col-md-8 col-lg-9">
                    <div class="shop_grid_product_area">
                        <div class="row">
                            <div class="col-12">
                                <div class="product-topbar d-flex align-items-center justify-content-between">
                                    <!-- Total Products -->
                                    <div class="total-products">
                                        <p><span>{{ $produks->count() }}</span> products found</p>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="row" id="cardlistproduk">

                            @foreach ($produks as $produk)
                                <!-- Single Product -->
                                <div class="col-12 col-sm-6 col-lg-4">
                                    <div class="single-product-wrapper">
                                        <!-- Product Image -->
                                        <div class="product-img">
                                            <img src="{{ asset('storage/' . $produk->gambar) }}" alt="Gambar Produk"
                                                style="height:200px;">
                                        </div>

                                        <!-- Product Description -->
                                        <div class="product-description">
                                            <span>{{ $produk->kategori->nama_kategori }}</span>
                                            <a href="single-product-details.html">
                                                <h6>{{ pecah_nama($produk->nama_produk) }}</h6>
                                            </a>
                                            <p class="product-price">{{ rupiah($produk->harga) }}</p>

                                            <!-- Hover Content -->
                                            <div class="hover-content">
                                                <!-- Add to Cart -->
                                                <div class="add-to-cart-btn">
                                                    <a href="{{ route('produk.detail', $produk->id_produk) }}"
                                                        class="btn essence-btn">Detail Produk</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                    <!-- Pagination -->
                    {{ $produks->links() }}

                </div>
            </div>
        </div>
    </section>
    <!-- ##### Shop Grid Area End ##### -->

    @push('scripts')
        <script src="{{ asset('essence/js/produk.js') }}"></script>
    @endpush
@endsection
