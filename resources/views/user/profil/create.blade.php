@extends('user.layout.app')
@section('content')
    <!-- ##### Breadcumb Area Start ##### -->
    <div class="breadcumb_area bg-img" style="background-image: url({{ asset('essence/img/bg-img/breadcumb.jpg') }});">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="page-title text-center">
                        <h2>Alamat Pengiriman</h2>
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
                <div class="col-12 col-md-12">
                    <div class="checkout_details_area mt-50 clearfix">
                        <div class="cart-page-heading mb-30">
                            <h5>Alamat Pengiriman</h5>
                        </div>

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('user.alamat.store') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
                                    <label for="provinsi">Provinsi <span>*</span></label>
                                    <select class="w-100" id="provinsi" name="provinsi">
                                        <option value="" selected>- Pilih Provinsi -</option>
                                        @foreach ($provinsis as $provinsi)
                                            <option value="{{ $provinsi->id_provinsi }}">{{ $provinsi->nama_provinsi }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
                                    <label for="kabupaten">Kabupaten <span>*</span></label>
                                    <select class="w-100" id="kabupaten" name="id_kabupaten">
                                        <option value="usa">- Pilih Kabupaten -</option>
                                    </select>
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
                                    <label for="kecamatan">Kecamatan <span>*</span></label>
                                    <input type="text" name="kecamatan" id="kecamatan" class="form-control">
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
                                    <label for="kode_pos">Kode Pos <span>*</span></label>
                                    <input type="text" name="kode_pos" id="kode_pos" class="form-control">
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
                                    <label for="nama_penerima">Nama Penerima <span>*</span></label>
                                    <input type="text" name="nama_penerima" id="nama_penerima" class="form-control">
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
                                    <label for="no_telepon_penerima">No Telepon Penerima <span>*</span></label>
                                    <input type="text" name="no_telepon_penerima" id="no_telepon_penerima"
                                        class="form-control">
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 mb-3">
                                    <label for="alamat">Alamat <span>*</span></label>
                                    <textarea name="alamat" class="form-control" id="alamat" cols="30" rows="10"></textarea>
                                </div>

                                <div class="col-lg-12 col-md-12 col-sm-12 mb-3">
                                    <button class="btn essence-btn">Tambah Alamat</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ##### Checkout Area End ##### -->
    @push('scripts')
        <script src="{{ asset('essence/js/alamat.js') }}"></script>
    @endpush
@endsection
