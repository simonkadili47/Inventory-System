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
    body {
      background-color: white; /* Set the whole page background to white */
    }
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
    /* Custom styling for the table */
    .table-container {
      margin-top: 20px;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    .table {
      width: 100%; /* Adjust the overall table width to 100% */
      margin-bottom: 1rem;
      color: #212529;
      table-layout: auto; /* Allow columns to expand based on content */
    }
    .table th,
    .table td {
      padding: 0.75rem;
      vertical-align: top;
      border-top: 1px solid #dee2e6;
      background-color: white; /* Ensure no background color */
    }
    .table thead th {
      vertical-align: bottom;
      border-bottom: 2px solid #dee2e6;
      background-color: #003366; /* Dark blue background for th */
      color: white; /* White text for th */
    }
    
    .table tbody td {
      color: black; /* Black text color for table data */
    }
    .table tbody + tbody {
      border-top: 2px solid #dee2e6;
    }
    .table .thead-dark th {
      color: #fff;
      background-color: #003366;
    }
    .table-striped tbody tr:nth-of-type(odd) {
      background-color: transparent; /* Light gray background for striped rows */
    }
    .table-striped tbody tr:nth-of-type(even) {
      background-color: transparent; /* Ensure even rows have no background color */
    }
    .table tbody tr:hover {
      background-color: transparent; /* Remove hover background color */
    }
    .table-title-container {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 20px;
    }
    /* Custom button styling for table cells */
    .table-btn {
      display: inline-block;
      padding: 0.5rem 1rem;
      font-size: 1rem;
      font-weight: bold;
      color: white; /* Text color */
      background-color: #dc3545; /* Red background */
      border: none;
      border-radius: 4px;
      text-align: center;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .table-btn:hover {
      background-color: #c82333; /* Darker red for hover effect */
    }

    .table-btn:focus {
      outline: none;
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
        <li><a href="{{url('products_report')}}">Product Report</a></li>>
        </ul>
      </li> -->
    </ul>
  </nav>
  <!-- Sidebar Navigation end-->
  <div class="page-content">
    <div class="page-header">
      <div class="container-fluid">
        <!-- Title and Add Category Button -->
        <div class="table-title-container">
          <h3>Product List</h3>
          <a href="{{url('view_product')}}" class="btn btn-primary">Add Product</a>
        </div>
      </div>
    </div>
    <div class="container-fluid">
      <div class="table-container">
        <div class="table-responsive">
          <table class="table table-striped">
            <thead class="thead-dark">
              <tr>
                <th>Product Name</th>
                <th>Product Description</th>
                <th>Product Category</th>
                <th>Quantity</th>
                <th>Buying Price</th>
                <th>Selling Price</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach($product as $products)
              <tr>
                <td>{{$products->product_name}}</td>
                <td>{{$products->product_description}}</td>
               <td> {{ $products->category->category_name}}</td>
                <!-- <td>{{$products->category_id}}</td> -->
                <td>{{$products->quantity}}</td>
                <td>{{$products->buying_price}}</td>
                <td>{{$products->selling_price}}</td>
                <td>
                  <a href="{{url('delete_product',$products->id)}}" class="btn btn-danger" onClick="Confirmation(event)">Delete</a>
                  <a href="{{ url('edit_product', $products->id) }}" class="btn btn-success">Edit</a>
                </td>
              </tr>
              @endforeach
              <!-- More rows can be added here -->
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- JavaScript files -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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

<script>
  @if(Session::has('message'))
    var type="{{ Session::get('alert-type','info') }}"
    switch(type){
      case 'info':
        toastr.info("{{ Session::get('message') }}");
        break;
      case 'success':
        toastr.success("{{ Session::get('message') }}");
        break;
      case 'warning':
        toastr.warning("{{ Session::get('message') }}");
        break;
      case 'error':
        toastr.error("{{ Session::get('message') }}");
        break;
    }
  @endif

  function Confirmation(ev){
    ev.preventDefault();
    var urlToRedirect = ev.currentTarget.getAttribute('href');
    console.log(urlToRedirect);
    swal({
      title: "Are you sure you want to delete this?",
      text: "This delete will be permanent",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        window.location.href = urlToRedirect;
      }
    });
  }
</script>
<script>
  $(document).ready(function() {
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
