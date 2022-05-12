<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function changeAccount(){
        return view('change-account');
    }

    public function updateAccount(Request $request){
        // Validate
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        // Check if old password is correct
        if(!Hash::check($request->password, auth()->user()->password)){
            return back()->with('error', "Your password is incorrect.");
        }

        // If password is correct, update account with new password
        User::whereId(auth()->user()->id)->update([
            'name' => $request->name,
            'email' => $request->email
        ]);


        return back()->with('status', "Account details have been changed successfully.");
    }

    public function changePassword(){
        return view('change-password');
    }

    public function updatePassword(Request $request){

        // Validate
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);

        // Check if old password is correct
        if(!Hash::check($request->old_password, auth()->user()->password)){
            return back()->with('error', "Old password is incorrect.");
        }

        // If password is correct, update account with new password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);


        return back()->with('status', "Password has been changed successfully.");
    }
}
