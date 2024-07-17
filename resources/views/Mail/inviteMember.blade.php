<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Forgot OTP</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .header h1 {
            color: #12263a;
            margin: 0;
            margin-bottom: 10px;
            text-transform: capitalize;
        }

        .header h2 {
            color: #777;
            margin: 0;
        }

        .content {
            background-color: #fff;
            padding: 20px;
        }

        .image {
            display: flex;
            margin: 0 0px 20px;
        }

        .h2 {
            margin-bottom: 20px;
            color: #777;
        }

        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: #eff;
            text-decoration: none;
            border-radius: 4px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h2>Hi {{ $mailData['memberName'] }}</h2>
        </div>
        <div class="content">
            <div class="image">
                <img src="{{ $message->embed(public_path('assets/img/Auth/wallet.png')) }}" alt="Logo Image"
                    width="45px">
                <h2>My Wallet</h2>
            </div>
            <h4>You Are Added Into {{ $mailData['walletName'] }} Wallet By {{ $mailData['userName'] }}</p>
                <p><a href="https://budgetbuddy.buddyledtv.com/public/login" class="button">View Wallet Share</a></p>
        </div>
    </div>
</body>

</html>
