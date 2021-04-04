<?php

namespace App\Http\Controllers\Admin;

//Uses Models 

use App\Casher;
use App\Category;
use App\Http\Controllers\Controller;
use App\Meal;
use App\Report;
use App\Reservation;
use App\Reservation_item;
use Carbon\Carbon;
use Chartisan\PHP\Chartisan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Yajra\DataTables\Facades\DataTables;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */


    // Name of function Index
    // Uses variables (vals,days) 
    // Return view home of Admin Folder

    public function index()
    {
        $income = Reservation_item::select('created_at',DB::raw('SUM(tot_price) AS total'))
            ->where(DB::raw("month(created_at)"),
                Carbon::createFromFormat('Y-m-d H:i:s', Carbon::now()->toDateTimeString())->month)
            ->orderBy("created_at")
            ->groupBy(DB::raw("day(created_at)"));
        $values = $income->get()
            ->toArray();
        $vals = $income->pluck('total')
            ->toArray();

        $days = $income->selectRaw('day(created_at) as date')->pluck('date')
            ->toArray();

        $outcomes = Report::select('created_at',DB::raw('SUM(outcome)+SUM(store_outcome)+SUM(out_store_outcome) AS total'))
            ->where(DB::raw("year(created_at)"),Carbon::createFromFormat('Y-m-d H:i:s', Carbon::now()->toDateTimeString())->year)

            ->orderBy("created_at")
            ->groupBy(DB::raw("day(created_at)"));

        $outcomes = $outcomes->get()
            ->toArray();




        return view('admin.home',compact('vals','days','values','outcomes'));
    }


    // Name of function createCasher
     
    // Return view create-casher of Admin Folder 

    public function createCasher(){
        return view('admin.create-casher');
    }
    // Name of function storeCasher
    // Uses variables (name,email,password,salary) to save in DB 
    // Return view cashers of Admin Folder 

    public function storeCasher(Request $request){
        $request->validate([
           'name'=>'required',
           'email'=>'required|email|unique:cashers',
           'password'=>'required|min:8',
           'salary'=>'required',
        ]);
        $casher = new Casher();
        $casher->name = $request['name'];
        $casher->email = $request['email'];
        $casher->password = Hash::make($request['password']);
        $casher->salary = $request['salary'];
        $casher->save();

        return redirect('admin/cashers');
    }


    // Name of function cashers
    // Request Data Casher of DB
    // Return view cashers of Admin Folder 

    public function cashers(Request $request){

        if($request->ajax())
        {
            $data = Casher::latest()->get();
            return DataTables::of($data)
                ->addColumn('action', function($data){
                    $button = '<button type="button" name="edit" id="'.$data->id.'"
                    class="edit btn btn-primary btn-sm" onclick=update('.$data->id.')>Edit</button>';
                    $button .= '&nbsp;&nbsp;&nbsp;<button type="button" name="delete" id="'.$data->id.'"
                    class="delete btn btn-danger btn-sm" onclick=del('.$data->id.')>Delete</button>';

                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.cashers');

    }

    // Name of function editCasher 
    // Return view edit-casher of Admin Folder

    public function editCasher(Casher $casher){

        return view('admin.edit-casher',compact('casher'));
    }

    // Name of function updateCasher
    // Uses variables (name,email,salary) to update in DB 
    // Return view cashers of Admin Folder

    public function updateCasher(Request $request,Casher $casher){
        $request->validate([
            'name'=>'required',
            'email'=>'required|email',
            'salary'=>'required',
        ]);

        $casher->name = $request['name'];
        $casher->email = $request['email'];
        $casher->salary = $request['salary'];
        $casher->save();

        return redirect()->route('admin.cashers');
    }


    // Name of function deleteCasher
    // Return response for destroy

    public function deleteCasher(Request $request){
        Casher::destroy($request->id);
        return response([],200);
    }

    /******************************************************************************************************/

    // Name of function createCategory
    // Return view create-category of Admin Folder

    public function createCategory(){
        return view('admin.create-category');
    }


    // Name of function storeCategory
    // Uses variables (name,image) to store in DB 
    // Return view categories of Admin Folder


    public function storeCategory(Request $request){
        $request->validate([
            'name'=>'required',
            'image' => 'required|image'
        ]);
        $imagePath = "";
        if ($files = $request->file('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $image = Image::make(public_path("storage/{$imagePath}"))->fit(1500, 1500);
            $image->save();
        }
        $category = new Category();
        $category->name = $request['name'];
        $category->image = $imagePath;
        $category->save();

        return redirect('admin/categories');
    }


    // Name of function categories
    // Request Data categories of DB
    // Return view categories of Admin Folder

    public function categories(Request $request){

        if($request->ajax())
        {
            $data = Category::latest()->get();
            return DataTables::of($data)
                ->addColumn('action', function($data){
                    $button = '<button type="button" name="edit" id="'.$data->id.'"
                    class="edit btn btn-primary btn-sm" onclick=update('.$data->id.')>Edit</button>';
                    $button .= '&nbsp;&nbsp;&nbsp;<button type="button" name="delete" id="'.$data->id.'"
                    class="delete btn btn-danger btn-sm" onclick=del('.$data->id.')>Delete</button>';

                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.categories');

    }


    // Name of function editCategory 
    // Return view edit-category of Admin Folder

    public function editCategory(Category $category){

        return view('admin.edit-category',compact('category'));
    }


    // Name of function updateCategory
    // Uses variables (name) to update in DB 
    // Return view categories of Admin Folder

    public function updateCategory(Request $request,Category $category){
        $request->validate([
            'name'=>'required',
        ]);
        $category->name = $request['name'];
        $category->save();

        return redirect()->route('admin.categories');
    }


    // Name of function deleteCategory
    // Return response for destroy 

    public function deleteCategory(Request $request){
       $cat = Category::find($request->id);
       $meals = $cat->meals()->get();
       foreach ($meals as $meal){
           $meal->delete();
       }
        Category::destroy($request->id);
        return response([],200);
    }

    /********************************************************************************************************/


    // Name of function createMeal
    // Return view create-meal of Admin Folder

    public function createMeal(){
        $categories = Category::all();
        return view('admin.create-meal',compact('categories'));
    }

    // Name of function storeMeal
    // Uses variables (name,image,description,category_id,price) to store in DB 
    // Return view meals of Admin Folder

    public function storeMeal(Request $request){
        $request->validate([
            'name'=>'required',
            'image' => 'required|image',
            'description' => 'required',
            'category_id' => 'required',
            'price' => 'required',
        ]);
        $imagePath = "";
        if ($files = $request->file('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $image = Image::make(public_path("storage/{$imagePath}"))->fit(1500, 1500);
            $image->save();
        }
        $meal = new Meal();
        $meal->name = $request['name'];
        $meal->image = $imagePath;
        $meal->description = $request['description'];
        $meal->category_id = $request['category_id'];
        $meal->price = $request['price'];
        $meal->save();

        return redirect('admin/meals');
    }


    // Name of function meals
    // Request Data meals of DB
    // Return view meals of Admin Folder

    public function meals(Request $request){

        if($request->ajax())
        {
            $data = Meal::latest()->get();
            return DataTables::of($data)
                ->addColumn('action', function($data){
                    $button = '<button type="button" name="edit" id="'.$data->id.'"
                    class="edit btn btn-primary btn-sm" onclick=update('.$data->id.')>Edit</button>';
                    $button .= '&nbsp;&nbsp;&nbsp;<button type="button" name="delete" id="'.$data->id.'"
                    class="delete btn btn-danger btn-sm" onclick=del('.$data->id.')>Delete</button>';

                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.meals');

    }


    // Name of function editMeal 
    // Return view edit-meal of Admin Folder

    public function editMeal(Meal $meal){

        return view('admin.edit-meal',compact('meal'));
    }


    // Name of function updateMeal
    // Uses variables (name,description,price) to update in DB 
    // Return view meals of Admin Folder

    public function updateMeal(Request $request,Meal $meal){
        $request->validate([
            'name'=>'required',
            'description'=>'required',
            'price'=>'required',
        ]);
        $meal->name = $request['name'];
        $meal->description = $request['description'];
        $meal->price = $request['price'];
        $meal->save();

        return redirect()->route('admin.meals');
    }


    // Name of function deleteMeal
    // Return response for destroy

    public function deleteMeal(Request $request){
        Meal::destroy($request->id);
        return response([],200);
    }

    /**************************************************************************************************/


    // Name of function reservations
    // Request Data reservations of DB
    // Return view reservations of Admin Folder

    public function reservations(Request $request){

        if($request->ajax())
        {
            $data = Reservation::latest()->with('user')->get();

            return DataTables::of($data)
                ->addColumn('action', function($data){
                    $button = '<div class="btn-group" role="group">';
                    $button .= '&nbsp;&nbsp;&nbsp;<button type="button" name="delete" id="'.$data->id.'"
                    class="delete btn btn-danger btn-sm" onclick=del('.$data->id.')>Delete</button>';
                    $button .= '&nbsp;&nbsp;&nbsp;<button type="button" name="orders" id="'.$data->id.'"
                    class="delete btn btn-success btn-sm" onclick=orders('.$data->id.')>Orders</button></div>';

                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.reservations');

    }


    // Name of function editReservation 
    // Return view edit-reservation of Admin Folder

    public function editReservation(Reservation $reservation){

        return view('admin.edit-reservation',compact('reservation'));
    }

//    public function updateReservation(Request $request,Reservation $reservation){
//        $request->validate([
//
//        ]);
//        //$reservation->name = $request['name'];
//
//        $reservation->save();
//
//        return redirect()->route('admin.reservation');
//    }
//
//    public function deleteReservation(Request $request){
//        Reservation::destroy($request->id);
//        return response([],200);
//    }

    /**************************************************************************************************/

    // Name of function orders
    // Request Data orders of DB
    // Return view orders of Admin Folder

    public function orders(Request $request,Reservation $reservation){

        $data = Reservation_item::where('reservation_id',$reservation->id)->get();
        $total = $data->sum('tot_price');
        if($request->ajax())
        {
            $data = Reservation_item::where('reservation_id',$reservation->id)->with('meal')->get();

            return DataTables::of($data)
                ->addColumn('action', function($data){
                    $button = '<div class="btn-group" role="group" aria-label="Basic example">';
                    $button .= '&nbsp;&nbsp;&nbsp;<button type="button" name="delete" id="'.$data->id.'"
                    class="delete btn btn-danger btn-sm" onclick=del('.$data->id.')>Delete</button></div>';

                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);

        }

        return view('admin.orders',compact('reservation','total'));

    }


    // Name of function deleteOrder
    // Return response for destroy

    public function deleteOrder(Request $request){
        Reservation_item::destroy($request->id);
        return response([],200);
    }


    // Name of function editReport
    // Return view edit-report of Admin Folder

    public function editReport(Request $request,Report $report)
    {
        return view('admin.edit-report',compact('report'));
    }


    // Name of function updateReport
    // Request Data (content,income,outcome,store_outcome,days_off) of DB
    // Return view reports of Admin Folder

    public function updateReport(Request $request,Report $report){

        $request->validate([
            'content'=> 'required',
            'income'=> 'required',
            'outcome'=> 'required',
            'store_outcome'=> 'required',
            'out_store_outcome'=> 'required',
            'days_off'=> 'required',
        ]);
        $report->content = $request['content'];
        $report->income = $request['income'];
        $report->outcome = $request['outcome'];
        $report->out_store_outcome = $request['out_store_outcome'];
        $report->store_outcome = $request['store_outcome'];
        $report->days_off = $request['days_off'];
        $report->casher_id = auth()->user()->id;
        $report->save();

        return redirect()->route('admin.reports');
    }

    // Name of function reports
    // Request Data Report of DB
    // Return view reports of Admin Folder

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

        return view('admin.reports');

    }

   
    // Name of function deleteReport
    // Return response for destroy

    public function deleteReport(Request $request){
        Report::destroy($request->id);
        return;
    }

    public function exportCsv(Reservation $reservation){
        $headers = array(
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=file.csv",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        );

        $orders = $reservation->items()->get();
      //  dd($orders);
        $columns = array('id', 'reservation_id', 'meal_id', 'casher_id', 'quantity', 'tot_price');

        $callback = function() use ($orders, $columns)
        {
            $file = fopen('out.csv', 'w');
            fputcsv($file, $columns);

            foreach($orders as $order) {
                fputcsv($file, array($order->id, $order->reservation_id, $order->meal_id, $order->casher_id, $order->quantity, $order->tot_price));
            }
            fclose($file);
        };
    }
}
