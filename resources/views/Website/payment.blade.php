<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>My Wallet | Dashboard</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
    <link rel="icon" href="assets/img/kaiadmin/favicon.ico" type="image/x-icon" />

    <!-- Fonts and icons -->
    <script src="assets/js/plugin/webfont/webfont.min.js"></script>
    <script>
        WebFont.load({
            google: {
                families: ["Public Sans:300,400,500,600,700"]
            },
            custom: {
                families: [
                    "Font Awesome 5 Solid",
                    "Font Awesome 5 Regular",
                    "Font Awesome 5 Brands",
                    "simple-line-icons",
                ],
                urls: ["assets/css/fonts.min.css"],
            },
            active: function() {
                sessionStorage.fonts = true;
            },
        });
    </script>

    <!---------- Sweet Alert ---------->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/css/plugins.min.css" />
    <link rel="stylesheet" href="assets/css/kaiadmin.min.css" />

</head>

<body>
    @extends('Website.layout')
    @section('main')
        @if (session('success'))
            <script>
                swal({
                    icon: "success",
                    title: "Payment Done Successfully",
                    button: "Ok",
                });
            </script>
        @endif
        {{-- @if (session('error_balance'))
            <script>
                swal({
                    icon: "warning",
                    title: "Wallet Balance Limit Crossed!",
                    text: "Add Money Into Wallet",
                    button: "Ok",
                });
            </script>
        @endif --}}
        @if (session('lessAmount'))
            <script>
                swal({
                    icon: "warning",
                    title: "Insufficient wallet balance!",
                    button: "Ok",
                });
            </script>
        @endif
        <div class="page-inner">
            <div class="page-header">
                <ul class="breadcrumbs mb-3">
                    <li class="separator">
                        <a href="{{ route('wallet', $wallet->wallet_id) }}"><button class="btn btn-primary rounded-5">
                                <i class="icon-arrow-left"></i>
                            </button></a>
                    </li>
                    <li class="nav-home">
                        <a href="dashboard">
                            <i class="icon-home"></i>
                        </a>
                    </li>
                    <li class="separator">
                        <i class="icon-arrow-right"></i>
                    </li>
                    <li class="nav-item">
                        <h6>{{$wallet->wallet_name}}</h5>
                    </li>
                    <li class="separator">
                        <i class="icon-arrow-right"></i>
                    </li>
                    <li class="nav-item">
                        <h6>Pay Money</h5>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <form action="{{ route('debit') }}" method="post" class="form-horizontal" id="my-form">@csrf
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Pay Money</div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12 ">

                                        <div class="row form-group">
                                            <div class="col col-md-2">

                                            </div>
                                            <div class="col-12 col-md-10">
                                                <div class="row">
                                                    <div class="col-6 col-sm-4 col-lg-2">
                                                        <div class="card">
                                                            <div class="card-body p-2 text-center">
                                                                <div class="text-end text-success">
                                                                    <i class="fa fa-chevron-up text-white "></i>
                                                                </div>
                                                                <div class="text-end text-success">
                                                                    <input type="hidden" name="wallet_id"
                                                                        value="{{ $wallet->wallet_id }}">
                                                                </div>
                                                                <div class="h1 m-0">₹ {{ $wallet->balance }}</div>
                                                                <div class="h5 text-muted fw-bold text-capitalize">
                                                                    {{ $wallet->wallet_name }}

                                                                </div>
                                                                <p class="h6">Balance Limit ₹
                                                                    {{ $wallet->balance_limit }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="row form-group">
                                            <div class="col col-md-2">
                                                <label class="form-control-label">Balance</label>
                                            </div>
                                            <div class="col-12 col-md-10">
                                                <input type="text" name="balance" placeholder="Enter Balance"
                                                    class="form-control @error('balance') is-invalid @enderror"
                                                    value="{{ old('balance') }}">
                                                <span class="text-danger">
                                                    @error('image')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col col-md-2">
                                                <label class="form-control-label">Message</label>
                                            </div>
                                            <div class="col-12 col-md-10">
                                                <input type="message" name="message" placeholder="Enter Message"
                                                    class="form-control @error('message') is-invalid @enderror"
                                                    value="{{ old('message') }}">
                                                <span class="text-danger">
                                                    @error('message')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>
                                        </div>
                                    </div>


                                </div>

                            </div>
                            <div class="card-action">
                                <button class="btn btn-outline-primary" id="btn-submit">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script>
            document.getElementById('my-form').addEventListener('submit', function(e) {
                $("#btn-submit").prop("disabled", true).addClass("btn-primary disabled");
                $("#btn-submit").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Submitting...');
            });
        </script>


        <!--   Core JS Files   -->
        <script src="assets/js/core/jquery-3.7.1.min.js"></script>
        <script src="assets/js/core/popper.min.js"></script>
        <script src="assets/js/core/bootstrap.min.js"></script>

        <!-- jQuery Scrollbar -->
        <script src="assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>


        <!-- jQuery Sparkline -->
        <script src="assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>


        <!-- Datatables -->
        <script src="assets/js/plugin/datatables/datatables.min.js"></script>

       

        <!-- Kaiadmin JS -->
        <script src="assets/js/kaiadmin.min.js"></script>

       
    @endsection
</body>

</html>
