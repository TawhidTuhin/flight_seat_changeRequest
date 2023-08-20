<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Flight;
use App\Models\Swap;
use Carbon\Carbon;

class FlightContoller extends Controller
{
    public function home() {
        return view('index');
    }
    public function flights(Request $request){
        $validatedData = $request->validate([
            'flight_number' => 'required|max:255',
            'date' => 'required|max:255',
            'time' => 'required|max:255',
        ]);
        if (Flight::where('flight_number', $request->flight_number)->where('date', $request->date)->where('time', $request->time)->exists()) {
            return view('swap',[
                'data' => Flight::where('flight_number', $request->flight_number)->where('date', $request->date)->where('time', $request->time)->first(),
                'swaps' => Swap::where('flight_number', $request->flight_number)->where('date', $request->date)->where('time', $request->time)->get()
            ]);
            
        }
        else {
            Flight::create([
                'flight_number' => $request->flight_number,
                'date' => $request->date,
                'time' => $request->time,
                'created_at' => Carbon::now(),
            ]);
            return view('swap',[
                'data' => Flight::where('flight_number', $request->flight_number)->where('date', $request->date)->where('time', $request->time)->first(),
                'swaps' => Swap::where('flight_number', $request->flight_number)->where('date', $request->date)->where('time', $request->time)->get()
            ]);
        }
    }
    public function swap(Request $request) {

        $validatedData = $request->validate([
            'flight_number' => 'required|max:255',
            'date' => 'required|max:255',
            'time' => 'required|max:255',
            'email' => 'required|email|max:255',
            'current_seat' => 'required|max:255',
            'swap_seat' => 'required|max:255',
        ]);
        if (Swap::where('email', $request->email)->where('flight_number', $request->flight_number)->where('date', $request->date)->where('time', $request->time)->exists()) {
            return view('swap',[
                'data' => Flight::where('flight_number', $request->flight_number)->where('date', $request->date)->where('time', $request->time)->first(),
                'swaps' => Swap::where('email', $request->email)->where('flight_number', $request->flight_number)->where('date', $request->date)->where('time', $request->time)->get()
            ])->with('warning', 'This email is alredy stored our system. Please delete first!');
        }
        else {
            Swap::create([
                'flight_number' => $request->flight_number,
                'date' => $request->date,
                'time' => $request->time,
                'email' => $request->email,
                'current_seat' => $request->current_seat,
                'swap_set' => $request->swap_seat,
                'created_at' => Carbon::now()        
            ]);
            
            return view('swap',[
                'data' => Flight::where('flight_number', $request->flight_number)->where('date', $request->date)->where('time', $request->time)->first(),
                'swaps' => Swap::where('flight_number', $request->flight_number)->where('date', $request->date)->where('time', $request->time)->get()
            ])->with('message', 'Your Request Submited Succesfully!');
        }
    }
    public function flightsview(){
        return view('index');
    }
    public function delete($id){
        Swap::find($id)->delete();
        return view('index')->with('message', 'Data deleted succesfully');
        
    }
}
