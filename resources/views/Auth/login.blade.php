<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login Page | My Wallet</title>
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
                title: "Account Created Successfully",
                button: "Ok",
            });
        </script>
    @endif
    @if (session('error'))
        <script>
            swal({
                icon: "error",
                title: "Email Password Is Invalid!",
                button: "Ok",
            });
        </script>
    @endif
    @if (session('warning'))
        <script>
            swal({
                icon: "error",
                title: "Verify Email First Before Login!",
                button: "Ok",
            });
        </script>
    @endif
    @if (session('created'))
        <script>
            swal({
                icon: "success",
                title: "New Password Created Successfully",
                button: "Ok",
            });
        </script>
    @endif
    @if (session('change'))
        <script>
            swal({
                icon: "success",
                title: "Password Changed Successfully",
                button: "Ok",
            });
        </script>
    @endif
    @if (session('forgot'))
        <script>
            swal({
                icon: "success",
                title: "Password Forget Link Sent To Email",
                button: "Ok",
            });
        </script>
    @endif
    <div class="wrapper">
        <form action="{{ route('userLogin') }}" method="post">@csrf
            <h1>Login</h1>
            <div class="input-box">
                <input type="email" class="@error('email') border border-danger @enderror"
                    placeholder="@error('email') {{ $message }} @else Enter E-Mail   @enderror" name="email"
                    value="{{ old('email') }}" />
                <i class="bx bxs-envelope"></i>
            </div>
            <div class="input-box">
                <input type="password" class=" @error('password') border border-danger @enderror"
                    placeholder="@error('password') {{ $message }} @else Password  @enderror" name="password"
                    value="{{ old('password') }}" />
                <i class="bx bxs-lock-alt"></i>
            </div>
            <button type="submit" class="btn">Login</button>
        </form>
        <div class="register-link">
            <p>Don't Have an account? <a href="signUp">Sign Up</a></p>
            <p>Don't remember password? <a href="forgotPassword">Forgot Password</a></p>
        </div>

    </div>
</body>

</html>
