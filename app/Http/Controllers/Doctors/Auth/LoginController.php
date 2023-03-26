<?php

namespace App\Http\Controllers\Doctors\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;

class LoginController extends Controller
{
    public function login()
    {
        if (Auth::guard('doctor')->check()) {

            echo 'thành công';
            $doctorInfo = Auth::guard('doctor')->user();
            dd($doctorInfo);
        }
        return view('doctors.auth.login');
    }
    public function postLogin(Request $request)
    {

        $dataLogin = $request->except('_token');
        if (isDoctorActive($dataLogin['email'])) {

            $checkLogin = Auth::guard('doctor')->attempt($dataLogin);
            if ($checkLogin) {
                return redirect(RouteServiceProvider::DOCTORS);
            }
            return back()->with('msg', 'Mật khẩu không hợp lệ');
        };
        return back()->with('msg', 'Tài khoản chưa được kích hoạt');
    }
}
