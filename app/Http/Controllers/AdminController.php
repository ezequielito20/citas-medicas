<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Secretary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        $total_users = User::count();
        $total_secretaries = Secretary::count();
        return view('admin.index', compact('total_users','total_secretaries'));
    }

    public function logout(Request $request){
        Auth::logout();

        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect('/');
    }
}
