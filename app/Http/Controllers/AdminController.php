<?php

namespace App\Http\Controllers;

use App\Models\Hour;
use App\Models\User;
use App\Models\Doctor;
use App\Models\Event;
use App\Models\Office;
use App\Models\Patient;
use App\Models\Secretary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        $total_users = User::count();
        $total_secretaries = Secretary::count();
        $total_patients = Patient::count();
        $total_offices = Office::count();
        $total_doctors = Doctor::count();
        $total_hours = Hour::count();


        $offices = Office::all();

        $doctors = Doctor::all();
        $events = Event::with('doctor','office')->get();
        $total_events = $events->count();
        return view('admin.index', compact('total_users','total_secretaries','total_patients','total_offices','total_doctors','total_hours','offices','doctors','events','total_events'));
        
    }
    public function see_reservations($id){
        $events = Event::with('doctor','office')->where('user_id',$id)->get();
        return view('admin.see_reservations', compact('events'));
    }

    public function logout(Request $request){
        Auth::logout();

        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect('/');
    }

}
