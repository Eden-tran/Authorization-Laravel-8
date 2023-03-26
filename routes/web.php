<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Faker\Factory;
use App\Http\Controllers\adminController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Doctors\Auth\LoginController;
use App\Http\Controllers\Doctors\IndexController;
use App\Http\Controllers\doctors\auth\forgotPasswordController;
use App\Http\Controllers\Doctors\Auth\ResetPasswordController;
use Illuminate\Routing\Route as IlluminateRoutingRoute;
use Symfony\Component\Routing\Route as RoutingRoute;
use Symfony\Component\Routing\RouteCompiler;
use App\Http\Controllers\Admin\PostController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    // return '<h1>Laravel Authentication</h1>';
    $limit = 20;
    $faker = Factory::create();
    $phone = '0' . rand(100000000, 999999999);
    echo $phone;
});
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [adminController::class, 'index'])->middleware(['auth', 'verified']);
    Route::prefix('posts')->name('posts.')->group(function () {

        Route::get('/', [PostController::class, 'index'])->name('index');
        Route::get('/add', [PostController::class, 'add'])->name('add');
        Route::get('/edit/{id}', [PostController::class, 'edit'])->name('edit');
    });
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware(['verified']);
// link thông báo verify khi người đk tài khoản chưa xác thực email
Route::get('/email/verify', function () {
    return view('auth.verify');
})->middleware('auth')->name('verification.notice');
// liên kết sẽ được gửi vào mail người đk
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');
// resend email
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.resend');

// test route
// Route::group([
//     'name' => 'doctor.',
//     'prefix' => 'doctor',
//     'namespace' => 'Doctors\Auth'
// ], function () {
//     Route::get('login', 'LoginController@login');
//     Route::post('login', 'LoginController@postLogin');
// });
// test route

Route::prefix('doctor')->name('doctor.')->group(function () {
    Route::get('/', [IndexController::class, 'index'])->middleware('auth:doctor');
    Route::get('login', [LoginController::class, 'login'])->middleware('guest:doctor')->name('login');
    Route::get('forgot-password', [forgotPasswordController::class, 'getForgot'])->middleware('guest:doctor')->name('getForgot');
    Route::post('forgot-password', [forgotPasswordController::class, 'sendResetLinkEmail'])->middleware('guest:doctor')->name('postForgot');

    Route::post('login', [LoginController::class, 'postLogin'])->middleware('guest:doctor')->name('postLogin');
    // Route::get('reset-password/{token}', function () {
    //     return 'reset password';
    // })->name('reset-password');
    Route::get('reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('reset-password');

    Route::post('reset-password', [ResetPasswordController::class, 'reset'])->name('update-password');
    /*
        -lưu ý middleware auth là BẮT BUỘC PHẢI ĐĂNG NHẬP mới pass được
        -middleware guest là đã đăng nhập rồi thì không truy cập được. bắt buộc phải log out ra mới truy cập dc các route dc check bởi middleware guest

    */
    Route::post('logout', function () {
        Auth::guard('doctor')->logout();
        return redirect()->route('doctor.login');
    })->middleware('auth:doctor')->name('logout');
});
