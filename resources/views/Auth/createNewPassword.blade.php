<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Create New Password | My Wallet</title>
    <link rel="stylesheet" href="assets/css/style.css" />
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    
    <!---------- Sweet Alert ---------->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

</head>

<body>
    @if (session('error'))
        <script>
            swal({
                icon: "success",
                title: "Something Went Wrong!",
                button: "Ok",
            });
        </script>
    @endif
    
    <div class="wrapper">
        <form action="{{ route('createNewPassword') }}" method="post">@csrf
            <h1>Create New Password</h1>
            <div class="input-box">
                <input type="text" class="@error('otp') border border-danger @enderror" placeholder="@error('otp') {{ $message }} @else Enter OTP   @enderror" name="otp" value="{{ old('otp') }}" />
                <i class="bx bxs-envelope"></i>
            </div>
            <div class="input-box">
                <input type="email" class=" @error('email') border border-danger @enderror" placeholder="@error('email') {{ $message }} @else Enter E-Mail   @enderror" name="email" value="{{ old('email') }}"/>
                <i class="bx bxs-envelope"></i>
            </div>
            <div class="input-box">
                <input type="password" class="@error('password') border border-danger @enderror" placeholder="@error('password') {{ $message }} @else Enter New Password   @enderror" name="password" value="{{ old('password') }}" />
                <i class="bx bxs-lock-alt"></i>
            </div>
            <button type="submit" class="btn">Submit</button>
        </form>
    </div>
</body>

</html>
