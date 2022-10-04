<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;
    protected $redirectTo = '/verify';
    
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
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $rulus = [
            'nickname' => ['required', 'string', 'max:100'],
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'max:32', 'confirmed', 'regex:/(?=.*[a-zA-Z])(?=.*[0-9])/'],
          ];
        
        $message = [
            'nickname.required' => 'ユーザーIDを入力してください',
            'nickname.string' => '文字列で入力してください',
            'nickname.max' => '100文字以内で入力してください',
            'name.required' => '名前を入力してください',
            'name.string' => '文字列で入力してください',
            'name.max' => '100文字以内で入力してください',
            'email.required' => 'メールアドレスを入力してください',
            'email.string' => '文字列で入力してください',
            'email.email' => 'メールアドレスをご確認ください',
            'email.max' => '255文字以内で入力してください',
            'email.unique' => 'このメールアドレスは既に使用されています',
            'password.required' => 'パスワードを入力してください',
            'password.string' => '文字列で入力してください',
            'password.min' => '8文字以上で入力してください',
            'password.max' => '32文字以内で入力してください',
            'password.confirmed' => 'パスワード確認が一致しません',
            'password.regex' => '半角数字と半角英字のどちらも含むパスワードを入力してください',
        ];
        return Validator::make($data, $rulus, $message);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'nickname' => $data['nickname'],
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
