<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ConfirmsPasswords;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

class ConfirmPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Confirm Password Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password confirmations and
    | uses a simple trait to include the behavior. You're free to explore
    | this trait and override any functions that require customization.
    |
    */

    use ConfirmsPasswords;

    /**
     * Where to redirect users when the intended url fails.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::ADMIN;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    protected function validationErrorMessages()
    {
        return [
            'password.required' => 'Mật Khẩu bắt buộc phải nhập',
            'current_password' => 'Mật khẩu không chính xác',
        ];
    }
    public function confirm(Request $request)
    {
        $request->validate($this->rules(), $this->validationErrorMessages());
        // xử lý gửi email khi confirm thành công
        $mail = Auth::user()->email;
        $name = Auth::user()->name;
        Mail::send([], [], function ($message) use ($name, $mail) {

            $content = "Chào $name <br/>";
            $content .= "Bạn vừa xác nhận mật khẩu thành công";

            $message->to($mail)
                ->subject('Xác nhận mật khẩu thành công')

                ->setBody($content, 'text/html'); // for HTML rich messages
        });


        $this->resetPasswordConfirmationTimeout($request);

        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect()->intended($this->redirectPath());
    }
}
