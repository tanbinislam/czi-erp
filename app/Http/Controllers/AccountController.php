<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class AccountController extends Controller{
    public function __construct(){
      $this->middleware('auth');
    }

    public function index(){
      return view('admin.account.personal-info');
    }

    public function editPassword($slug){
      return view('admin.account.updatePassword', compact('slug'));
    }

    public function updatePassword(Request $request, $slug){
      $request->validate([
        'old_pass' => ['required'],
        'password' => ['required', 'confirmed', Rules\Password::defaults()],
      ]);

      $user = User::where('status', 1)->where('slug', $slug)->sole();

      if(Hash::check($request->old_pass, $user->password)){
        $user->password = Hash::make($request->password);
        $user->save();
        session()->flash('success', 'Password Updated!');
        return back();
      }else{
        session()->flash('error', 'Password Update Failed!');
        return back();
      }
    }

    public function invoice(){
      return view('admin.invoice.index');
    }
}
