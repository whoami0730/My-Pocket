<?php

namespace App\Http\Controllers;


use App\Models\User;
use App\Models\Member;
use App\Models\Wallet;
use App\Models\Payment;
use App\Mail\deleteMember;
use App\Mail\inviteMember;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class MemberController extends Controller
{

    // Add Member Into Wallet
    public function store(Request $request)
    {


        $users = User::all();

        $usersEmail = $request->email;

        foreach ($usersEmail as $uEmail) {
            foreach ($users as $user) {
                if ($uEmail == $user->email) {

                    $userIdExist = $user->user_id;

                    $memberExist = Member::where(['user_id' => $userIdExist, 'wallet_id' => $request->wallet_id])->first();


                    if (!$memberExist) {

                        $data = new Member;
                        $data->member_id = Str::uuid();
                        $data->wallet_id = $request->wallet_id;
                        $data->user_id = $user->user_id;
                        $data->created_at = Carbon::now('Asia/Kolkata')->format('Y-m-d H:i:s');
                        $data->updated_at = Carbon::now('Asia/Kolkata')->format('Y-m-d H:i:s');
                        $data->save();

                        $memberName = User::Where('user_id', $userIdExist)->first();
                        $walletName = Wallet::Where('wallet_id', $request->wallet_id)->first();
                        $userName = Auth::user()->name;

                        $mailData = [
                            'subject' => 'Added into Wallet by ' . $userName,
                            'memberName' => $memberName->name,
                            'walletName' => $walletName->wallet_name,
                            'userName' => $userName,
                        ];

                        Mail::to($request->email)->send(new inviteMember($mailData));

                        return redirect()->back()->with('success', 'Member Added To Wallet Successfully');
                    } else {

                        if ($memberExist->deleted == True) {
                            $memberExist->deleted = false;
                            $memberExist->isactive = true;
                            $memberExist->save();

                            return redirect()->back()->with('success', 'Member Added !');
                        } else {
                            return redirect()->back()->with('exist', 'Member Already Exist!');
                        }
                    }
                }
            }
        }

        return redirect()->back()->with('error', 'User Not Exist!');
    }

    // Member Update Active/unActive
    public function updateMember($member_id)
    {
        $member = Member::Where(['member_id' => $member_id])->first();

        if ($member->isactive == true) {
            $member->isactive = false;
            $time = Carbon::now('Asia/Kolkata')->format('Y-m-d H:i:s');
            $member->updated_at = $time;
            $member->save();
        } else {
            $member->isactive = true;
            $member->save();
        }

        return redirect()->back();
    }

    // Delete Member From Wallet
    public function deleteMember($member_id)
    {
        $member = Member::Where(['member_id' => $member_id])->first();
        $member->deleted = True;
        $member->isactive = false;
        $time = Carbon::now('Asia/Kolkata')->format('Y-m-d H:i:s');
        $member->updated_at = $time;
        $result = $member->save();
       

        $memberName = User::Where('user_id', $member->user_id)->first();
        $walletName = Wallet::Where('wallet_id', $member->wallet_id)->first();

        $mailData = [
            'subject' => 'Removed From Wallet',
            'memberName' => $memberName->name,
            'walletName' => $walletName->wallet_name,
        ];

        Mail::to($memberName->email)->send(new deleteMember($mailData));

        if ($result) {
            return redirect()->back()->with('delete', 'Member Deleted Successfully');
        } else {
            return redirect()->back()->with('error', 'Member Not Deleted');
        }
    }

    // Self Exit From Wallet
    public function leaveMember($member_id)
    {
        $member = Member::Where(['member_id' => $member_id])->first();
        $member->deleted = True;
        $member->isactive = false;
        $time = Carbon::now('Asia/Kolkata')->format('Y-m-d H:i:s');
        $member->updated_at = $time;
        $result = $member->save();

        $memberName = User::Where('user_id', $member->user_id)->first();
        $walletName = Wallet::Where('wallet_id', $member->wallet_id)->first();

        $mailData = [
            'subject' => 'Removed From Wallet',
            'memberName' => $memberName->name,
            'walletName' => $walletName->wallet_name,
        ];

        Mail::to($memberName->email)->send(new deleteMember($mailData));

        if ($result) {
            return redirect('walletShare')->with('exit', 'Leave Wallet Successfully!');
        } else {
            return redirect()->back()->with('error', 'Server Error!');
        }
    }
}
