<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Print Laporan Produk</title>

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


        <table class="table-md table table-bordered">
            <thead>
                <tr>
                    <th>Nama Produk</th>
                    <th>Nama Kategori</th>
                    <th>Stok</th>
                    <th>Berat</th>
                    <th>Harga</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($produks as $produk)
                <tr>
                    <td>{{ $produk->nama_produk }}</td>
                    <td>{{ $produk->kategori->nama_kategori }}</td>
                    <td>{{ $produk->stok }}</td>
                    <td>{{ $produk->berat }}</td>
                    <td>{{ rupiah($produk->harga) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
        window.print();
    </script>

</body>


</html>