<?php

namespace App\Http\Controllers\Doctors\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Auth;



class ResetPasswordController extends Controller
{
    protected $redirectTo = '/doctor';
    use ResetsPasswords;
    protected function rules()
    {
        return [
            'token' => 'required',
            'email' => 'required|email',
            'password' => ['required', 'confirmed', 'min:6'],
        ];
    }
    protected function validationErrorMessages()
    {
        return [
            'token.required' => 'Token không được để trống',
            'email.required' => 'Email không được để trống',
            'email.email' => 'Email không đúng định dạng',
            'password.required' => 'Password không được để trống',
            'password.confirmed' => 'Password phải giống nhau',
            'password.min' => 'Password tối thiểu :min ký tự'
        ];
    }
    public function showResetForm(Request $request)
    {
        $token = $request->route()->parameter('token');
        return view('doctors.auth.reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }
    public function broker()
    {
        return Password::broker('doctors');
    }
    protected function guard()
    {
        return Auth::guard('doctor');
    }
}