<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Debit from Wallet</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            height: 100vh;
        }

        .card {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            padding: 40px;
            width: 400px;
            text-align: center;
        }

        .card-header {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
        }
        .user-profile{
            margin: 0 auto;
        }
        .user-profile img {

            width: 80px;
            height: 80px;
            border-radius: 50%;
            border: 3px solid #fff;
            /* Adjust border color if needed */
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        .user-profile .user-details {
            text-align: left;
        }

        .user-profile .username {
            font-size: 24px;
            font-weight: bold;
            color: #333;
            margin-bottom: 5px;
        }

        .user-profile .profession {
            font-size: 18px;
            color: #666;
        }

        .transaction-details {
            margin-top: 20px;
            border-top: 1px solid #ccc;
            padding-top: 20px;
        }

        .transaction-details .purpose {
            font-size: 20px;
            font-weight: bold;
            color: #333;
            margin-bottom: 10px;
        }

        .transaction-details .amount {
            font-size: 30px;
            font-weight: bold;
            color: green;
            /* Adjust color for debit amount */
        }

        .footer {
            margin-top: 20px;
            font-size: 14px;
            color: #777;
        }
    
    </style>
</head>

<body>
    <div class="card">
        <div class="card-header">
            <div class="user-profile">
                @if ($mailData['image'] == null)
                    <img src="{{ $message->embed(public_path('assets/img/user.png')) }}" alt="User Profile Image">
                @else
                    <img src="{{ $message->embed(public_path('storage/UserImage/' . $mailData['image'])) }}"
                        alt="User Profile Image">
                @endif
                <div class="user-details">
                    <div class="username">{{ $mailData['userName'] }}</div>
                    {{-- <div class="profession">Software Engineer</div> --}}
                </div>
            </div>
        </div>
        <div class="transaction-details">
            <p class="purpose">Money Credit Into Wallet</p>
            <p class="amount">₹ {{ $mailData['amount'] }}</p>
        </div>
        <div class="footer">
            {{-- Transaction ID: #123456<br> --}}
            Date: {{ \Carbon\Carbon::parse($mailData['time'])->format('j - M - y') }}

        </div>
    </div>
</body>

</html>
