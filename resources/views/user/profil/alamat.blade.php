@extends('user.layout.app')
@section('content')
    <!-- ##### Breadcumb Area Start ##### -->
    <div class="breadcumb_area bg-img" style="background-image: url({{ asset('essence/img/bg-img/breadcumb.jpg') }});">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="page-title text-center">
                        <h2>ALAMAT CUSTOMER</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ##### Blog Wrapper Area Start ##### -->
    <div class="blog-wrapper section-padding-80">
        <div class="container">
            <div class="row">

                <div class="col-lg-12 mb-4">
                    <a class="btn essence-btn" href="{{ route('user.alamat.create') }}">Tambah Alamat Baru</a>
                </div>

                <!-- Single Blog Area -->
                @forelse($alamats as $alamat)
                    <div class="col-lg-4 col-md-4 col-sm-12">
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
                                <li>
                                    @if ($alamat->aktif)
                                        <span class="badge badge-success">Aktif</span>
                                    @else
                                        <span class="badge badge-danger">Tidak Aktif</span>
                                        <span>
                                            <form action="{{ route('user.alamat.aktif', $alamat->id_alamat) }}"
                                                method="POST">
                                                @csrf
                                                @method('PUT')
                                                <button class="badge badge-success btn-sm"
                                                    data-id="{{ $alamat->id_alamat }}" style="cursor: pointer;">
                                                    Jadikan alamat aktif
                                                </button>
                                            </form>
                                        </span>
                                    @endif
                                </li>
                            </ul>


                        </div>
                    </div>
                @empty
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="order-details-confirmation">

                            <div class="cart-page-heading">
                                <h5>Belum ada alamat :(</h5>
                            </div>


                        </div>
                @endforelse


            </div>





        </div>
    </div>
    </div>
    <!-- ##### Blog Wrapper Area End ##### -->
@endsection
