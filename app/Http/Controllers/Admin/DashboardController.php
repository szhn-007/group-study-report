<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function root()
    {
        if (Auth::check())
        {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('admin.login');
    }

    public function dashboard()
    {
        return view('admin.dashboard.index');
    }
}
