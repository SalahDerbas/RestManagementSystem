<?php

namespace App\Http\Controllers\Casher;

//Uses Models 

use App\Category;
use App\Http\Controllers\Controller;
use App\Meal;
use App\Report;
use App\Reservation;
use App\Reservation_item;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CasherController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:casher');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */


    // Name of function Index
    // Return view home of casher Folder 

    public function index()
    {
        return view('casher.home');
    }


    // Name of function reservations
    // Request Data reservations of DB
    // Return view reservations of casher Folder

    public function reservations(Request $request){

        if($request->ajax())
        {
            $data = Reservation::latest()->with('user')->get();

            return DataTables::of($data)
                ->addColumn('action', function($data){
                    $button = '<div class="btn-group" role="group" aria-label="Basic example">';
                    $button .= '<button type="button" name="edit" id="'.$data->id.'"
                    class="edit btn btn-primary btn-sm" onclick=update('.$data->id.')>Edit</button>';
                    $button .= '&nbsp;&nbsp;&nbsp;<button type="button" name="delete" id="'.$data->id.'"
                    class="delete btn btn-danger btn-sm" onclick=del('.$data->id.')>Delete</button>';
                    $button .= '&nbsp;&nbsp;&nbsp;<button type="button" name="order" id="'.$data->id.'"
                    class="delete btn btn-warning btn-sm" onclick=order('.$data->id.')>Order</button> ';
                    $button .= '&nbsp;&nbsp;&nbsp;<button type="button" name="orders" id="'.$data->id.'"
                    class="delete btn btn-success btn-sm" onclick=orders('.$data->id.')>Orders</button></div>';

                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('casher.reservations');

    }


    // Name of function editReservation 
    // Return view edit-reservation of casher Folder

    public function editReservation(Reservation $reservation){

        return view('casher.edit-reservation',compact('reservation'));
    }


    // Name of function updateReservation
    // Uses variables (date,number) to update in DB 
    // Return view reservation of casher Folder

    public function updateReservation(Request $request,Reservation $reservation){
        $request->validate([
            'date'=> 'required',
            'number'=> 'required',
        ]);


        $reservation->date = $request->date;
        $reservation->number = $request->number;
        $reservation->save();

        return redirect()->route('casher.reservations');
    }


    // Name of function deleteReservation
    // Return response for destroy

    public function deleteReservation(Request $request){
        Reservation::destroy($request->id);
        return response([],200);
    }

    // Name of function reservation
    // Return view reservation of Casher Folder

    public function reservation(Request $request){
        return view('casher.reservation');
    }


    // Name of function reserve
    // Uses variables (date,number) to update in DB 
    // Return view home of casher Folder

    public function reserve(Request $request){
        $request->validate([
            'date'=> 'required',
            'number'=> 'required',
        ]);

        $reservation = new Reservation();
        $reservation->date = $request->date;
        $reservation->number = $request->number;
        $reservation->user_id = -1;
        $reservation->save();

        return redirect()->route('casher.home');
    }

    // Name of function addOrder
    // Uses Category Model
    // Return view add-order of casher Folder

    public function addOrder(Reservation $reservation){
        $categories = Category::all();
        return view('casher.add-order',compact('categories','reservation'));
    }


    // Name of function storeOrder
    // Uses variables (meals) to store Order in DB 
    // Return view reservations of casher Folder

    public function storeOrder(Request $request,Reservation $reservation){

        $request->validate([
            'meals'=> 'required|array|min:1',
        ]);
        $orders = [];
        foreach ($request->meals as $meal){
            $order = new Reservation_item();
            $order->reservation_id =  $reservation->id;
            $order->casher_id = auth()->user()->id;
            $order->meal_id = $meal;
            $order->quantity = 1;
            $m = Meal::find($meal);


            $order->tot_price = $m->price * 1;
            $order->save();

            array_push($orders,$order);
        }
        //$meals = $request->meals;
        $orders = serialize($orders);
        return redirect()->route('casher.order.quantity',compact('orders'));
    }


    // Name of function orderQuantity
    // Uses variables (ords,orders) to  QuantityOrder in DB 
    // Return view order-quantity of casher Folder

    public function orderQuantity(Request $request)
    {
        $orders = unserialize($request->orders);
        $ords = serialize($orders);
        return view('casher.order-quantity',compact('orders','ords'));
    }


    // Name of function storeOrderQuantity
    // Uses variables (numbers) to store QuantityOrder in DB 
    // Return view reservations of casher Folder

    public function storeOrderQuantity(Request $request,$ords){

        $request->validate([
            'numbers'=> 'required|array',
        ]);
        $orders = json_decode($ords);

        foreach ($orders as $k=>$orderr){
            $order = Reservation_item::find($orderr->id);
            $order->quantity = $request->numbers[$k];
            $m = Meal::find($order->meal_id);
            $order->tot_price = $m->price * $order->quantity;
            $order->save();
        }

        return redirect()->route('casher.reservations');
    }


    // Name of function editOrder 
    // Return view edit-Order of Admin Folder

    public function editOrder(Request $request,Reservation_item $order)
    {
        return view('casher.edit-order',compact('order'));
    }


    // Name of function updateOrder
    // Uses variables (quantity) to update in DB 
    // Return view reservation of casher Folder

    public function updateOrder(Request $request,Reservation_item $order){

        $request->validate([
            'quantity'=> 'required',
        ]);

        $order->quantity = $request->quantity;
        $order->tot_price = $order->meal()->get()[0]->price*$request->quantity;
        $order->save();

        return redirect()->route('casher.reservations');
    }


    // Name of function orders
    // Request Data orders of DB
    // Return view orders of casher Folder

    public function orders(Request $request,Reservation $reservation){
        $data = Reservation_item::where('reservation_id',$reservation->id)->get();
        $total = $data->sum('tot_price');
        if($request->ajax())
        {
            $data = Reservation_item::where('reservation_id',$reservation->id)->with('meal')->get();

            return DataTables::of($data)
                ->addColumn('action', function($data){
                    $button = '<div class="btn-group" role="group" aria-label="Basic example">';
                    $button .= '<button type="button" name="edit" id="'.$data->id.'"
                    class="edit btn btn-primary btn-sm" onclick=update('.$data->id.')>Edit</button>';
                    $button .= '&nbsp;&nbsp;&nbsp;<button type="button" name="delete" id="'.$data->id.'"
                    class="delete btn btn-danger btn-sm" onclick=del('.$data->id.')>Delete</button>';

                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);

        }

        return view('casher.orders',compact('reservation','total'));

    }


    // Name of function deleteOrder
    // Return response for destroy

    public function deleteOrder(Request $request){
        Reservation_item::destroy($request->id);
        return;
    }


    // Name of function addReport
    // Return view add-report of casher Folder

    public function addReport(){

        return view('casher.add-report');
    }


    // Name of function storeReport
    // Uses variables (content,income,days_off) to store Report in DB 
    // Return view reports of casher Folder

    public function storeReport(Request $request){

        $request->validate([
            'content'=> 'required',
            'income'=> 'required',
            'days_off'=> 'required',
        ]);
        $r = new Report();
        $r->content = $request['content'];
        $r->income = $request['income'];
        $r->outcome = '';
        $r->days_off = $request['days_off'];
        $r->casher_id = auth()->user()->id;
        $r->save();


        return redirect()->route('casher.reports');
    }


    // Name of function editReport 
    // Return view edit-report of Casher Folder

    public function editReport(Request $request,Report $report)
    {
        return view('casher.edit-report',compact('report'));
    }

    // Name of function updateReport
    // Uses variables (content,income,days_off) to update in DB 
    // Return view reports of casher Folder

    public function updateReport(Request $request,Report $report){

        $request->validate([
            'content'=> 'required',
            'income'=> 'required',
            'days_off'=> 'required',
        ]);
        $report->content = $request['content'];
        $report->income = $request['income'];
        $report->days_off = $request['days_off'];
        $report->casher_id = auth()->user()->id;
        $report->save();

        return redirect()->route('casher.reports');
    }


    // Name of function reports
    // Request Data reports of DB
    // Return view reports of casher Folder

    public function reports(Request $request){
        if($request->ajax())
        {
            $data = Report::latest()->get();

            return DataTables::of($data)
                ->addColumn('action', function($data){
                    $button = '<div class="btn-group" role="group" aria-label="Basic example">';
                    $button .= '<button type="button" name="edit" id="'.$data->id.'"
                    class="edit btn btn-primary btn-sm" onclick=update('.$data->id.')>Edit</button>';
                    $button .= '&nbsp;&nbsp;&nbsp;<button type="button" name="delete" id="'.$data->id.'"
                    class="delete btn btn-danger btn-sm" onclick=del('.$data->id.')>Delete</button>';

                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);

        }

        return view('casher.reports');

    }


    // Name of function deleteReport
    // Return response for destroy
    
    public function deleteReport(Request $request){
        Report::destroy($request->id);
        return;
    }
}
