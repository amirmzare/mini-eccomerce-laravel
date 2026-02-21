<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginPostRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function index()
    {
        $withoutHeader = true;
        $withoutFooter = true;

        $title = "وررد";
        return view('auth.login', compact('withoutHeader', 'withoutFooter' , 'title'));
    }

    public function post(LoginPostRequest $request)
    {
        $user = User::query()
            ->whereMobile($request->input('mobile'))
            ->first();

        if (!Hash::check($request->input('password') ,$user->password)){
            return back()
                ->withErrors([
                    'general' => 'رمز عبور نادرست است'
                ]);
        }

        Auth::login($user);

        return redirect()->route('index');

    }
}
