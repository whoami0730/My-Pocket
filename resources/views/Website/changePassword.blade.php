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
        @error('error')
            <script>
                swal({
                    icon: "warning",
                    title: "Password Not Changed!",
                    button: "Ok",
                });
            </script>
        @enderror
        
        <div class="page-inner">
            <div class="page-header">
                <ul class="breadcrumbs mb-3">
                    <li class="nav-home">
                        <a href="dashboard">
                            <i class="icon-home"></i>
                        </a>
                    </li>
                    <li class="separator">
                        <i class="icon-arrow-right"></i>
                    </li>
                    <li class="nav-item">
                        <h6>Change Password</h5>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <form action="{{ route('changePassword') }}" method="post" class="form-horizontal"
                        enctype="multipart/form-data">@csrf
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Change Password</div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12 ">
                                        <div class="row form-group ">
                                            <div class="col col-md-2">
                                                <label class="form-control-label">Old Password</label>
                                            </div>
                                            <div class="col-12 col-md-10">
                                                <input type="text" name="old_password" placeholder="Enter Old Password"
                                                    class="form-control @error('old_password') is-invalid @enderror"
                                                    value="{{ old('old_password') }}">
                                                <span class="text-danger">
                                                    @error('old_password')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>
                                        </div>
                                        <div class="row form-group ">
                                            <div class="col col-md-2">
                                                <label class="form-control-label">New Password</label>
                                            </div>
                                            <div class="col-12 col-md-10">
                                                <input type="text" name="password" placeholder="Enter New Password"
                                                    class="form-control @error('password') is-invalid @enderror"
                                                    value="{{ old('password') }}">
                                                <span class="text-danger">
                                                    @error('password')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>
                                        </div>
                                        <div class="row form-group ">
                                            <div class="col col-md-2">
                                                <label class="form-control-label">Confirm Password</label>
                                            </div>
                                            <div class="col-12 col-md-10">
                                                <input type="text" name="password_confirmation"
                                                    placeholder="Confirm Password"
                                                    class="form-control @error('password_confirmation') is-invalid @enderror"
                                                    value="{{ old('password_confirmation') }}">
                                                <span class="text-danger">
                                                    @error('password_confirmation')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>
                            <div class="card-action">
                                <button class="btn btn-success">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
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
