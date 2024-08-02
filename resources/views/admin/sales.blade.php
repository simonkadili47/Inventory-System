<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Inventory Management</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="robots" content="all,follow">
  <!-- Bootstrap CSS-->
  <link rel="stylesheet" href="{{ asset('/admincss/vendor/bootstrap/css/bootstrap.min.css') }}">
  <!-- Font Awesome CSS-->
  <link rel="stylesheet" href="{{ asset('/admincss/vendor/font-awesome/css/font-awesome.min.css') }}">
  <!-- Custom Font Icons CSS-->
  <link rel="stylesheet" href="{{ asset('/admincss/css/font.css') }}">
  <!-- Google fonts - Muli-->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Muli:300,400,700">
  <!-- Theme stylesheet-->
  <link rel="stylesheet" href="{{ asset('/admincss/css/style.default.css') }}" id="theme-stylesheet">
  <!-- Custom stylesheet - for your changes-->
  <link rel="stylesheet" href="{{ asset('/admincss/css/custom.css') }}">
  <!-- Favicon-->
  <link rel="shortcut icon" href="{{ asset('/admincss/img/favicon.ico') }}">
  <!-- Toastr CSS -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
  <!-- Tweaks for older IEs--><!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
  <style>
    .header .navbar {
      padding: 0.5rem 1rem;
    }
    .logout {
      margin-left: auto;
      padding: 0;
    }
    .logout a {
      padding: 0.5rem 1rem;
      margin-right: 1rem;
    }
    #sidebar {
      height: 100vh;
      overflow-y: auto;
    }
    /* Set a maximum height and enable scrolling for dropdown menus */
    .collapse {
      max-height: 300px; /* Adjust this value as needed */
      overflow-y: auto;
    }
    /* Optional: Add a scrollbar styling for better appearance */
    .collapse::-webkit-scrollbar {
      width: 8px;
    }
    .collapse::-webkit-scrollbar-thumb {
      background-color: #888;
      border-radius: 4px;
    }
    .collapse::-webkit-scrollbar-thumb:hover {
      background-color: #555;
    }
    /* Custom styling for the form */
    .form-container {
      max-width: 800px; /* Adjust the maximum width of the form container */
      margin: auto;
      padding: 20px;
      border: 1px solid #ddd;
      border-radius: 8px;
      background-color: #f9f9f9;
    }
    .form-container .form-group {
      margin-bottom: 1rem;
    }
    .form-control {
      width: 100%; /* Make input fields take full width of their container */
      max-width: 100%; /* Ensure inputs don't exceed the container width */
    }
    .custom-input-width {
      max-width: 600px; /* Adjust this value to set the width you want */
    }
  </style>
</head>
<body>
<header class="header">   
  <nav class="navbar navbar-expand-lg">
    <div class="container-fluid d-flex align-items-center justify-content-between">
      <div class="navbar-header">
        <!-- Navbar Header-->
        <a href="index.html" class="navbar-brand">Inventory Management System</a>
      </div>
      <!-- Log out -->
      <div class="list-inline-item logout btn btn-danger">
  <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: inline;">
    @csrf
    <button type="submit" class="nav-link btn btn-danger">
      Logout <i class="icon-logout"></i>
    </button>
  </form>
</div>
    </div>
  </nav>
