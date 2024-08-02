<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Sales;
use App\Models\User;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function admin_dashboard()
   
{
   
    // Get the total number of products
    $totalProducts = Product::count();
   

    // Get the total number of sales for today
    $totalSales = Sales::whereDate('created_at', Carbon::today())->count();

    // Get the total number of system users
    $totalUsers = User::count();

    return view('admin.index', compact('totalProducts', 'totalSales', 'totalUsers'));
}

    public function Adminlogout(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }

    public function view_category()
    {
        return view('admin.category');
    }

    // Add category
    public function add_category(Request $request)
    {
        $category = new Category;
        $category->category_name = $request->category_name;
        $category->category_description = $request->category_description;
        $category->save();

        // Flash a success message to the session with Toastr options
        $request->session()->flash('toastr', [
            'type' => 'success',
            'message' => 'Category Added Successfully',
            'options' => [
                'closeButton' => true,
                'progressBar' => true,
                'timeOut' => 5000,
                'extendedTimeOut' => 1000
            ]
        ]);

        return redirect()->back();
    }

    // List category
    public function list_category()
    {
        $data = Category::all();
        return view('admin.list', compact('data'));
    }

    // Delete category
    public function delete_category($id)
    {
        $data = Category::find($id);
        $data->delete();
        return redirect()->back();
    }

    public function edit_category($id)
    {
        $data = Category::find($id);

        return view('admin.edit_category', compact('data'));
    }

    public function update_category(Request $request, $id)
    {
        $data = Category::find($id);
        $data->category_name = $request->category_name;
        $data->category_description = $request->category_description;
        $data->save();

        // Flash a success message to the session with Toastr options
        $request->session()->flash('toastr', [
            'type' => 'success',
            'message' => 'Category Updated Successfully',
            'options' => [
                'closeButton' => true,
                'progressBar' => true,
                'timeOut' => 5000,
                'extendedTimeOut' => 1000
            ]
        ]);

        return redirect('/list_category');
    }

    public function view_product()
    {
        $category = Category::all();
        return view('admin.add_product', compact('category'));
    }

    public function add_product(Request $request)
    {
        $product = new Product;
        $product->product_name = $request->product_name;
        $product->product_description = $request->product_description;
        $product->category_id = $request->category_id;
        $product->quantity = $request->quantity;
        $product->buying_price = $request->buying_price;
        $product->selling_price = $request->selling_price;
        $product->save();

        // Flash a success message to the session with Toastr options
        $request->session()->flash('toastr', [
            'type' => 'success',
            'message' => 'Product Added Successfully',
            'options' => [
                'closeButton' => true,
                'progressBar' => true,
                'timeOut' => 5000,
                'extendedTimeOut' => 1000
            ]
        ]);

        return redirect()->back();
    }

    public function list_product()
    {
        $product = Product::all();
        return view('admin.list_product', compact('product'));
    }

    public function delete_product($id)
    {
        $product = Product::find($id);
        $product->delete();
        return redirect()->back();
    }

    public function edit_product($id)
    {
        $product = Product::find($id);

        return view('admin.edit_product', compact('product'));
    }

    public function update_product(Request $request, $id)
    {
        $product = Product::find($id);

        $product->product_name = $request->product_name;
        $product->product_description = $request->product_description;
        $product->category_id = $request->category_id;
        $product->quantity = $request->quantity;
        $product->buying_price = $request->buying_price;
        $product->selling_price = $request->selling_price;
        $product->save();

        // Flash a success message to the session with Toastr options
        $request->session()->flash('toastr', [
            'type' => 'success',
            'message' => 'Product Updated Successfully',
            'options' => [
                'closeButton' => true,
                'progressBar' => true,
                'timeOut' => 5000,
                'extendedTimeOut' => 1000
            ]
        ]);

        return redirect('/list_product');
    }

    

    public function view_sales()
    {
        $products = Product::all();
        return view('admin.sales', compact('products'));
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
        $sales = Sales::with('product')->get();
        return view('admin.list_sales', compact('sales'));
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

        return view('admin.edit_sales', compact('sales', 'products'));
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
            'message' => 'Sales Updated Successfully',
            'options' => [
                'closeButton' => true,
                'progressBar' => true,
                'timeOut' => 5000,
                'extendedTimeOut' => 1000
            ]
        ]);

        return redirect('/list_sales');
    }

    public function view_users()
    {
        $users = User::all();
        return view('admin.add_users', compact('users'));
    }

    public function list_users()
    {
        $users = User::all();
        return view('admin.list_users', compact('users'));
    }

    public function add_users(Request $request)
    {
        $users = new User;
        $users->name = $request->name;
        $users->email = $request->email;
        $users->usertype = $request->usertype;
        $users->password = Hash::make($request->password);
        $users->remember_token = $request->remember_token;
        $users->save();

        // Flash a success message to the session with Toastr options
        $request->session()->flash('toastr', [
            'type' => 'success',
            'message' => 'User Added Successfully',
            'options' => [
                'closeButton' => true,
                'progressBar' => true,
                'timeOut' => 5000,
                'extendedTimeOut' => 1000
            ]
        ]);

        return redirect()->back();
    }

    public function delete_users($id)
    {
        $users = User::find($id);
        $users->delete();
        return redirect()->back();
    }

    public function edit_users($id)
    {
        $users = User::find($id);

        return view('admin.edit_users', compact('users'));
    }

    public function update_users(Request $request, $id)
    {
        $users = User::find($id);

        $users->name = $request->name;
        $users->email = $request->email;
        $users->usertype = $request->usertype;
        $users->password = Hash::make($request->password);
        $users->remember_token = $request->remember_token;
        $users->save();

        // Flash a success message to the session with Toastr options
        $request->session()->flash('toastr', [
            'type' => 'success',
            'message' => 'User Updated Successfully',
            'options' => [
                'closeButton' => true,
                'progressBar' => true,
                'timeOut' => 5000,
                'extendedTimeOut' => 1000
            ]
        ]);

        return redirect('/list_users');
    }
}
