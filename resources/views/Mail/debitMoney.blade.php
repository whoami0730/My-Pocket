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

        .user-profile {
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
            color: #f44336;
            /* Adjust color for debit amount */
        }

        .footer {
            margin-top: 20px;
            font-size: 14px;
            color: #777;
        }

        .note-card {

            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 16px;
            width: 300px;
            /* Adjust width as needed */
            margin: 15px auto;
        }

        .note-header {
            border-bottom: 1px solid #ccc;
            padding-bottom: 8px;
            margin-bottom: 8px;
        }

        .note-title {
            margin: 0;
            font-size: 1.2rem;
            color: #333;
        }

        .note-content {
            color: #666;
            font-size: 1rem;
            line-height: 1.4;
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
            <p class="purpose">Money Debit from Wallet</p>
            <p class="amount">₹ {{ $mailData['amount'] }}</p>
        </div>
        <div class="footer">
            {{-- Transaction ID: #123456<br> --}}
            @if ($mailData['message'] != null)
                Message : <mark>{{ $mailData['message'] }}</mark><br>
                Date: {{ \Carbon\Carbon::parse($mailData['time'])->format('j - M - y') }}
            @else
                Date: {{ \Carbon\Carbon::parse($mailData['time'])->format('j - M - y') }}
            @endif

            @if ($mailData['limit'])
                <div class="note-card">
                    <div class="note-header">
                        <h2 class="note-title"> Note : Wallet Balance Limit Crossed </mark></h2>
                    </div>
                    <div class="note-content">
                        <p style="color: #777;">Your wallet balance has exceeded the set limit. Please add money in to
                            Wallet</p>
                        <h4><mark> Wallet Balance : ₹ {{ $mailData['wallet_balance'] }} <mark></p>
                    </div>
                </div>
            @endif

        </div>
    </div>
</body>

</html>
