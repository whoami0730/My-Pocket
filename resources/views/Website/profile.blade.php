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
        @if (session('update'))
            <script>
                swal({
                    icon: "success",
                    title: "Profile Updated Successfully",
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
                        <h6>Profile</h5>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-profile">
                        <div class="card-header" style="background-image: url('assets/img/blogpost.jpg')">
                            <div class="profile-picture">
                                <div class="avatar avatar-xxl position-reletive">
                                    @if ($user->image != null)  
                                        <a href="{{ asset('storage/UserImage/' . $user->image) }}" data-lightbox="Profile Image"
                                            data-title="{{$user->image }}">
                                            <img src="{{ asset('storage/UserImage/' . $user->image) }}" alt="..."
                                            class="avatar-img rounded-circle"  alt="Profile Image"/>
                                        </a>
                                    @else
                                        <img src="assets/img/user.png" alt="..." class="avatar-img rounded-circle" />
                                    @endif
                                </div>

                            </div>
                        </div>
                        <div class="card-body">
                            <div class="user-profile text-center">
                                <div class="name">{{ $user->name }}</div>
                                <div class="job">{{ $user->phone }}</div>
                                <div class="desc">{{ $user->email }}</div>
                                {{-- <div class="social-media">
                                    <a class="btn btn-info btn-twitter btn-sm btn-link" href="#">
                                        <span class="btn-label just-icon"><i class="icon-social-twitter"></i>
                                        </span>
                                    </a>
                                    <a class="btn btn-primary btn-sm btn-link" rel="publisher" href="#">
                                        <span class="btn-label just-icon"><i class="icon-social-facebook"></i>
                                        </span>
                                    </a>
                                    <a class="btn btn-danger btn-sm btn-link" rel="publisher" href="#">
                                        <span class="btn-label just-icon"><i class="icon-social-instagram"></i>
                                        </span>
                                    </a>
                                </div> --}}
                                <div class="view-profile">
                                    <button class="btn btn-primary w-100" data-bs-toggle="modal"
                                        data-bs-target="#editProfile">Edit Profile</button>
                                </div>

                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="row user-stats text-center">
                                <div class="col">
                                    <div class="number">{{$data['totalWallet']}}</div>
                                    <div class="title">Wallet</div>
                                </div>
                                <div class="col">
                                    <div class="number">{{$data['totalMember']}}</div>
                                    <div class="title">Members</div>
                                </div>
                                <div class="col">
                                    <div class="number">{{$data['totalCredit']}}</div>
                                    <div class="title">Total Credit</div>
                                </div>
                                <div class="col">
                                    <div class="number">{{$data['totalDebit']}}</div>
                                    <div class="title">Total Debit</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- The Modal -->
                <div class="modal" id="editProfile">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">

                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title">Profile Detail</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <form action="{{ route('updateProfile', $user->user_id) }}" method="post"
                                enctype="multipart/form-data">@csrf
                                <!-- Modal body -->
                                <div class="modal-body">
                                    <div class="row p-2">
                                        <div class="col-md-4 ">
                                            <div class="card card-post card-round p-3   ">
                                                @if ($user->image != null)
                                                    <img class="card-img-top rounded-circle"
                                                        src="{{ asset('storage/UserImage/' . $user->image) }}"
                                                        alt="Card image cap" width="230px" height="230px" />
                                                @else
                                                    <img class="card-img-top rounded-circle" src="assets/img/user.png"
                                                        alt="Card image cap" width="230px" height="230px" />
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="card card-post card-round p-2">
                                                        <div class="row form-group mb-3 mt-3">
                                                            <div class="col col-md-3">
                                                                <label class="form-control-label">Image</label>
                                                            </div>
                                                            <div class="col-12 col-md-9">
                                                                <input type="file" name="image"
                                                                    class="form-control @error('image') is-invalid @enderror"
                                                                    value="{{ old('image') }}">
                                                                <span class="text-danger">
                                                                    @error('image')
                                                                        {{ $message }}
                                                                    @enderror
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="row form-group mb-3">
                                                            <div class="col col-md-3">
                                                                <label class="form-control-label">Name</label>
                                                            </div>
                                                            <div class="col-12 col-md-9">
                                                                <input type="text" name="name"
                                                                    placeholder="Enter Name"
                                                                    class="form-control @error('name') is-invalid @enderror"
                                                                    value="{{ $user->name }}">
                                                                <span class="text-danger">
                                                                    @error('name')
                                                                        {{ $message }}
                                                                    @enderror
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="row form-group mb-3">
                                                            <div class="col col-md-3">
                                                                <label class="form-control-label">Phone</label>
                                                            </div>
                                                            <div class="col-12 col-md-9">
                                                                <input type="text" name="phone"
                                                                    placeholder="Enter Phone"
                                                                    class="form-control @error('phone') is-invalid @enderror"
                                                                    value="{{ $user->phone }}">
                                                                <span class="text-danger">
                                                                    @error('phone')
                                                                        {{ $message }}
                                                                    @enderror
                                                                </span>
                                                            </div>
                                                        </div>


                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
