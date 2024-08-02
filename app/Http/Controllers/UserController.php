<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

use App\Models\User;
use App\Models\Product;
use App\Models\Sales;
use Carbon\Carbon;


class UserController extends Controller
{

    public function user_dashboard()
    {
        // Get the total number of sales for today
        $totalSalesCount = Sales::whereDate('created_at', Carbon::today())->count();

        // Get the total sales amount for today
        $totalSalesAmount = Sales::whereDate('created_at', Carbon::today())->sum('total_price'); // Adjust 'amount' to the correct column name for sale amount

        return view('user.index', compact('totalSalesCount', 'totalSalesAmount'));
    }

    public function Userlogout(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }

    // public function index(){
    //     return view('user.index');
    // }

    public function view_sales()
    {
        $products = Product::all();
        return view('user.sales1', compact('products'));
    }

    public function add_sales(Request $request)
    {
            // Fetch the product details using the product_id from the request
        $product = Product::find($request->product_id);

        if (!$product) {
            // Handle the case where the product is not found
            return redirect()->back()->withErrors('Product not found.');
        }
        $sales = new Sales;
        $sales->customer_name = $request->customer_name;
        $sales->product_id = $request->product_id;
        $sales->phone_number = $request->phone_number;
        $sales->selling_price = $request->selling_price;
        $sales->quantity = $request->quantity;
        $sales->total_price = $request->quantity * $request->selling_price;
        $sales->date = $request->date;

        // Fetch the product to calculate profit
        // $product = Product::find($request->product_id);
        // if ($product) {
        //     $sales->profit = ($sales->selling_price - $product->buying_price) * $request->quantity;
        // } else {
        //     $sales->profit = 0;
        // }

        $sales->save();

        // Flash a success message to the session with Toastr options
        $request->session()->flash('toastr', [
            'type' => 'success',
            'message' => 'Sales Added Successfully',
            'options' => [
                'closeButton' => true,
                'progressBar' => true,
                'timeOut' => 5000,
                'extendedTimeOut' => 1000
            ]
        ]);

        return redirect()->back();
    }

    public function list_sales()
    {
        $sales = Sales::all(); // Changed 'sales' to 'Sales'
        $sales = Sales::with('product')->get();
        return view('user.list1_sales', compact('sales'));
    }

    public function delete_sales($id)
    {
        $sales = Sales::find($id);
        $sales->delete();
        return redirect()->back();
    }

    public function edit_sales($id)
    {
        $sales = Sales::find($id);
        $products = Product::all();


        return view('user.edit_sales', compact('sales','products'));
    }

    public function update_sales(Request $request, $id)
    {
        $sales = Sales::find($id);

        $sales->customer_name = $request->customer_name;
        $sales->product_id = $request->product_id;
        $sales->phone_number = $request->phone_number;
        $sales->selling_price = $request->selling_price;
        $sales->quantity = $request->quantity;


        $sales->save();

        // Flash a success message to the session with Toastr options
        $request->session()->flash('toastr', [
            'type' => 'success',
            'message' => 'Sales Updated Successfully', // Updated message to reflect 'Product'
            'options' => [
                'closeButton' => true,
                'progressBar' => true,
                'timeOut' => 5000,
                'extendedTimeOut' => 1000
            ]
        ]);

        return redirect('/list_sales');
    }


}
