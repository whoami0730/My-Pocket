<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Forgot Password | My Wallet</title>
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
                title: "Password Forget Link Sent To Email",
                button: "Ok",
            });
        </script>
    @endif
    <div class="wrapper">
        <form action="{{ route('forgotPassword') }}" method="post">@csrf
            <h1>Forgot Password</h1>
            <div class="input-box">
                <input type="email" class="@error('email') border border-danger @enderror"
                    placeholder="@error('email') {{ $message }} @else Enter E-Mail   @enderror" name="email" />
                <i class="bx bxs-envelope"></i>
            </div>
            <button type="submit" class="btn">Submit</button>
        </form>
    </div>
</body>

</html>
