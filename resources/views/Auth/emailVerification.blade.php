{{-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <title>My Pocket | Login </title>

    <!---------- Sweet Alert ---------->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

</head>

<body>

   

    <!----------------------- Main Container -------------------------->

    <div class="container d-flex justify-content-center align-items-center min-vh-100  min-vw-100 "
        style="background-color: rgba(157, 147, 147, 0.827)">

        <!----------------------- Login Container -------------------------->

        <div class="row border rounded-5 p-4 bg-white shadow box-area">

            <div class="col-md-6 rounded-4 left-box  p-3 d-none d-md-block ps-md-5 m-auto">
                <div class="featured-image">
                    <img src="assets/img/Auth/4707071.jpg" class="img-fluid rounded w-75" width="200px">
                </div>

            </div>

            <!-------------------- ------ Right Box ---------------------------->

            <div class="col-md-6 right-box border border-2 border-primary rounded-4">

                <div class="row align-items-center p-2 ">
                    <div class="header-text mb-4">

                        <h2>Verify Email</h2>
                    </div>
                    <form action="{{ route('emailVerify') }}" method="post">@csrf
                        <div class="input-group mb-4">
                            <input type="text"
                                class="form-control form-control-lg bg-light fs-6  @error('otp') is-invalid @enderror"
                                placeholder="@error('otp')   {{ $message }} @else Email Verification Code @enderror"
                                name="otp" value="{{ old('otp') }}">
                        </div>

                        <div class="input-group">
                            <button class="btn btn-lg btn-primary w-100 fs-6" type="submit">Submit</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

</body>

</html> --}}


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Email Verification | My Wallet</title>
    <link rel="stylesheet" href="assets/css/style.css" />
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">


    <!---------- Sweet Alert ---------->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

</head>

<body>
    @if (session('success'))
        <script>
            swal({
                icon: "success",
                title: "Verification Code Send To Email",
                button: "Ok",
            });
        </script>
    @endif
    @if (session('error'))
        <script>
            swal({
                icon: "error",
                title: "Verification Code Is Invalid",
                button: "Ok",
            });
        </script>
    @endif
    <div class="wrapper">
        <form action="{{ route('emailVerify') }}" method="post">@csrf
            <h1>Email Verification</h1>
            <div class="input-box">
                <input type="text" class="@error('otp') border border-danger @enderror"
                    placeholder="@error('otp') {{ $message }} @else Enter Verification Code   @enderror"
                    name="otp" />
                <i class="bx bxs-envelope"></i>
            </div>
            <button type="submit" class="btn">Submit</button>
        </form>
    </div>
</body>

</html>
