@extends('user.layout.app')
@section('content')
    <!-- ##### Breadcumb Area Start ##### -->
    <div class="breadcumb_area bg-img" style="background-image: url({{ asset('essence/img/bg-img/breadcumb.jpg') }});">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="page-title text-center">
                        <h2>Detail Pembelian</h2>
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

                @if ($penjualan->status == 3)
                    <div class="col-12 mb-4">
                        <button class="btn essence-btn diterima" data-id="{{ $penjualan->id_penjualan }}">Produk Sudah
                            Diterima</button>
                    </div>
                @endif

                <div class="col-md-6 col-lg-6 col-sm-12 mb-4">
                    <div class="order-details-confirmation">

                        <div class="cart-page-heading">
                            <h5>Alamat Pengiriman</h5>
                        </div>

                        <ul class="order-details-form mb-4">
                            <li>
                                <span>Provinsi</span>
                                <span>{{ $penjualan->alamat_pengiriman->kabupaten->provinsi->nama_provinsi }}</span>
                            </li>
                            <li>
                                <span>Kabupaten</span>
                                <span>{{ $penjualan->alamat_pengiriman->kabupaten->nama_kabupaten }}</span>
                            </li>
                            <li>
                                <span>Kecamatan</span>
                                <span>{{ $penjualan->alamat_pengiriman->kecamatan }}</span>
                            </li>
                            <li>
                                <span>Kode Pos</span>
                                <span>{{ $penjualan->alamat_pengiriman->kode_pos }}</span>
                            </li>
                            <li>
                                <span>Nama Penerima</span>
                                <span>{{ $penjualan->alamat_pengiriman->nama_penerima }}</span>
                            </li>
                            <li>
                                <span>No Telepon</span>
                                <span>{{ $penjualan->alamat_pengiriman->no_telepon_penerima }}</span>
                            </li>
                        </ul>
                    </div>

                </div>

                <div class="col-md-6 col-lg-6 col-sm-12 mb-4">
                    <div class="order-details-confirmation">

                        <div class="cart-page-heading">
                            <h5>Informasi Pengiriman & Pembayaran</h5>
                        </div>

                        <ul class="order-details-form mb-4">
                            <li>
                                <span>Tanggal Pembelian</span>
                                <span>{{ $penjualan->created_at->isoFormat('D MMMM Y') }}</span>
                            </li>
                            <li>
                                <span>Ekspedisi</span>
                                <span>{{ $penjualan->pengiriman }}</span>
                            </li>
                            <li>
                                <span>Estimasi</span>
                                <span>{{ $penjualan->estimasi }} Hari</span>
                            </li>
                            <li>
                                <span>Resi</span>
                                <span>{{ $penjualan->resi }}</span>
                            </li>
                            <li>
                                <span>Status</span>
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
                            </li>
                            <li>
                                <span>Cara Membayar</span>
                                <span>
                                    <a href="{{ $penjualan->pdf }}" target="_blank" class="badge badge-info">
                                        Cara
                                        Membayar
                                    </a>
                                </span>
                            </li>

                        </ul>
                    </div>

                </div>

                <div class="col-12 col-md-12 col-lg-12 ml-lg-auto">
                    <hr>
                    <div class="cart-page-heading mb-30">
                        <h5>Detail Produk</h5>
                    </div>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">Produk</th>
                                <th scope="col">Harga</th>
                                <th scope="col" style="width: 15%;" class="text-center">Jumlah</th>
                                <th scope="col" class="text-center">Sub Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($penjualan->detail_penjualan as $detail_penjualan)
                                <tr>
                                    <td>
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <img src="{{ asset('storage/' . $detail_penjualan->produk->gambar) }}"
                                                    alt="" style="height: 100px;width:120px;">
                                            </div>
                                            <div class="col-lg-6">
                                                <p style="font-weight: bold;color:black;">
                                                    {{ $detail_penjualan->produk->nama_produk }}</p>
                                                <p style="margin-top:-20px;">
                                                    {{ $detail_penjualan->produk->kategori->nama_kategori }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ rupiah($detail_penjualan->produk->harga) }}</td>
                                    <td class="text-center">
                                        {{ $detail_penjualan->jumlah }}
                                    </td>
                                    <td class="text-center">
                                        {{ rupiah($detail_penjualan->jumlah * $detail_penjualan->produk->harga) }}</td>
                                </tr>
                            @endforeach

                            <tr>
                                <td colspan="3" class="text-center"><b>Sub Total</b></td>
                                <td class="text-center"><b>{{ rupiah($penjualan->total - $penjualan->ongkir) }}</b></td>
                            </tr>
                            <tr>
                                <td colspan="3" class="text-center"><b>Ongkir</b></td>
                                <td class="text-center"><b>{{ rupiah($penjualan->ongkir) }}</b></td>
                            </tr>
                            <tr>
                                <td colspan="3" class="text-center"><b>Total</b></td>
                                <td class="text-center"><b>{{ rupiah($penjualan->total) }}</b></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
    @push('scripts')
        <script>
            const buttonDiterima = document.querySelector('.diterima');
            buttonDiterima.addEventListener('click', function(e) {

                e.preventDefault();

                Swal.fire({
                    title: "Barang sudah diterima?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Ya, sudah!",
                }).then((result) => {
                    if (result.isConfirmed) {
                        const idPenjualan = e.target.dataset.id;
                        const request = new Request(`${core.baseUrl}/penjualan/${idPenjualan}/diterima`, {
                            method: 'PUT',
                            headers: {
                                "X-CSRF-TOKEN": core.csrfToken,
                                Accept: "application/json",
                            },
                        });

                        fetch(request)
                            .then(response => response.json())
                            .then(response => {
                                Swal.fire({
                                    title: response.message,
                                    icon: response.status,
                                    showConfirmButton: false,
                                    timer: 900,
                                }).then(res => {
                                    location.reload();
                                });
                            })
                    }
                });
            })
        </script>
    @endpush
@endsection
