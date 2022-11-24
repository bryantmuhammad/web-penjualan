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

            <div class="row">
                <div class="col-lg-12">
                    <label for="">Jumlah : </label>
                </div>
                <div class="col-lg-4">
                    <div class="input-group">
                        <span class="input-group-prepend">
                            <button type="button" class="btn btn-outline-secondary btn-number" data-type="minus"
                                data-field="jumlah[{{ $produk->id_produk }}]">
                                <span class="fa fa-minus"></span>
                            </button>
                        </span>
                        <input type="text" name="jumlah[{{ $produk->id_produk }}]" class="form-control input-number"
                            value="1" min="1" max="{{ $produk->stok }}" data-id="{{ $produk->id_produk }}"
                            style="text-align:center;height:38px;" readonly>
                        <span class="input-group-append">
                            <button type="button" class="btn btn-outline-secondary btn-number" data-type="plus"
                                data-field="jumlah[{{ $produk->id_produk }}]">
                                <span class="fa fa-plus"></span>
                            </button>
                        </span>
                    </div>
                </div>
            </div>

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
                        <input type="hidden" name="jumlah" id="jumlah" value="1">
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

    @push('scripts')
        <script>
            $(".btn-number").click(function(e) {
                e.preventDefault();

                fieldName = $(this).attr("data-field");
                type = $(this).attr("data-type");
                const input = $("input[name='" + fieldName + "']");
                const currentVal = parseInt(input.val());
                const idKeranjang = input.data("id");

                if (!isNaN(currentVal)) {
                    if (type == "minus") {
                        if (currentVal > input.attr("min")) {
                            input.val(currentVal - 1).change();
                        }
                        if (parseInt(input.val()) == input.attr("min")) {
                            $(this).attr("disabled", true);
                        }
                    } else if (type == "plus") {
                        if (currentVal < input.attr("max")) {
                            input.val(currentVal + 1).change();
                        }
                        if (parseInt(input.val()) == input.attr("max")) {
                            $(this).attr("disabled", true);
                        }
                    }

                    document.getElementById('jumlah').value = input.val()
                } else {
                    input.val(0);
                }
            });
            $(".input-number").focusin(function() {
                $(this).data("oldValue", $(this).val());
            });
            $(".input-number").change(function() {
                minValue = parseInt($(this).attr("min"));
                maxValue = parseInt($(this).attr("max"));
                valueCurrent = parseInt($(this).val());

                name = $(this).attr("name");
                if (valueCurrent >= minValue) {
                    $(
                        ".btn-number[data-type='minus'][data-field='" + name + "']"
                    ).removeAttr("disabled");
                } else {
                    alert("Sorry, the minimum value was reached");
                    $(this).val($(this).data("oldValue"));
                }
                if (valueCurrent <= maxValue) {
                    $(
                        ".btn-number[data-type='plus'][data-field='" + name + "']"
                    ).removeAttr("disabled");
                } else {
                    alert("Sorry, the maximum value was reached");
                    $(this).val($(this).data("oldValue"));
                }
            });
        </script>
    @endpush
@endsection
