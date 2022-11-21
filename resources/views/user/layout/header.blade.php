<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title  -->
    <title>Essence - {{ $title ?? '' }}</title>

    <!-- Favicon  -->
    <link rel="icon" href="{{ asset('essence/img/core-img/favicon.ico') }}">

    <!-- Core Style CSS -->
    <link rel="stylesheet" href="{{ asset('essence/css/core-style.css') }}">
    <link rel="stylesheet" href="{{ asset('essence/style.css') }}">



    <style>
        .nice-select.open .list {
            max-height: 300px;
            overflow-y: scroll;
        }
    </style>
</head>

<body>
    <!-- ##### Header Area Start ##### -->
    <header class="header_area">
        <div class="classy-nav-container breakpoint-off d-flex align-items-center justify-content-between">
            <!-- Classy Menu -->
            <nav class="classy-navbar" id="essenceNav">
                <!-- Logo -->
                <a class="nav-brand" href="/"><img src="{{ asset('essence/img/core-img/logo.png') }}"
                        alt=""></a>
                <!-- Navbar Toggler -->
                <div class="classy-navbar-toggler">
                    <span class="navbarToggler"><span></span><span></span><span></span></span>
                </div>
                <!-- Menu -->
                <div class="classy-menu">
                    <!-- close btn -->
                    <div class="classycloseIcon">
                        <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                    </div>
                    <!-- Nav Start -->
                    <div class="classynav">
                        <ul>
                            <li><a href="{{ route('produk.list') }}">Produk</a></li>


                            <li><a href="#">Pages</a>
                                <ul class="dropdown">
                                    <li><a href="index.html"></a></li>

                                </ul>
                            </li>

                            @can('crud_customer')
                                <li><a href="#">Hi, {{ auth()->user()->name }}</a>
                                    <ul class="dropdown">
                                        <li><a href="{{ route('user.profil') }}">Profil</a></li>
                                        <li><a href="{{ route('user.alamat') }}">Alamat</a></li>
                                    </ul>
                                </li>
                            @endcan


                        </ul>
                    </div>
                    <!-- Nav End -->
                </div>
            </nav>

            <!-- Header Meta Data -->
            <div class="header-meta d-flex clearfix justify-content-end">

                <!-- User Login Info -->
                @auth

                    <div class="user-login-info">
                        <form method="post" action="{{ route('logout') }}" id="formLogout">
                            @csrf
                            <a href="javascript:void(0)" onclick="document.getElementById('formLogout').submit()">LOGOUT</a>
                        </form>
                        {{-- <a href="{{ route('user.login') }}">LOGIN</a> --}}
                    </div>
                @else
                    <div class="user-login-info">
                        <a href="{{ route('user.login') }}">LOGIN</a>
                    </div>
                @endauth

                <!-- Cart Area -->
                <div class="cart-area">
                    <a href="{{ route('keranjang.listkeranjang') }}" id="essenceCartBstn"><img
                            src="{{ asset('essence/img/core-img/bag.svg') }}" alt="">
                        <span id="jumlahkeranjang"></span></a>
                </div>
            </div>

        </div>
    </header>
    <!-- ##### Header Area End ##### -->
