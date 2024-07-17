<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Wallet;
use App\Mail\DailyMail;
use App\Models\Payment;
use App\Mail\DebitMoney;
use App\Mail\CreditMoney;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

use function PHPUnit\Framework\isEmpty;

class PaymentController extends Controller
{

    // Money Add into Wallet
    public function debitMoney(Request $request)
    {

        $request->validate([
            'balance' => 'required|numeric',
            'wallet_id' => 'required'
        ]);

        $user =  Auth::user();

        $wallet = Wallet::where('wallet_id', $request->wallet_id)->first();

        if ($wallet->balance >= $request->balance) {

            $member = Member::where('user_id', $user->user_id)->first();

            $payment = new Payment;
            $payment->payment_id = Str::uuid();
            $payment->wallet_id = $request->wallet_id;
            $payment->member_id = $member->member_id;
            $payment->balance = $request->balance;
            $payment->payment_type = 'Dr';
            $payment->message = $request->message;
            $payment->created_at = Carbon::now('Asia/Kolkata')->format('Y-m-d H:i:s');
            $payment->updated_at = Carbon::now('Asia/Kolkata')->format('Y-m-d H:i:s');
            $payment->save();

            $newBalance = $wallet->balance - $request->balance;
            $Debit = $wallet->total_debit + $request->balance;

            $wallet->total_debit = $Debit;
            $wallet->balance = $newBalance;
            $result = $wallet->save();

            // Send Mail To All Member Of This Wallet

            if ($newBalance <= $wallet->balance_limit) {

                $limit = true;
            } else {

                $limit = false;
            }

            $members = DB::table('members')
                ->join('users', 'users.user_id', '=', 'members.user_id')
                ->where('wallet_id', $request->wallet_id)
                ->select('users.*')
                ->distinct()
                ->get();

            foreach ($members as $member) {

                $mailData = [
                    'subject' => 'Transaction Details',
                    'userName' => $user->name,
                    'image' => $user->image,
                    'amount' => $request->balance,
                    'message' => $request->message,
                    'limit' => $limit,
                    'wallet_balance' => $wallet->balance,
                    'time' => $payment->created_at,
                ];

                Mail::to($member->email)->send(new DebitMoney($mailData));
            }


            if ($result) {
                return redirect()->back()->with('success', 'Balance Paid From Wallet');
            } else {
                return redirect()->back()->with('error', 'Balance Not Paid');
            }
        } else {
            return redirect()->back()->with('lessAmount', 'Wallet Balance Limit Crossed');
        }
    }

    // Money Sent From Wallet
    public function creditMoney(Request $request)
    {
        $request->validate([
            'balance' => 'required|numeric',
            'wallet_id' => 'required'
        ]);

        $user =  Auth::user();
        $member = Member::where('user_id', $user->user_id)->first();

        $payment = new Payment;
        $payment->payment_id = Str::uuid();
        $payment->wallet_id = $request->wallet_id;
        $payment->member_id = $member->member_id;
        $payment->balance = $request->balance;
        $payment->payment_type = 'Cr';
        $payment->created_at = Carbon::now('Asia/Kolkata')->format('Y-m-d H:i:s');
        $payment->updated_at = Carbon::now('Asia/Kolkata')->format('Y-m-d H:i:s');
        $payment->save();


        $wallet = Wallet::where('wallet_id', $request->wallet_id)->first();

        $newBalance = $wallet->balance + $request->balance;
        $Credit = $wallet->total_credit + $request->balance;

        $wallet->balance = $newBalance;
        $wallet->total_credit = $Credit;

        $result = $wallet->save();

        // Send Mail To All Member Of This Wallet

        $members = DB::table('members')
            ->join('users', 'users.user_id', '=', 'members.user_id')
            ->where('wallet_id', $request->wallet_id)
            ->select('users.*')
            ->distinct()
            ->get();

        foreach ($members as $member) {

            $mailData = [
                'subject' => 'Transaction Details',
                'userName' => $user->name,
                'image' => $user->image,
                'amount' => $request->balance,
                'time' => $payment->created_at,
            ];

            Mail::to($member->email)->send(new CreditMoney($mailData));
        }

        if ($result) {
            return redirect()->back()->with('success', 'Balance Add To Wallet');
        } else {
            return redirect()->back()->with('error', 'Balance Not Add To Wallet');
        }
    }

    // Daily Mail To Inform User Balance Amount Crossed Balance Limit
    public function sendMailDaily()
    {

        $crossLimitWalletId = [];
        $wallets = Wallet::all();

        foreach ($wallets as $wallet) {

            if ($wallet->balance < $wallet->balance_limit) {
                $crossLimitWalletId[] = $wallet->wallet_id;
            }
        }


        if ($crossLimitWalletId) {

            foreach ($crossLimitWalletId as $WalletId) {


                $members = DB::table('members')
                    ->join('users', 'users.user_id', '=', 'members.user_id')
                    ->where('wallet_id', $WalletId)
                    ->select('users.*')
                    ->distinct()
                    ->get();

                $wallet_balance = Wallet::where('wallet_id', $WalletId)->first();

                foreach ($members as $member) {

                    $mailData = [
                        'subject' => 'Wallet Balance Limit Crossed ',
                        'userName' => $member->name,
                        'image' => $member->image,
                        'balance' => $wallet_balance->balance,

                    ];

                    Mail::to($member->email)->send(new DailyMail($mailData));
                }
            }

            return response([
                'status' => true,
                'message' => 'Mail Send Successfully'
            ]);
        } else {

            return response([
                'status' => false,
                'message' => 'Limit Cross Wallet Not Exist'
            ]);
        }
    }

}
