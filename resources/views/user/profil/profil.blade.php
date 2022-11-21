@extends('user.layout.app')
@section('content')
    <!-- ##### Breadcumb Area Start ##### -->
    <div class="breadcumb_area bg-img" style="background-image: url('essence/img/bg-img/breadcumb.jpg');">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="page-title text-center">
                        <h2>EDIT PROFIL CUSTOMER</h2>
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

                <div class="col-lg-12 col-md-12">
                    <div class="checkout_details_area mt-50 clearfix">

                        <div class="cart-page-heading mb-30">
                            <h5>Edit Profil Customer</h5>
                        </div>

                        <form action="{{ route('user.update', auth()->user()->id) }}" method="post">
                            @csrf
                            @method('put')
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="name">Nama <span>*</span></label>
                                    <input type="text" placeholder="Masukan Nama Anda"
                                        class="form-control @error('name') is-invalid @enderror" id="name"
                                        value="{{ old('name', $user->name) }}" name="name" required>
                                    @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="email">Email <span>*</span></label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        id="email" name="email" placeholder="Masukan E-mail Anda"
                                        value="{{ old('email', $user->email) }}" required>

                                    @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-lg-12">
                                    <hr>
                                    <p style="color:red;font-size:12px;">* Abaikan jika tidak ingin mengganti password</p>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="password">Password <span>*</span></label>
                                    <input type="password" name="password"
                                        class="form-control @error('password') is-invalid @enderror" id="password"
                                        placeholder="Masukan Password">
                                    @error('password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="password_confirmation">Password <span>*</span></label>
                                    <input type="password" name="password_confirmation" class="form-control"
                                        placeholder="Konfirmasi Password" id="password_confirmation">

                                </div>
                                <div class="col-md-12 mb-3">
                                    <button class="btn essence-btn btn-block btn-sm">Edit Profil</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>


            </div>
        </div>
    </div>
@endsection
