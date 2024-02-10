<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class otpController extends Controller
{

    public function sendotp(Request $request){
        $otp = rand(1000,9999);
        Mail::send('emials.otp',['otp'=>$otp],function($message) use ($request){

            $message->to($request->input('email'))->subject('your OTP');

        });
        return response()->json(['message'=>'OTP sent successfully']);

    }
}
