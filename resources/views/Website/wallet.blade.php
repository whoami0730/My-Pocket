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
                    title: "Member Added Successfully",
                    button: "Ok",
                });
            </script>
        @endif
        @if (session('delete'))
            <script>
                swal({
                    icon: "success",
                    title: "Member Removed Successfully",
                    button: "Ok",
                });
            </script>
        @endif
        @if (session('exist'))
            <script>
                swal({
                    icon: "error",
                    title: "Member Already Exist",
                    button: "Ok",
                });
            </script>
        @endif
        @if (session('error'))
            <script>
                swal({
                    icon: "error",
                    title: "User Not Exist",
                    button: "Ok",
                });
            </script>
        @endif

        <div class="page-inner">
            <div class="page-header">
                <ul class="breadcrumbs ">
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
                        <h6>{{ $wallet->wallet_name }}</h5>
                    </li>
                </ul>
            </div>
            <div class="row">

                <div class="col-12 mb-3 d-flex justify-content-end px-4">
                    @if ($memberRemoved->deleted == 0)
                        @if ($memberRemoved->isactive == 1)
                            <a href="{{ route('payMoney', $wallet->wallet_id) }}"><button class="btn btn-primary me-2"><i
                                        class="icon-logout me-1"></i> Pay Money</button></a>
                            <a href="{{ route('addMoney', $wallet->wallet_id) }}"><button class="btn btn-secondary"><i
                                        class="icon-login me-1"></i> Add Money</button></a>
                        @endif
                    @endif

                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="card card-stats card-round">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-icon">
                                    <div class="icon-big text-center icon-primary bubble-shadow-small">
                                        <i class="fas fa-users"></i>
                                    </div>
                                </div>
                                <div class="col col-stats ms-3 ms-sm-0">
                                    <div class="numbers">
                                        <p class="card-category">Members</p>
                                        @if ($memberRemoved->deleted == 0 && $memberRemoved->isactive == 1)
                                            <h4 class="card-title">{{ $members->count() }}</h4>
                                        @else
                                            <h4 class="card-title">0</h4>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="card card-stats card-round">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-icon">
                                    <div class="icon-big text-center icon-warning bubble-shadow-small">
                                        <i class="icon-wallet"></i>
                                    </div>
                                </div>
                                <div class="col col-stats ms-3 ms-sm-0">
                                    <div class="numbers">
                                        <p class="card-category">Balance</p>
                                        @if ($memberRemoved->deleted == 0 && $memberRemoved->isactive == 1)
                                            <h4 class="card-title">₹ {{ $wallet->balance }}</h4>
                                        @else
                                            <h4 class="card-title">0</h4>
                                        @endif

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="card card-stats card-round">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-icon">
                                    <div class="icon-big text-center icon-success bubble-shadow-small">
                                        <i class="icon-login"></i>
                                    </div>
                                </div>
                                <div class="col col-stats ms-3 ms-sm-0">
                                    <div class="numbers">
                                        <p class="card-category">Total Credit</p>
                                        @if ($memberRemoved->deleted == 0 && $memberRemoved->isactive == 1)
                                            <h4 class="card-title">₹ {{ $wallet->total_credit }}</h4>
                                        @else
                                            <h4 class="card-title">0</h4>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="card card-stats card-round">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-icon">
                                    <div class="icon-big text-center icon-danger bubble-shadow-small">
                                        <i class="icon-logout"></i>
                                    </div>
                                </div>
                                <div class="col col-stats ms-3 ms-sm-0">
                                    <div class="numbers">
                                        <p class="card-category">Total Debit</p>
                                        @if ($memberRemoved->deleted == 0 && $memberRemoved->isactive == 1)
                                            <h4 class="card-title">₹ @if ($wallet->total_debit != 0)
                                                    {{ $wallet->total_debit }}
                                                @else
                                                    0
                                                @endif
                                            </h4>
                                        @else
                                            <h4 class="card-title">0</h4>
                                        @endif

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">

                <div class="col-md-5">

                    <div class="card card-round">
                        <div class="card-body">
                            <div class="card-head-row card-tools-still-right">
                                <div class="card-title">Members</div>
                                <div class="card-tools">
                                    @if ($memberRemoved->deleted == 0 && $memberRemoved->isactive == 1)
                                        <button class="btn btn-primary btn-sm " data-bs-toggle="modal"
                                            data-bs-target="#myModal"><i class="fa fa-plus"></i></button>
                                    @endif
                                </div>

                                <div class="modal" id="myModal">
                                    <div class="modal-dialog modal-md">
                                        <div class="modal-content">
                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                                <h4 class="modal-title">Add Member</h4>
                                                <button type="button" class="btn-close"
                                                    data-bs-dismiss="modal"></button>
                                            </div>
                                            <form action="{{ route('addMember') }}" method="post">@csrf
                                                <!-- Modal body -->
                                                <div class="modal-body bg-muted row">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label>Email</label>
                                                            <input type="email" class="form-control-file form-control"
                                                                name="email[]">
                                                            <input type="hidden" name="wallet_id"
                                                                value="{{ $wallet->wallet_id }}">

                                                        </div>
                                                        <div id="target-div">
                                                            <!-- Divs with labels and inputs will be appended here -->
                                                        </div>
                                                        {{-- <div class="form-group">
                                                            <p class="btn btn-secondary" id="addMore"><i
                                                                    class="fa fa-plus"></i> Add</p>
                                                        </div> --}}
                                                    </div>
                                                </div>
                                                <!-- Modal footer -->
                                                <div class="modal-footer ">
                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="card-list py-4">
                                @foreach ($members as $member)
                                    <div class="item-list">
                                        <div
                                            class="avatar @if ($member->isactive == true) avatar-online @else avatar-offline @endif">

                                            @if ($member->image != null)
                                                <img src="{{ asset('storage/UserImage/' . $member->image) }}"
                                                    alt="..." class="avatar-img rounded-circle" />
                                            @else
                                                <img src="assets/img/user.png" alt="..."
                                                    class="avatar-img rounded-circle" />
                                            @endif

                                        </div>
                                        <div class="info-user ms-3">
                                            <div class="username text-capitalize">{{ $member->name }}</div>
                                        </div>
                                        @if ($wallet->admin_id == Auth::user()->user_id)
                                            @if ($wallet->admin_id != $member->user_id)
                                                {{-- <button class="btn  btn-outline-secondary btn-icon  me-1"
                                                    @if ($member->isactive == false) onclick="return confirm('Do You Really want to enable?')"
                                                @else
                                                onclick="return confirm('Do You Really want to disable?')" @endif>
                                                    <a href="{{ route('updateMember', $member->member_id) }}"><i
                                                            class="@if ($member->isactive == false) fas fa-user-alt-slash text-muted @else fas fa-user-alt text-primary @endif "></i></a>
                                                </button> --}}

                                                @if ($member->isactive == false)
                                                    <a href="{{ route('updateMember', $member->member_id) }}">
                                                        <button class="btn  btn-success  me-1 btn-sm"
                                                            onclick="return confirm('Do You Really want to enable?')">
                                                            Enable
                                                        </button></a>
                                                @else
                                                    <a href="{{ route('updateMember', $member->member_id) }}">
                                                        <button class="btn  btn-primary  me-1 btn-sm"
                                                            onclick="return confirm('Do You Really want to disable?')">
                                                            Disable
                                                        </button></a>
                                                @endif
                                                <button class="btn btn-icon btn-link btn-danger op-8"
                                                    onclick="return confirm('Do You Really want to remove?')">
                                                    <a href="{{ route('deleteMember', $member->member_id) }}"><i
                                                            class="fa fa-trash text-danger "></i></a>
                                                </button>
                                            @endif
                                        @elseif(Auth::user()->user_id == $member->user_id)
                                            @if ($memberRemoved->deleted == 0)
                                                <button class="btn btn-icon btn-link btn-danger op-8"
                                                    onclick="return confirm('Do You Really want to leave this Wallet?')">
                                                    <a href="{{ route('leaveMember', $member->member_id) }}"><i
                                                            class="fa fa-trash text-danger"></i></a>
                                                </button>
                                            @endif
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                {{-- <div class="col-md-7 overflow-auto rounded-4" style="height: 600px;" id="paymentMainDiv">
                    <div class="card-title mt-2">Payments</div>
                    <ul class="timeline ">
                        @foreach ($payments as $payment)
                            @if (Auth::user()->user_id == $payment->user_id)
                                <li class="timeline-inverted d-none d-lg-block">
                                    <div class="timeline-panel">
                                        <div class="timeline-heading row">
                                            <div class="col-3">
                                                @if ($payment->image)
                                                    <img src="{{ asset('storage/UserImage/' . $payment->image) }}"
                                                        class="rounded-5" alt="" width="60px" height="60px">
                                                @else
                                                    <img src="assets/img/user.png" class="rounded-5" alt=""
                                                        width="60px" height="60px">
                                                @endif
                                            </div>

                                            <div class="col-9 ps-0">
                                                <h5 class="timeline-title  text-capitalize">{{ $payment->name }}</h4>
                                                    <h6
                                                        class="@if ($payment->payment_type == 'Cr') text-success fs-6 @else text-danger fs-6 @endif">
                                                        <i
                                                            class="fa @if ($payment->payment_type == 'Cr') fa-plus text-success fs-6 @else fa-minus text-danger fs-6 @endif ">
                                                        </i> ₹
                                                        {{ $payment->balance }}
                                                    </h6>
                                                    <p class="fs-6">
                                                        @if ($payment->message)
                                                            <mark class="bg-warning">
                                                                {{ $payment->message }}
                                                            </mark>
                                                        @endif
                                                    </p>
                                            </div>

                                        </div>
                                        <div class="timeline-body col-12 pb-0 my-0">

                                            <p class="text-end">
                                                {{ \Carbon\Carbon::parse($payment->created_at)->format('j - M - y') }}
                                            </p>
                                        </div>

                                    </div>

                                </li>

                                <li class="timeline-inverted d-block d-lg-none">
                                    <div class="timeline-panel">
                                        <div class="timeline-heading row">
                                            <div class="col-4">
                                                @if ($payment->image)
                                                    <img src="{{ asset('storage/UserImage/' . $payment->image) }}"
                                                        class="rounded-5" alt="" width="35px">
                                                @else
                                                    <img src="assets/img/user.png" class="rounded-5" alt=""
                                                        width="35px">
                                                @endif
                                            </div>
                                            <div class="col-8">
                                                <h6 class="timeline-title mt-1 text-capitalize fs-6">{{ $payment->name }}
                                                    </h4>
                                            </div>

                                        </div>
                                        <div class="timeline-body mt-2">
                                            <p
                                                class=" fs-6 @if ($payment->payment_type == 'Cr') text-success  @else text-danger @endif">
                                                <i
                                                    class="fs-6 fa @if ($payment->payment_type == 'Cr') fa-plus text-success  @else fa-minus text-danger @endif ">
                                                </i> ₹
                                                {{ $payment->balance }}
                                            </p>
                                            <p style="font-size: 12px;">
                                                @if ($payment->message)
                                                    <mark class="bg-warning ">
                                                        {{ $payment->message }}
                                                    </mark>
                                                @endif
                                            </p>
                                            <p class="fs-6 text-end">
                                                {{ \Carbon\Carbon::parse($payment->created_at)->format('j - M - y') }}
                                            </p>

                                        </div>
                                    </div>
                                </li>
                            @else
                                <li class="d-none d-lg-block">
                                    <div class="timeline-panel">
                                        <div class="timeline-heading row">
                                            <div class="col-3">
                                                @if ($payment->image)
                                                    <img src="{{ asset('storage/UserImage/' . $payment->image) }}"
                                                        class="rounded-5" alt="" width="60px" height="60px">
                                                @else
                                                    <img src="assets/img/user.png" class="rounded-5" alt=""
                                                        width="60px" height="60px">
                                                @endif
                                            </div>

                                            <div class="col-9 ps-0">
                                                <h5 class="timeline-title  text-capitalize">{{ $payment->name }}</h4>
                                                    <h6
                                                        class="@if ($payment->payment_type == 'Cr') text-success fs-6 @else text-danger fs-6 @endif">
                                                        <i
                                                            class="fa @if ($payment->payment_type == 'Cr') fa-plus text-success fs-6 @else fa-minus text-danger fs-6 @endif ">
                                                        </i> ₹
                                                        {{ $payment->balance }}
                                                    </h6>
                                                    <p class="fs-6">
                                                        @if ($payment->message)
                                                            <mark class="bg-warning">
                                                                {{ $payment->message }}
                                                            </mark>
                                                        @endif
                                                    </p>
                                            </div>

                                        </div>
                                        <div class="timeline-body col-12 py-0">

                                            <p class="text-end">
                                                {{ \Carbon\Carbon::parse($payment->created_at)->format('j - M - y') }}
                                            </p>
                                        </div>

                                    </div>

                                </li>

                                <li class=" d-block d-lg-none">
                                    <div class="timeline-panel">
                                        <div class="timeline-heading row">
                                            <div class="col-4">
                                                @if ($payment->image)
                                                    <img src="{{ asset('storage/UserImage/' . $payment->image) }}"
                                                        class="rounded-5" alt="" width="35px">
                                                @else
                                                    <img src="assets/img/user.png" class="rounded-5" alt=""
                                                        width="35px">
                                                @endif
                                            </div>
                                            <div class="col-8">
                                                <h6 class="timeline-title mt-1 text-capitalize fs-6">{{ $payment->name }}
                                                    </h4>
                                            </div>

                                        </div>
                                        <div class="timeline-body mt-2">
                                            <p
                                                class=" fs-6 @if ($payment->payment_type == 'Cr') text-success  @else text-danger @endif">
                                                <i
                                                    class="fs-6 fa @if ($payment->payment_type == 'Cr') fa-plus text-success  @else fa-minus text-danger @endif ">
                                                </i> ₹
                                                {{ $payment->balance }}
                                            </p>
                                            <p style="font-size: 12px;">
                                                @if ($payment->message)
                                                    <mark class="bg-warning ">
                                                        {{ $payment->message }}
                                                    </mark>
                                                @endif
                                            </p>
                                            <p class="fs-6 text-end">
                                                {{ \Carbon\Carbon::parse($payment->created_at)->format('j - M - y') }}
                                            </p>

                                        </div>
                                    </div>
                                </li>
                            @endif
                        @endforeach
                    </ul>

                </div> --}}

                <div class="col-md-7 overflow-auto rounded-4" style="height: 600px;" id="paymentMainDiv">
                    <div class="card-title mt-2">Payments</div>
                    <ul class="timeline ">
                        @foreach ($payments as $payment)
                            @if ($payment->payment_type == "Cr")
                                <li class="timeline-inverted d-none d-lg-block">
                                    {{-- <div
                                        class="timeline-badge @if ($payment->payment_type == 'Cr') success @else danger @endif ">
                                        <i
                                            class="@if ($payment->payment_type == 'Cr') icon-login @else icon-logout @endif "></i>
                                    </div> --}}
                                    <div class="timeline-panel">
                                        <div class="timeline-heading row">
                                            <div class="col-3">
                                                @if ($payment->image)
                                                    <img src="{{ asset('storage/UserImage/' . $payment->image) }}"
                                                        class="rounded-5" alt="" width="60px" height="60px">
                                                @else
                                                    <img src="assets/img/user.png" class="rounded-5" alt=""
                                                        width="60px" height="60px">
                                                @endif
                                            </div>

                                            <div class="col-9 ps-0">
                                                <h5 class="timeline-title  text-capitalize">{{ $payment->name }}</h4>
                                                    <h6
                                                        class="@if ($payment->payment_type == 'Cr') text-success fs-6 @else text-danger fs-6 @endif">
                                                        <i
                                                            class="fa @if ($payment->payment_type == 'Cr') fa-plus text-success fs-6 @else fa-minus text-danger fs-6 @endif ">
                                                        </i> ₹
                                                        {{ $payment->balance }}
                                                    </h6>
                                                    <p class="fs-6">
                                                        @if ($payment->message)
                                                            <mark class="bg-warning">
                                                                {{ $payment->message }}
                                                            </mark>
                                                        @endif
                                                    </p>
                                            </div>

                                        </div>
                                        <div class="timeline-body col-12 pb-0 my-0">

                                            <p class="text-end">
                                                {{ \Carbon\Carbon::parse($payment->created_at)->format('j - M - y') }}
                                            </p>
                                        </div>

                                    </div>

                                </li>

                                <li class="timeline-inverted d-block d-lg-none">
                                    {{-- <div
                                        class="timeline-badge @if ($payment->payment_type == 'Cr') success @else danger @endif ">
                                        <i
                                            class="@if ($payment->payment_type == 'Cr') icon-login @else icon-logout @endif "></i>
                                    </div> --}}
                                    <div class="timeline-panel">
                                        <div class="timeline-heading row">
                                            <div class="col-4">
                                                @if ($payment->image)
                                                    <img src="{{ asset('storage/UserImage/' . $payment->image) }}"
                                                        class="rounded-5" alt="" width="35px">
                                                @else
                                                    <img src="assets/img/user.png" class="rounded-5" alt=""
                                                        width="35px">
                                                @endif
                                            </div>
                                            <div class="col-8">
                                                <h6 class="timeline-title mt-1 text-capitalize fs-6">{{ $payment->name }}
                                                    </h4>
                                            </div>

                                        </div>
                                        <div class="timeline-body mt-2">
                                            <p
                                                class=" fs-6 @if ($payment->payment_type == 'Cr') text-success  @else text-danger @endif">
                                                <i
                                                    class="fs-6 fa @if ($payment->payment_type == 'Cr') fa-plus text-success  @else fa-minus text-danger @endif ">
                                                </i> ₹
                                                {{ $payment->balance }}
                                            </p>
                                            <p style="font-size: 12px;">
                                                @if ($payment->message)
                                                    <mark class="bg-warning ">
                                                        {{ $payment->message }}
                                                    </mark>
                                                @endif
                                            </p>
                                            <p class="fs-6 text-end">
                                                {{ \Carbon\Carbon::parse($payment->created_at)->format('j - M - y') }}
                                            </p>

                                        </div>
                                    </div>
                                </li>
                            @else
                                <li class="d-none d-lg-block">
                                    {{-- <div
                                        class="timeline-badge @if ($payment->payment_type == 'Cr') success @else danger @endif ">
                                        <i
                                            class="@if ($payment->payment_type == 'Cr') icon-login @else icon-logout @endif "></i>
                                    </div> --}}
                                    <div class="timeline-panel">
                                        <div class="timeline-heading row">
                                            <div class="col-3">
                                                @if ($payment->image)
                                                    <img src="{{ asset('storage/UserImage/' . $payment->image) }}"
                                                        class="rounded-5" alt="" width="60px" height="60px">
                                                @else
                                                    <img src="assets/img/user.png" class="rounded-5" alt=""
                                                        width="60px" height="60px">
                                                @endif
                                            </div>

                                            <div class="col-9 ps-0">
                                                <h5 class="timeline-title  text-capitalize">{{ $payment->name }}</h4>
                                                    <h6
                                                        class="@if ($payment->payment_type == 'Cr') text-success fs-6 @else text-danger fs-6 @endif">
                                                        <i
                                                            class="fa @if ($payment->payment_type == 'Cr') fa-plus text-success fs-6 @else fa-minus text-danger fs-6 @endif ">
                                                        </i> ₹
                                                        {{ $payment->balance }}
                                                    </h6>
                                                    <p class="fs-6">
                                                        @if ($payment->message)
                                                            <mark class="bg-warning">
                                                                {{ $payment->message }}
                                                            </mark>
                                                        @endif
                                                    </p>
                                            </div>

                                        </div>
                                        <div class="timeline-body col-12 py-0">

                                            <p class="text-end">
                                                {{ \Carbon\Carbon::parse($payment->created_at)->format('j - M - y') }}
                                            </p>
                                        </div>

                                    </div>

                                </li>

                                <li class=" d-block d-lg-none">
                                    {{-- <div
                                        class="timeline-badge @if ($payment->payment_type == 'Cr') success @else danger @endif ">
                                        <i
                                            class="@if ($payment->payment_type == 'Cr') icon-login @else icon-logout @endif "></i>
                                    </div> --}}
                                    <div class="timeline-panel">
                                        <div class="timeline-heading row">
                                            <div class="col-4">
                                                @if ($payment->image)
                                                    <img src="{{ asset('storage/UserImage/' . $payment->image) }}"
                                                        class="rounded-5" alt="" width="35px">
                                                @else
                                                    <img src="assets/img/user.png" class="rounded-5" alt=""
                                                        width="35px">
                                                @endif
                                            </div>
                                            <div class="col-8">
                                                <h6 class="timeline-title mt-1 text-capitalize fs-6">{{ $payment->name }}
                                                    </h4>
                                            </div>

                                        </div>
                                        <div class="timeline-body mt-2">
                                            <p
                                                class=" fs-6 @if ($payment->payment_type == 'Cr') text-success  @else text-danger @endif">
                                                <i
                                                    class="fs-6 fa @if ($payment->payment_type == 'Cr') fa-plus text-success  @else fa-minus text-danger @endif ">
                                                </i> ₹
                                                {{ $payment->balance }}
                                            </p>
                                            <p style="font-size: 12px;">
                                                @if ($payment->message)
                                                    <mark class="bg-warning ">
                                                        {{ $payment->message }}
                                                    </mark>
                                                @endif
                                            </p>
                                            <p class="fs-6 text-end">
                                                {{ \Carbon\Carbon::parse($payment->created_at)->format('j - M - y') }}
                                            </p>

                                        </div>
                                    </div>
                                </li>
                            @endif
                        @endforeach
                    </ul>

                </div>

            </div>

        </div>

        {{-- <script>
            var targetDiv = document.getElementById('target-div');

            document.getElementById('addMore').addEventListener('click', function() {

                i++;

                // Create div container for label and input
                var divContainer = document.createElement('div');
                divContainer.classList.add('form-group'); // Add a class to the container div for styling

                // Create label
                var label = document.createElement('label');
                label.textContent = 'Email ' + (i + 1); // Example label text, adjust as needed

                // Create input field
                var input = document.createElement('input');
                input.setAttribute('type', 'email');
                input.setAttribute('name', 'email[]');
                input.setAttribute('class', 'form-control-file');

                input.classList.add('form-control'); // Add a class to the input field for styling

                // Append label and input to the div container
                divContainer.appendChild(label);
                divContainer.appendChild(input);

                // Append the div container to the target div
                targetDiv.appendChild(divContainer);

            });
        </script> --}}

        <script>
            window.onload = function() {
                var mainDiv = document.getElementById('paymentMainDiv');
                mainDiv.scrollTop = mainDiv.scrollHeight - mainDiv.offsetHeight;
            }
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
