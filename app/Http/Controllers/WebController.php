<?php

namespace App\Http\Controllers;

use App\Models\Hour;
use App\Models\Event;
use App\Models\Office;
use Illuminate\Http\Request;

class WebController extends Controller
{
    public function index($id=1){
        // try {
        //     $hours = Hour::with('doctor', 'office')->where('office_id', $id)->get();
        //     return view('admin.hours.offices_data', compact('hours'));
        // } catch (\Throwable $th) {
        //     //throw $th;
        // }
        $offices = Office::all();
        $hours = Hour::with('doctor', 'office')->get();
        return view('index', compact('hours', 'offices'));
    }

    public function offices_data($id){
        
        try {
            $hours = Hour::with('doctor', 'office')->where('office_id', $id)->get();
            return view('admin.offices_data', compact('hours'));
        } catch (\Exception $exception) {
            return response()->json(['message'=>'Error']);
        }
        
    }

    public function doctors_reservations($id){
        try {
            $events = Event::where('doctor_id', $id)->get();
            return response()->json($events);
        } catch (\Exception $exception) {
            return response()->json(['message'=>'Error']);
        }
        
    }
}
