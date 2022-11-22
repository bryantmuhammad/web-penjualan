@extends('user.layout.app')
@section('content')
    <!-- ##### Single Product Details Area Start ##### -->
    <section class="single_product_details_area d-flex align-items-center">

        <!-- Single Product Thumb -->
        <div class="single_product_thumb clearfix">
            <div class="product_thumbnail_slides owl-carousel">
                <img src="{{ asset('storage/' . $produk->gambar) }}" alt="">
                <img src="{{ asset('storage/' . $produk->gambar) }}" alt="">
                <img src="{{ asset('storage/' . $produk->gambar) }}" alt="">
            </div>
        </div>

        <!-- Single Product Description -->
        <div class="single_product_desc clearfix">
            <span>{{ $produk->kategori->nama_kategori }}</span>
            <a href="cart.html">
                <h2>{{ $produk->nama_produk }}</h2>
            </a>
            <p class="product-price"> {{ rupiah($produk->harga) }}</p>
            <span>Stok : {{ $produk->stok }}</span>
            <p class="product-desc">{{ $produk->keterangan }}</p>

            <!-- Form -->
            <form class="cart-form clearfix" action="{{ route('keranjang.tambah') }}" method="post">
                @csrf
                <!-- Select Box -->
                <div class="select-box d-flex mt-50 mb-30">

                </div>
                <!-- Cart & Favourite Box -->
                <div class="cart-fav-box d-flex align-items-center">
                    <!-- Cart -->

                    @auth
                        <input type="hidden" name="id_produk" value="{{ $produk->id_produk }}">
                        <button type="submit" name="addtocart" value="5" class="btn essence-btn">Tambahkan Ke
                            Keranjang
                        </button>
                    @else
                        <button type="submit" name="addtocart" value="5" class="btn essence-btn">
                            Login Dulu
                        </button>
                    @endauth


                </div>
            </form>
        </div>
    </section>
    <!-- ##### Single Product Details Area End ##### -->


    @if ($errors->any())
        @push('scripts')
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Terjadi Kesalahan',
                    text: 'Silahkan coba beberapa saat lagi',
                    timer: 900
                })
            </script>
        @endpush
    @endif
@endsection
