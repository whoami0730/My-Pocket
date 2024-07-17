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
            background: linear-gradient(rgba(255, 255, 255, 0.7), rgba(255, 255, 255, 0.7)), url('assets/img/background-3.jpg') center/cover no-repeat;
            /* background: linear-gradient(rgba(255, 255, 255, 0.4), rgba(255, 255, 255, 0.4)), url('assets/img/wallet-background.jpg') center/cover no-repeat; */
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
        @if (session('update'))
            <script>
                swal({
                    icon: "success",
                    title: "Wallet Name Change Successfully.",
                    button: "Ok",
                });
            </script>
        @endif
        @if (session('delete'))
            <script>
                swal({
                    icon: "success",
                    title: "Wallet Deleted Successfully.",
                    button: "Ok",
                });
            </script>
        @endif
        @if ($wallets->count() > 0)
            <div class="page-inner">
                <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                    <div>
                        <h3 class="fw-bold mb-3">Dashboard</h3>
                    </div>
                    <div class="ms-md-auto py-2 py-md-0">
                        <a href="{{ route('addWallet') }}" class="btn btn-primary btn-round">Add Wallet</a>
                    </div>
                </div>
                <div class="row">
                    @foreach ($wallets as $wallet)
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="card card-secondary bg-secondary-gradient">
                                <div class="card-body bubble-shadow position-relative">
                                    <div class="position-absolute top-0 end-0 mt-3 me-3 ">
                                        <button class="btn p-2 border border-white rounded" data-bs-toggle="modal"
                                            data-bs-target="#editWallet-{{ $wallet->wallet_id }}"><i
                                                class="fa fa-edit text-white"></i></button>

                                        <button onclick="return confirm('Do you really want to delete this wallet?')"
                                            class="btn p-2 border border-white rounded"><a
                                                href="{{ route('deleteWallet', $wallet->wallet_id) }}"><i
                                                    class="fa fa-trash text-white"></i></a></button>
                                       
                                    </div>

                                    <!--Edit Wallet Name Modal -->
                                    <div class="modal" id="editWallet-{{ $wallet->wallet_id }}">
                                        <div class="modal-dialog">
                                            <div class="modal-content">

                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                    <h4 class="modal-title text-muted">Change Wallet Name</h4>
                                                    <button type="button" class="btn-close"
                                                        data-bs-dismiss="modal"></button>
                                                </div>

                                                <form action="{{ route('editWallet', $wallet->wallet_id) }}" method="post">
                                                    @csrf
                                                    <!-- Modal body -->
                                                    <div class="modal-body row form-group">
                                                        <label class="form-control-label">Wallet Name</label>
                                                        <div class="col-12">
                                                            <input type="text" name="wallet_name"
                                                                class="form-control @error('wallet_name') is-invalid @enderror"
                                                                value="{{ $wallet->wallet_name }}">
                                                            <span class="text-danger">
                                                                @error('wallet_name')
                                                                    {{ $message }}
                                                                @enderror
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="modal-body row form-group">
                                                        <label class="form-control-label">Balance Limit</label>
                                                        <div class="col-12">
                                                            <input type="text" name="balance_limit"
                                                                class="form-control @error('balance_limit') is-invalid @enderror"
                                                                value="{{ $wallet->balance_limit }}">
                                                            <span class="text-danger">
                                                                @error('balance_limit')
                                                                    {{ $message }}
                                                                @enderror
                                                            </span>
                                                        </div>
                                                    </div>

                                                    <!-- Modal footer -->
                                                    <div class="modal-footer">
                                                        <button class="btn btn-success">Submit</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-6 pe-0">
                                            <a href="{{ route('wallet', $wallet->wallet_id) }}">
                                                <h2 class="fw-bold mb-1 text-capitalize text-white">
                                                    {{ $wallet->wallet_name }}
                                                    </h3>
                                            </a>
                                        </div>
                                        <div class="col-6 ps-0 text-end">
                                        </div>

                                    </div>
                                    <a href="{{ route('wallet', $wallet->wallet_id) }}" class="text-white">
                                        <h2 class=" py-2 mb-0 ">₹ {{ $wallet->balance }}</h2>
                                    </a>

                                    <div class="row">
                                        <div class="col-6 pe-0">
                                        </div>
                                        <div class="col-6 ps-0 text-end">
                                            <h4 class="fw-bold mb-1">{{ Auth::user()->name }}</h3>
                                                <div class="text-small text-uppercase fw-bold op-8">
                                                    Wallet Holder
                                                </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    @endforeach


                </div>
            </div>
        @else
            <div class="d-flex  justify-content-center">
                <div class="div mt-5">
                    <a href="addWallet" class="btn btn-secondary btn-lg">Add Wallet</a>
                </div>
            </div>
        @endif
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

       

        {{-- <script>
            function ConfirmDelete() {
                swal({
                        title: "Do You Really Want To Delete This Wallet?",
                        // text: "Once deleted, you will not be able to recover this imaginary file!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            swal("Wallet has been deleted!", {
                                icon: "success",
                            });
                        }
                    });
            }
        </script> --}}
        
    @endsection
</body>

</html>
