<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Member;
use App\Models\Wallet;
use App\Models\Payment;
use App\Mail\emailVerify;
use Illuminate\Support\Str;
use App\Mail\forgotPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;


class UserController extends Controller
{

    // Register User
    public function store(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'password' => 'required|min:8',

        ]);

        $userEmail = User::where('email', $request->email)->first();

        if ($userEmail) {
            return redirect()->back()->with('registered', 'you are already regisatered');
        } else {

            $data = new User;
            $data->user_id = Str::uuid();
            $data->name = $request->name;
            $data->email = $request->email;
            $data->phone = $request->phone;
            $data->password = $request->password;
            $data->created_at = Carbon::now('Asia/Kolkata')->format('Y-m-d H:i:s');
            $data->updated_at = Carbon::now('Asia/Kolkata')->format('Y-m-d H:i:s');
            $result = $data->save();

            $otp = rand('111111', '999999');

            DB::table('users')->where('email', $request->email)->update([
                'email_verification_code' =>  $otp,
            ]);

            $mailOtp = [
                'subject' => 'Email Verification Code',
                'otp' => $otp
            ];

            Mail::to($request->email)->send(new emailVerify($mailOtp));


            if ($result) {
                return redirect('emailVerification')->with('success', 'Email Verification Code Send To Email');
            } else {
                return redirect()->back()->with('error', 'Account Not Created');
            }
        }
    }

    // Show User Details On Profile
    public function showOnProfile()
    {
        $userDetail = Auth::user();
        $totalDebit = 0;
        $totalCredit = 0;
        $totalMember = 0;
        $totalWallet= 0;

        $user = User::where('user_id', $userDetail->user_id)->first();
        $totalWallets = Wallet::where('admin_id', $userDetail->user_id)->get();
        $totalWallet=  $totalWallets->count();

        foreach ($totalWallets as $wallet) {
            $members = Member::where('wallet_id', $wallet->wallet_id)->count();
            $totalMember += $members;
        }


       $totalMemberId = Member::where(['user_id' =>  $userDetail->user_id])->get();

        if ($totalMemberId->count() > 1) {

            foreach ($totalMemberId as $memberId) {

                $transections = Payment::where(['member_id' => $memberId->member_id])->get();

                foreach ($transections as $transection) {

                    if ($transection->payment_type == 'Cr') {

                        $totalCredit += $transection->balance;
                    } else {

                        $totalDebit += $transection->balance;
                    }
                }
            }

        }else{

            $totalMemberId = Member::where(['user_id' =>  $userDetail->user_id])->first();  

            $transections = Payment::where(['member_id' => $totalMemberId->member_id])->get();

            foreach ($transections as $transection) {

                if ($transection->payment_type == 'Cr') {

                   $totalCredit += $transection->balance;

                } else {

                   $totalDebit += $transection->balance;
                }
            }
        }

        $data = [
            'totalDebit' => $totalDebit,
            'totalCredit' => $totalCredit,
            'totalMember' => $totalMember,
            'totalWallet' => $totalWallet,


        ];
            
        return view('Website.profile', compact('user','data'));
    }

    // Update User Profile
    public function updateProfile(Request $request, $user_id)
    {

        $user = User::where('user_id', $user_id)->first();

        if (isset($request->image)) {

            if ($user->image == Null) {

                $Image = $request->file('image');
                $imageName = $Image->getClientOriginalName();
                $Image->storeAs('public/UserImage', $imageName);
                $user->image = $imageName;
            } else {

                $old_image = public_path('storage/UserImage/') . $user->image;
                if (file_exists($old_image)) {
                    @unlink($old_image);
                }

                $Image = $request->file('image');
                $imageName = $Image->getClientOriginalName();
                $Image->storeAs('public/UserImage', $imageName);
                $user->image = $imageName;
            }
        }

        $user->name = $request->name;
        $user->phone = $request->phone;
        $result = $user->save();


        if ($result) {
            return redirect()->route('profile')->with('update', 'Profile Update successfully');
        } else {
            return redirect()->route('profile')->with('error', 'Profile Not Updated');
        }
    }

    // User Login
    public function userLogin(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);


        $email = $request->email;
        $password = $request->password;

        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            $emailVerify = User::where(['emailVerify' => TRUE, 'email' => $email])->first();
            if ($emailVerify) {
                return redirect('dashboard')->with('login', 'Account Sign In Successfuly');
            } else {
                return redirect()->back()->with('warning', 'Email Not Verified');
            }
        } else {
            return redirect()->back()->with('error', 'Email Password Not Found');
        }
    }

    // Email Verification   
    public function emailVerify(Request $request)
    {


        $request->validate([
            'otp' => 'required|numeric',

        ]);

        $result = DB::table('users')->where('email_verification_code', $request->otp)->update([
            'email_verification_code' =>  NULL,
            'emailVerify' => TRUE
        ]);

        if ($result) {
            return redirect('login')->with('success', 'Account Created Successfully');
        } else {
            return redirect()->back()->with('error', 'Otp Is Invalid');
        }
    }

    // Forgot User Password 
    public function forgotPassword(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
        ]);

        $verifyEmail = User::where('email', $request->email)->first();

        if ($verifyEmail) {

            $otp = rand('111111', '999999');
            DB::table('users')->where('email', $request->email)->update([
                'email_verification_code' =>  $otp
            ]);

            $Otp = [
                'subject' => 'Password Forgot One-Time Password (OTP)',
                'otp' => $otp
            ];

            Mail::to($request->email)->send(new forgotPassword($Otp));


            return redirect('login')->with('forgot', 'Otp Send To Email');
        } else {
            return redirect()->back()->with('error', 'Email Not Found');
        }
    }

    // Create New Password 
    public function createNewPassword(Request $request)
    {
        $request->validate([
            'otp' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        $VerifyUser = User::where([['email', $request->email], ['email_verification_code', $request->otp]])->first();

        if ($VerifyUser) {

            $data = User::where('email', $request->email)->first();

            $data->email_verification_code = NULL;
            $data->password = $request->password;
            $result = $data->save();

            return redirect('login')->with('created', 'New Password Created Successfully');
        } else {
            return redirect()->back()->with('error', 'Something Went Wrong!');
        }
    }

    // Change Password With Old Password 
    public function changePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'password_confirmation' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);

        $email = Auth::user()->email;

        if (Auth::attempt(['email' => $email, 'password' => $request->old_password])) {

            $data = User::where('email', $email)->first();
            $data->password = $request->password;
            $result = $data->save();

            if ($result) {
                Auth::logout();
                return redirect('login')->with('change', 'Password Change Successfully');
            } else {
                return redirect()->back()->with('error', 'Password Not Changed');
            }
        } else {
            return redirect()->back()->with('error', 'Password Not Changed');
        }
    }
}
