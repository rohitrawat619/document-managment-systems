<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Helper;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;

class AppController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
    */
    public function login(Request $request)
    {
        if($request->isMethod('get'))
        {
            Helper::crypto_keys();
            $salt=session('salt');
            $iv=session('iv');
            $key=session('key');
            $keySize=session('keySize');
            $iterations=session('iterations');
            //captcha implementation
            Helper::showCaptcha();

            $captcha=session('captcha_answer');

            return view('auth.admin_login',compact('salt', 'iv', 'key', 'keySize', 'iterations', 'captcha'));
        }

        $captcha=session('captcha_answer');
        $rules = [
            'username'=> 'required',
            'password'=> 'required',
            'captcha' => 'required|string|in:'.$captcha, // Validate captcha
        ];

        $messages = [
            'password.required' => 'Please fill password',
            'captcha.string' => 'The CAPTCHA answer must be correct.',
            'captcha.in' => 'Incorrect CAPTCHA answer.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect()->route('admin.login')->withErrors($validator)->withInput();
        }

        $credentials = $request->only('username', 'password');

        $credentials['user_name']=$credentials['username'];

        unset($credentials['username']);

        $credentials['password']=Helper::decryptPassword($credentials['password']);

        //$remember_me = $request->has('remember_me') ? true : false;

        if (Auth::attempt($credentials)) {

            return redirect()->route('admin.home');
        }

        return back()->with('error', 'The provided credentials do not match our records.');

    }


}
