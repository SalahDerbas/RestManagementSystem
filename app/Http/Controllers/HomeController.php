<?php

namespace App\Http\Controllers;

use App\Meal;
use App\Reservation;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    // Name of function Index
    // Return view home of user Folder 

    public function index()
    {
        return view('user.home');
    }

    // Name of function reservation
    // Return view reservation of user Folder 

    public function reservation(Request $request){
        return view('user.reservation');
    }

   // Name of function reserve
    // Uses variables (date,number) to save in DB 
    // Return view home 

    public function reserve(Request $request){
        $request->validate([
           'date'=> 'required',
           'number'=> 'required',
        ]);

        $reservation = new Reservation();
        $reservation->date = $request->date;
        $reservation->number = $request->number;
        $reservation->user_id = auth()->user()->id;
        $reservation->save();

        return redirect()->route('home');
    }


    // Name of function meals
    // Return view meals of user Folder 

    public function meals(){
        $meals = Meal::all();
        return view('user.meals',compact('meals'));
    }


    // Name of function showMeal
    // Return view show-meal of user Folder 
    
    public function showMeal(Meal $meal){

        return view('user.show-meal',compact('meal'));
    }
}
