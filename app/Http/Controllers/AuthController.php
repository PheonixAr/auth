<?php

namespace App\Http\Controllers;

use App\Models\usersDetatils;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\File;
use Illuminate\Pagination\Paginator;


class AuthController extends Controller
{
    public function register()
    {
        return view('register');
    }

    public function registerPost(Request $req)

    {
        $customer = new usersDetatils();

        if (empty($req->all())) {
            $req->validate([
                'name' => 'required |alpha',
                'email' => 'required | email',
                'password' => 'required |min:10',
                'confirm_password' => 'required |same:password ',
                'phone' => 'required |numeric|digits:10',
                'gender' => 'required',
                'file' => [File::types(['pdf', 'doc', 'docx', 'rtf'])->min(512)->max(12 * 1024)]

            ]);
            echo '<pre>';
            print_r($req->all());
        }

        // $user->name = $request->name;
        // $user->email = $request->email;
        // $user->password = Hash::make($request->password);

        $vname = $req->validate(['name' => 'required | alpha']);
        $customer->name = implode(" ", $vname);


        $vemail = $req->validate(['email' => 'required | email']);
        $customer->email = implode(' ', $vemail);

        $vpassword = $req->validate(['password' => 'required |min:10']);
        $vpass_string = implode(' ', $vpassword);
        $customer->password = Hash::make($vpass_string);


        $vconfim_pass = $req->validate(['confirm_password' => 'required |same:password']);
        // $customer->confirm_password = implode(' ', $vconfim_pass);

        $vphone = $req->validate(['phone' => 'required |numeric|digits:10']);
        // $customer->dob = $req->dob;
        $customer->phone = implode(' ', $vphone);

        // $customer->phone = Crypt::decrypt($customer->password);

        $vgender = $req->validate(['gender' => 'required']);
        $customer->gender = implode(' ', $vgender);

        // $vfile = $req->validate(['file' => File::types(['pdf', 'doc', 'docx', 'rtf'])->min(512)->max(12 * 1024)]);
        // $customer->file = $vfile;

        $vfile = $req->validate(['file' => 'required']);
        $customer->file =  implode(' ', $vfile);


        $customer->role = 'customer';

        // $customer->name = $req->name;
        // $customer->email = $req->email;
        // $customer->password = Hash::make($req->password);
        // $customer->phone = $req->phone;
        // $customer->gender = $req->gender;
        // $customer->file = $req->file;
        $customer->save();

        return back()->with('success', 'Register successfully');
    }

    public function login()
    {
        return view('login');
    }

    public function loginPost(Request $request)
    {
        $credetials = [
            'email' => $request->email,
            'password' => $request->password,
            'role' => 'customer'
        ];

        if (Auth::attempt($credetials)) {
            return redirect('/home')->with('success', 'Login Success');
        }

        return back()->with('error', 'invalid Email or Password');
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('login');
    }


    public function adminlogin()
    {
        return view('admin');
    }

    public function adminloginPost(Request $request)
    {
        $credetials_admin = [
            'email' => $request->email,
            'password' => $request->password,
            'role' => 'admin'
        ];

        if (Auth::attempt($credetials_admin)) {
        }

        if (Auth::attempt($credetials_admin)) {
            return redirect('/home')->with('success', 'Login Success');
        }

        return back()->with('error', 'invalid Email or Password');
    }

    public function adminlogout()
    {
        Auth::logout();

        return redirect()->route('login');
    }

   
}
