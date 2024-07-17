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

    <style>
        .bg-image {
            /* background-image: url('assets/img/wallet-background.jpg');
            background-position: center;
            background-size: cover; */
            background: linear-gradient(rgba(255, 255, 255, 0.7), rgba(255, 255, 255, 0.7)), url('assets/img/background-3.jpg') center/cover no-repeat;
            /* background: linear-gradient(rgba(139, 134, 139, 0.3), rgba(170, 153, 153, 0.2)), url('assets/img/wallet-background.jpg') center/cover no-repeat; */

        }
    </style>


</head>

<body>

    @extends('Website.layout')
    @section('main')
        @if (session('login'))
            <script>
                swal({
                    icon: "success",
                    title: "Sign In Successfully.",
                    button: "Ok",
                });
            </script>
        @endif
        @if (session('exit'))
            <script>
                swal({
                    icon: "success",
                    title: "Leave Wallet Successfully",
                    button: "Ok",
                });
            </script>
        @endif

        <div class="page-inner">
            <div class="page-header">
                <ul class="breadcrumbs mb-3">
                    <li class="separator">
                        <a href="dashboard"><button class="btn btn-primary rounded-5">
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
                        <h6>Wallet Share</h5>
                    </li>
                </ul>
            </div>
            <div class="row">
                @foreach ($wallets as $wallet)
                    <div class=" col-12 col-md-6 col-lg-4">
                        <a href="{{ route('wallet', $wallet->wallet_id) }}">
                            <div class="card card-secondary bg-secondary-gradient">
                                <div class="card-body bubble-shadow">
                                    <h1>{{ $wallet->wallet_name }}</h1>
                                    <h5 class="op-8">₹ {{ $wallet->balance }}</h5>
                                    <div class="pull-right">
                                        @foreach ($walletName as $name)
                                            <h3 class="fw-bold op-8 text-capitalize">
                                                @if ($name->wallet_id == $wallet->wallet_id)
                                                    {{ $name->name }}
                                                @endif
                                            </h3>
                                        @endforeach
                                        <div class="text-small text-uppercase fw-bold op-8">
                                            Card Holder
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach

            </div>
        </div>
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