</header>
<div class="d-flex align-items-stretch">
  <!-- Sidebar Navigation-->
  <nav id="sidebar">
    <ul class="list-unstyled">
      <li class="active"><a href="{{ url('admin_dashboard') }}"> <i class="icon-home"></i>Home </a></li>
      <li>
        <a href="#ProductDropdown" aria-expanded="false" data-toggle="collapse">
          <i class="icon-windows"></i> Product
        </a>
        <ul id="ProductDropdown" class="collapse list-unstyled">
          <li><a href="{{url('view_category')}}">Add Category</a></li>
          <li><a href="{{url('list_category')}}">List Category</a></li>
          <li><a href="{{url('view_product')}}">Add Product</a></li>
          <li><a href="{{url('list_product')}}">List Product</a></li>
        </ul>
      </li>
      <li>
        <a href="#SalesDropdown" aria-expanded="false" data-toggle="collapse">
          <i class="fa fa-money"></i> Sales
        </a>
        <ul id="SalesDropdown" class="collapse list-unstyled">
        <li><a href="{{url('view_sales')}}">Add Sales</a></li>
          <li><a href="{{url('list_sales')}}">Sales List</a></li>
        </ul>
      </li>
      <!-- <li>
        <a href="#PurchaseDropdown" aria-expanded="false" data-toggle="collapse">
          <i class="fa fa-shopping-cart"></i> Purchase
        </a>
        <ul id="PurchaseDropdown" class="collapse list-unstyled">
          <li><a href="#">Add Purchase</a></li>
          <li><a href="#">List Purchase</a></li>
        </ul>
      </li>
      <li>
        <a href="#PeopleDropdown" aria-expanded="false" data-toggle="collapse">
          <i class="fa fa-users"></i> People
        </a>
        <ul id="PeopleDropdown" class="collapse list-unstyled">
          <li><a href="#">Add Customer</a></li>
          <li><a href="#">List Customer</a></li>
          <li><a href="#">Add Supplier</a></li>
          <li><a href="#">List Supplier</a></li>
        </ul>
      </li> -->

      <li>
      <a href="#SystemusersdropdownDropdown" data-toggle="collapse" aria-expanded="false">
        <i class="fa fa-money"></i> System Users
        </a>
        <ul id="SystemusersdropdownDropdown" class="collapse list-unstyled">
            <li><a href="{{url('view_users')}}">Add Users</a></li>
            <li><a href="{{url('list_users')}}">List Users</a></li>
        </ul>
    <!-- </li>
        <a href="#ReportsdropdownDropdown" data-toggle="collapse" aria-expanded="false">
          <i class="fa fa-newspaper-o"></i> Reports
        </a>
        <ul id="ReportsdropdownDropdown" class="collapse list-unstyled">
        <li><a href="{{url('sales_report')}}">Sales Report</a></li>
        <li><a href="{{url('products_report')}}">Product Report</a></li>
        </ul>
      </li>
    </ul> -->
  </nav>
  <!-- Sidebar Navigation end-->
  <div class="page-content">
    <div class="page-header">
      <div class="container-fluid">
        <div class="form-container">
          <h2 class="text-center">Add New Sales</h2>
          <form action="{{ url('add_sales') }}" method="post">
            @csrf
            <div class="form-group">
              <label for="customerName">Customer Name</label>
              <input type="text" id="customerName" name="customer_name" class="form-control custom-input-width" required>
            </div>
            <div class="form-group">
              <label for="product_id">Product</label>
              <select id="product_id" name="product_id" class="form-control custom-input-width" required>
                <option value="" disabled selected>Select a product</option>
                @foreach($products as $product)
                  <option value="{{ $product->id }}" data-selling-price="{{ $product->selling_price }}">{{ $product->product_name }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="phoneNumber">Phone Number</label>
              <input type="text" id="phoneNumber" name="phone_number" class="form-control custom-input-width" required>
            </div>
            <div class="form-group">
              <label for="sellingPrice">Selling Price</label>
              <input type="number" id="sellingPrice" name="selling_price" class="form-control custom-input-width" required readonly>
            </div>
            <div class="form-group">
              <label for="quantity">Quantity</label>
              <input type="number" id="quantity" name="quantity" class="form-control custom-input-width" required>
            </div>
            <div class="form-group">
              <label for="totalPrice">Total Price</label>
              <input type="number" id="totalSales" name="total_price" class="form-control custom-input-width" readonly>
            </div>
            <div class="form-group">
              <label for="date">Date</label>
              <input type="date" id="date" name="date" class="form-control custom-input-width" required>
            </div>
            <!-- <div class="form-group">
              <label for="profit">Profit</label>
              <input type="number" id="profit" name="profit" class="form-control custom-input-width" readonly>
            </div> -->
            <div class="text-center">
              <input class="btn btn-primary" type="submit" value="Add Sales">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- JavaScript files -->
<script src="{{ asset('/admincss/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('/admincss/vendor/popper.js/umd/popper.min.js') }}"></script>
<script src="{{ asset('/admincss/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('/admincss/vendor/jquery.cookie/jquery.cookie.js') }}"></script>
<script src="{{ asset('/admincss/vendor/chart.js/Chart.min.js') }}"></script>
<script src="{{ asset('/admincss/vendor/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('/admincss/js/charts-home.js') }}"></script>
<script src="{{ asset('/admincss/js/front.js') }}"></script>
<!-- Toastr JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<!-- Custom Script for Calculating Total Sales and Profit -->
<script>
  $(document).ready(function() {
    function calculateTotals() {
      var quantity = parseFloat($('#quantity').val()) || 0;
      var sellingPrice = parseFloat($('#sellingPrice').val()) || 0;

      var totalSales = quantity * sellingPrice;

      $('#totalSales').val(totalSales.toFixed(2));
    }

    $('#quantity, #sellingPrice').on('input', calculateTotals);

    $('#product_id').on('change', function() {
      var selectedProduct = $(this).find('option:selected');
      var sellingPrice = selectedProduct.data('selling-price') || 0;
      $('#sellingPrice').val(sellingPrice);
      calculateTotals();
    });

    @if (session('toastr'))
      var toastrData = @json(session('toastr'));
      toastr.options = {
        "closeButton": toastrData.options.closeButton || false,
        "progressBar": toastrData.options.progressBar || false,
        "timeOut": toastrData.options.timeOut || 5000,
        "extendedTimeOut": toastrData.options.extendedTimeOut || 1000
      };
      toastr[toastrData.type](toastrData.message);
    @endif
  });
</script>
</body>
</html>
