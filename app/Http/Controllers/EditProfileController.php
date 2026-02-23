<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditProfilePostRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class EditProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        return view('account.edit-profile',compact('user'));
    }

    public function post(EditProfilePostRequest $request)
    {
        $inputs = $request->only([
            'first_name',
            'last_name',
            'mobile',
            'email'
        ]);

        if($request->filled('password')){
            $inputs['password']=Hash::make($request->input('password'));
        }

        Auth::user()->update($inputs);

        return redirect()->back()->withErrors([
            'general' => 'با موفقیت تغییرات یافت'
        ]);

    }
}
