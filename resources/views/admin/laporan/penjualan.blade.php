@extends('layouts.app')

@section('title', $title)

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ $title }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('dashboard.index') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Penjualan Selesai</div>
            </div>
        </div>


        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    <form action="" method="GET">
                        <div class="row">
                            <div class="col-lg-4">
                                <x-forms.input-group value="{{ request()->query('start_date') ?? date('Y-m-d') }}"
                                    name="start_date" id="start_date" label="Tanggal Awal" type="date">
                                </x-forms.input-group>
                            </div>
                            <div class="col-lg-4">
                                <x-forms.input-group value="{{ request()->query('end_date') ?? date('Y-m-d') }}"
                                    name="end_date" id="end_date" label="Tanggal Akhir" type="date">
                                </x-forms.input-group>
                            </div>
                            <div class="col-lg-3" style="margin-top:30px;">
                                <button class="btn btn-primary">Cari</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>




        <div class="section-body">

            <div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                @if (request()->query('start_date') && request()->query('end_date'))
                                <a class="btn btn-success mb-4" target="_blank"
                                    href="/dashboard/laporan/penjualan/print?start_date={{ request()->query('start_date') }}&end_date={{ request()->query('end_date') }}">Print</a>
                                @else
                                <a class="btn btn-success mb-4" target="_blank"
                                    href="/dashboard/laporan/penjualan/print">Print</a>
                                @endif

                                <table class="table-md table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Id Penjualan</th>
                                            <th>Customer</th>
                                            <th>Resi</th>
                                            <th>Pengiriman</th>
                                            <th>Total</th>
                                            <th>Harga Beli</th>
                                            <th>Keuntungan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                        $total = 0;
                                        @endphp
                                        @foreach ($penjualans as $penjualan)
                                        <tr>
                                            <td>{{ $penjualan->id_penjualan }}</td>
                                            <td>{{ $penjualan->user->name }}</td>
                                            <td>{{ $penjualan->resi }}</td>
                                            <td>{{ $penjualan->pengiriman }}</td>
                                            <td>{{ rupiah($penjualan->total) }}</td>
                                            @php
                                            $total += $penjualan->total;
                                            $totalHargaBeli = 0;
                                            foreach($penjualan->detail_penjualan as $detail_penjualan):
                                            $jumlah = $detail_penjualan->jumlah;
                                            $hargaBeli = $detail_penjualan->produk->harga_beli;
                                            $totalHargaBeli += $jumlah * $hargaBeli;
                                            endforeach;
                                            @endphp
                                            <td>{{ rupiah($totalHargaBeli) }}</td>
                                            <td>{{ rupiah($penjualan->total - $totalHargaBeli) }}</td>

                                        </tr>
                                        @endforeach
                                        <tr>
                                            <td colspan="6" class="text-center"><b>Total</b></td>
                                            <td><b>{{ rupiah($total) }}</b></td>
                                        </tr>
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