<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sign Up Page | My Wallet</title>
    <link rel="stylesheet" href="assets/css/style.css" />
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">


    <!---------- Sweet Alert ---------->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

</head>

<body>
    @if (session('registered'))
        <script>
            swal({
                icon: "warning",
                title: "You are already regisatered",
                button: "Ok",
            });
        </script>
    @endif

    <div class="wrapper">
        <form action="{{ route('signUp') }}" method="post">@csrf
            <h1>Sign Up</h1>
            <div class="input-box">
                <input type="text" class="@error('name') border border-danger @enderror"
                    placeholder="@error('name') {{ $message }} @else Enter Name   @enderror" name="name"
                    value="{{ old('name') }}" />
                <i class="bx bxs-user"></i>
            </div>
            <div class="input-box">
                <input type="email" class="@error('email') border border-danger @enderror"
                    placeholder="@error('email') {{ $message }} @else Enter E-Mail   @enderror" name="email"
                    value="{{ old('email') }}" />
                <i class="bx bxs-envelope"></i>
            </div>
            <div class="input-box">
                <input type="text" class="@error('phone') border border-danger @enderror"
                    placeholder="@error('phone') {{ $message }} @else Enter Phone   @enderror" name="phone"
                    value="{{ old('phone') }}" />
                <i class="bx bxs-phone"></i>
            </div>
            <div class="input-box">
                <input type="password" class=" @error('password') border border-danger @enderror"
                    placeholder="@error('password') {{ $message }} @else Enter Password  @enderror" name="password"
                    value="{{ old('password') }}" />
                <i class="bx bxs-lock-alt"></i>
            </div>
            <button type="submit" class="btn">Sign Up</button>
        </form>
        <div class="register-link">
            <p>Have an account? <a href="login">Login</a></p>
        </div>
    </div>
</body>

</html>
