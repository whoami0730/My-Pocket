<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\PaymentController;

Route::view('signUp','Auth.signUp');
Route::view('login','Auth.login')->name('login');
Route::view('forgotPassword','Auth.forgotPassword');
Route::view('createNewPassword','Auth.createNewPassword');
Route::view('emailVerification','Auth.emailVerification');
Route::view('changePassword','Website.changePassword');

Route::view('dashboard','Website.dashboard')->middleware('auth');
Route::view('addWallet','Website.addWallet')->middleware('auth');
Route::view('wallet','Website.wallet')->middleware('auth');
Route::view('payment','Website.payment')->middleware('auth');
Route::view('profile','Website.profile')->name('profile')->middleware('auth');
Route::view('createPassword','Website.createPassword')->middleware('auth');
Route::view('walletShare','Website.walletShare')->middleware('auth');



Route::controller(UserController::class)->group(function () {
    Route::post('signUp', 'store')->name('signUp');
    Route::post('emailVerify', 'emailverify')->name('emailVerify');
    Route::post('userLogin', 'userLogin')->name('userLogin');
    Route::post('forgotPassword', 'forgotPassword')->name('forgotPassword');
    Route::post('createNewPassword', 'createNewPassword')->name('createNewPassword');
    Route::post('changePassword', 'changePassword')->name('changePassword');

    Route::get('profile', 'showOnProfile')->name('profile')->middleware('auth');
    Route::post('updateProfile{user_id}', 'updateProfile')->name('updateProfile')->middleware('auth');
   
});

Route::controller(WalletController::class)->group(function () {
    Route::post('addWallet', 'store')->name('addWallet')->middleware('auth');
    Route::get('walletShare','walletShare')->middleware('auth');

    Route::get('wallet{wallet_id}','showPayment')->name('wallet')->middleware('auth');
    Route::post('editWallet{wallet_id}','updateWallet')->name('editWallet')->middleware('auth');
    Route::get('deleteWallet{wallet_id}','deleteWallet')->name('deleteWallet')->middleware('auth');

    Route::get('addMember','showOnAddMember')->middleware('auth');
    Route::get('dashboard','showOnDashboard')->middleware('auth');
    Route::get('addMoney{wallet_id}','showOnAddMoney')->name('addMoney')->middleware('auth');
    Route::get('payMoney{wallet_id}','showOnPayMoney')->name('payMoney')->middleware('auth');
   
});

Route::controller(PaymentController::class)->group(function () {
    Route::post('debit', 'debitMoney')->name('debit')->middleware('auth');
    Route::post('credit', 'creditMoney')->name('credit')->middleware('auth');
    
   
});

Route::controller(MemberController::class)->group(function () {
    Route::post('addMember', 'store')->name('addMember');
    Route::get('deleteMember{member_id}', 'deleteMember')->name('deleteMember')->middleware('auth');
    Route::get('updateMember{member_id}', 'updateMember')->name('updateMember')->middleware('auth');
    Route::get('leaveMember{member_id}', 'leaveMember')->name('leaveMember')->middleware('auth');

});

Route::get('logout',function(){
     
    if(Auth::check()){
        Auth::logout();
        return redirect('login');
    }
    else{
        return redirect('login'); 
    }
})->name('logout')->middleware('auth');






