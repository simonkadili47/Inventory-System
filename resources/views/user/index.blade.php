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
  </style>
</head>
<body>
<header class="header">
  <nav class="navbar navbar-expand-lg">
    <div class="container-fluid d-flex align-items-center justify-content-between">
      <div class="navbar-header">
        <!-- Navbar Header--><a href="index.html" class="navbar-brand">Inventory Management System</a>
      </div>
      <!-- Log out -->
      <div class="list-inline-item logout btn btn-danger">
  <form id="logout-form" action="{{ route('user.logout') }}" method="POST" style="display: inline;">
    @csrf
    <button type="submit" class="nav-link btn btn-danger">
      Logout <i class="icon-logout"></i>
    </button>
  </form>
</div>

  </nav>
</header>
<div class="d-flex align-items-stretch">
  <!-- Sidebar Navigation-->
  <nav id="sidebar">
    <!-- Sidebar Header-->
    <!-- Sidebar Navidation Menus-->
    <!-- <span class="heading">IMS Dashboard</span> -->
    <ul class="list-unstyled">
    <li class="active"><a href="{{ url('user_dashboard') }}"> <i class="icon-home"></i>Home </a></li>


      <li>
        <a href="#SalesDropdown" aria-expanded="false" data-toggle="collapse">
        <i class="fa fa-money"></i> Sales
        </a>
        <ul id="SalesDropdown" class="collapse list-unstyled">
        <li><a href="{{url('view_sales')}}">Add Sales</a></li>
        <li><a href="{{url('list_sales')}}">Sales List</a></li>
        </ul>
      </li>




    </ul>

  </nav>
  <!-- Sidebar Navigation end-->
  <div class="page-content">
    <div class="page-header">
      <div class="container-fluid">
        <!-- Dashboard Header -->
      </div>
    </div>
    <section class="no-padding-top no-padding-bottom">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3 col-sm-6">
            <div class="statistic-block block">
              <div class="progress-details d-flex align-items-end justify-content-between">
                <div class="title">
                  <div class="icon"><i class="icon-user-1"></i></div><strong>Total Sales</strong>
                </div>
                <div class="number dashtext-1"> </div>
              </div>
              <div class="progress progress-template">
                <div role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" class="progress-bar progress-bar-template dashbg-1"></div>
              </div>
            </div>
          </div>
          {{-- <div class="col-md-3 col-sm-6">
            <div class="statistic-block block">
              <div class="progress-details d-flex align-items-end justify-content-between">
                <div class="title">
                  <div class="icon"><i class="icon-contract"></i></div><strong>Total Products</strong>
                </div>
                <div class="number dashtext-2">375</div>
              </div>
              <div class="progress progress-template">
                <div role="progressbar" style="width: 70%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" class="progress-bar progress-bar-template dashbg-2"></div>
              </div>
            </div>
          </div>
          <div class="col-md-3 col-sm-6">
            <div class="statistic-block block">
              <div class="progress-details d-flex align-items-end justify-content-between">
                <div class="title">
                  <div class="icon"><i class="icon-paper-and-pencil"></i></div><strong>System Users</strong>
                </div>
                <div class="number dashtext-3">140</div>
              </div>
              <div class="progress progress-template">
                <div role="progressbar" style="width: 55%" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100" class="progress-bar progress-bar-template dashbg-3"></div>
              </div>
            </div>
          </div> --}}
          <!-- <div class="col-md-3 col-sm-6">
            <div class="statistic-block block">
              <div class="progress-details d-flex align-items-end justify-content-between">
                <div class="title">
                  <div class="icon"><i class="icon-writing-whiteboard"></i></div><strong>All Projects</strong>
                </div>
                <div class="number dashtext-4">41</div>
              </div>
              <div class="progress progress-template">
                <div role="progressbar" style="width: 35%" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100" class="progress-bar progress-bar-template dashbg-4"></div>
              </div>
            </div>
          </div> -->
        </div>
      </div>
    </section>
  </div>
</div>
<!-- JavaScript files-->
<script src="{{ asset('/admincss/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('/admincss/vendor/popper.js/umd/popper.min.js') }}"> </script>
<script src="{{ asset('/admincss/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('/admincss/vendor/jquery.cookie/jquery.cookie.js') }}"> </script>
<script src="{{ asset('/admincss/vendor/chart.js/Chart.min.js') }}"></script>
<script src="{{ asset('/admincss/vendor/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('/admincss/js/charts-home.js') }}"></script>
<script src="{{ asset('/admincss/js/front.js') }}"></script>
</body>
</html>
