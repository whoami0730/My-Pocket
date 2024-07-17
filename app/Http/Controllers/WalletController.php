<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Member;
use App\Models\Wallet;
use App\Models\Payment;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class WalletController extends Controller
{


    // Create New Wallet
    public function store(Request $request)
    {

        $request->validate([
            'wallet_name' => 'required',
            'balance_limit' => 'required|numeric',
        ]);

        $user_id = Auth::user()->user_id;

        $walletNameExist = Wallet::where(['wallet_name' => $request->wallet_name, 'admin_id' => $user_id])->first();

        if ($walletNameExist) {
            return redirect()->back()->with('walletExist', 'Wallet Name already Exist');
        } else {
            $wallet = new Wallet;
            $wallet->wallet_id = Str::uuid();
            $wallet->admin_id = $user_id;
            $wallet->wallet_name = $request->wallet_name;
            $wallet->balance_limit = $request->balance_limit;
            $wallet->created_at = Carbon::now('Asia/Kolkata')->format('Y-m-d H:i:s');
            $wallet->updated_at = Carbon::now('Asia/Kolkata')->format('Y-m-d H:i:s');
            $wallet->save();

            $member = new Member;
            $member->member_id = Str::uuid();
            $member->wallet_id = $wallet->wallet_id;
            $member->user_id = $user_id;
            $member->created_at = Carbon::now('Asia/Kolkata')->format('Y-m-d H:i:s');
            $member->updated_at = Carbon::now('Asia/Kolkata')->format('Y-m-d H:i:s');
            $result = $member->save();


            if ($result) {
                return redirect()->back()->with('success', 'Wallet Created Successfully');
            } else {
                return redirect()->back()->with('error', 'Wallet Not Created');
            }
        }
    }

    // Update Wallet Name & Limit 
    public function updateWallet(Request $request, $wallet_id)
    {
        $user_id = Auth::user()->user_id;
        $wallet = Wallet::where(['admin_id' => $user_id, 'wallet_id' => $wallet_id])->update([
            'wallet_name' => $request->wallet_name,
            'balance_limit' => $request->balance_limit
        ]);


        if ($wallet) {
            return redirect()->back()->with('update', 'Wallet Name Changed Successfully');
        } else {
            return redirect()->back()->with('error', 'Wallet Name Not Changed');
        }
    }

    // Delete Exist Wallet 
    public function deleteWallet($wallet_id)
    {
        $user_id = Auth::user()->user_id;
        $wallet = Wallet::where(['admin_id' => $user_id, 'wallet_id' => $wallet_id])->first();
        $members = Member::Where(['wallet_id' => $wallet_id])->get();

        $paymentHistory = Payment::where(['wallet_id' => $wallet_id])->get();

        // Delete PaymentHistory

        foreach ($paymentHistory as $payment) {
            $payment->delete();
        }

        // Delete Members

        foreach ($members as $member) {
            $member->delete();
        }

        // Delete Wallet

        $result = $wallet->delete();

        if ($result) {
            return redirect()->back()->with('delete', 'Wallet Deleted Successfully');
        } else {
            return redirect()->back()->with('error', 'Wallet Deleted Changed');
        }
    }

    // Show  Payments and Member Details insite Wallet
    public function showPayment(Request $request, $wallet_id)
    {
        $users = [];
        $payments = [];
        $members = [];


        $userId = Auth::user()->user_id;

        $memberRemoved = DB::table('members')
            ->join('users', 'users.user_id', '=', 'members.user_id')
            ->select('members.deleted', 'members.created_at', 'members.updated_at', 'members.isactive')
            ->where('wallet_id', $wallet_id)
            ->where('users.user_id', $userId)
            ->first();

        if ($memberRemoved->deleted == 1 || $memberRemoved->isactive == 0) {

            $allPayments = DB::table('members')
                ->join('users', 'users.user_id', '=', 'members.user_id')
                ->join('payments', 'payments.member_id', '=', 'members.member_id')
                ->select('users.name', 'users.image', 'payments.*', 'members.user_id')
                ->where('payments.wallet_id', $wallet_id)
                ->orderBy('created_at', 'asc')->get();

            foreach ($allPayments as $detail) {
                if ($detail->created_at >= $memberRemoved->created_at && $detail->created_at <= $memberRemoved->updated_at) {
                    $payments[] = $detail;
                }
            }
            $wallet = Wallet::where('wallet_id', $wallet_id)->first();

            $allMembers = DB::table('members')
                ->join('users', 'users.user_id', '=', 'members.user_id')
                ->select('users.*', 'members.isactive', 'members.member_id', 'members.deleted', 'members.created_at', 'members.updated_at')
                ->where('wallet_id', $wallet_id)
                ->distinct()
                ->get();

            foreach ($allMembers as $member) {
                if ($member->created_at >= $memberRemoved->created_at && $member->created_at <= $memberRemoved->updated_at) {
                    $members[] = $member;
                }
            }

        } else {

            $payments = DB::table('members')
                ->join('users', 'users.user_id', '=', 'members.user_id')
                ->join('payments', 'payments.member_id', '=', 'members.member_id')
                ->select('users.name', 'users.image', 'payments.*', 'members.user_id')
                ->where('payments.wallet_id', $wallet_id)
                ->orderBy('created_at', 'asc')->get();

            $wallet = Wallet::where('wallet_id', $wallet_id)->first();

            $members = DB::table('members')
                ->join('users', 'users.user_id', '=', 'members.user_id')
                ->select('users.*', 'members.isactive', 'members.member_id', 'members.deleted')
                ->where('wallet_id', $wallet_id)
                ->where('members.deleted', false)
                ->distinct()
                ->get();
        }

        return view('Website.wallet', compact('payments', 'wallet', 'members', 'memberRemoved'));
    }

    // Show Wallet  On Add Member
    // public function showOnAddMember()
    // {
    //     $user_id = Auth::user()->user_id;
    //     $users = User::all();

    //     $wallets = Wallet::where('admin_id', $user_id)->get();
    //     return view('Website.addMember', compact('wallets', 'users'));
    // }

    //Show Wallet on Dashboadrd
    public function showOnDashboard()
    {
        $user_id = Auth::user()->user_id;

        $wallets = Wallet::where('admin_id', $user_id)->get();

        return view('Website.dashboard', compact('wallets'));
    }

    // Show Wallet  On Add Money
    public function showOnAddMoney($wallet_id)
    {
        $wallet = Wallet::where('wallet_id', $wallet_id)->first();
        return view('Website.addMoney', compact('wallet'));
    }

    // Show Wallet  On Send Money
    public function showOnPayMoney($wallet_id)
    {
        $wallet = Wallet::where('wallet_id', $wallet_id)->first();

        return view('Website.payment', compact('wallet'));
    }
    // Share Wallet Dashboard 
    public function walletShare()
    {
        $user_id = Auth::user()->user_id;

        $walletName = DB::table('users')
            ->join('wallets', 'wallets.admin_id', '=', 'users.user_id')
            ->select('wallets.wallet_id', "users.name")->get();

        $wallets = DB::table('members')
            ->join('wallets', 'wallets.wallet_id', '=', 'members.wallet_id')
            ->join('users', 'users.user_id', '=', 'members.user_id')
            ->select('members.isactive', 'wallets.*', 'users.name',)
            ->where('members.user_id', '=', $user_id)
            ->where('wallets.admin_id', '!=', $user_id)
            // ->where('members.isactive', '=', True)
            // ->where('members.deleted', '=', false)
            ->distinct()
            ->get();

        return view('Website.walletShare', compact('wallets', 'walletName'));
    }

}
