<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginPostRequest;
use App\Http\Requests\Auth\RegisterPostRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        $withoutHeader = true;
        $withoutFooter = true;

        $title = "ثبت نام";

        return view('auth.register', compact('withoutHeader', 'withoutFooter', 'title'));
    }

    public function post(RegisterPostRequest $request)
    {
        $inputs = $request->only([
            'first_name',
            'last_name',
            'mobile',
            'email'
        ]);

        $inputs['password'] = Hash::make($request->input('password'));

        $user = User::create($inputs);

        Auth::login($user);

        return redirect()->route('index');
    }
}
