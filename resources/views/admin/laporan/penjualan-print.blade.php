<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Print Laporan Penjualan</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('library/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    @stack('style')

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <!-- END GA -->
</head>
</head>

<body>
    <div class="container" style="margin-top:20px;">

        <div class="kontain">
            <div class="isi" style="position:relative;">
                <p style="text-align:center">
                    <span style="font-family:Times New Roman,Times,serif">
                        <font size="8">{{ remove_underscore(env('NAMA_INSTANSI')) }}</font>
                    </span>
                </p>
                <p style="text-align:center">
                    <span style="font-size:15px">
                        {{ remove_underscore(env('ALAMAT_INSTANSI')) }}
                    </span>
                </p>
            </div>
        </div>
        <hr>
        @if (request()->query('start_date') && request()->query('end_date'))
        <p class="text-center">
            <b>Tanggal
                {{ date('j F Y', strtotime(request()->query('start_date'))) . ' SD ' . date('j F Y',
                strtotime(request()->query('end_date'))) }}</b>
        </p>
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
                    <td colspan="5" class="text-center"><b>Total</b></td>
                    <td colspan="2" class="text-center"><b>{{ rupiah($total) }}</b></td>
                </tr>
            </tbody>
        </table>
    </div>

    <script>
        window.print();
    </script>

</body>


</html>