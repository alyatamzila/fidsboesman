<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Anda harus login terlebih dahulu!');
        }

        return view('admin.dashboard', compact('user'));
    }
}


