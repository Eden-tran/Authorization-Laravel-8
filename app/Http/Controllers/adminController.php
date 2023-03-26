<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class adminController extends Controller
{
    public function index()
    {
        $userDetail = Auth::user();
        return view('auth.admin', compact('userDetail'));
    }
}
