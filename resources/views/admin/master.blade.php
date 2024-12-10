<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>ADMIN</title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('../css/bootstrap.min.css') }}" />
    <!-- Google font -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700,900|Montserrat:400,500,700,900"
        rel="stylesheet">
    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="{{ asset('css/font-awesome.css') }}">
    <!-- Jquery textEditor -->
    <link rel="stylesheet" href="{{ asset('css/jquery-te-1.4.0.css') }}">
    <!-- Custom stlylesheet -->
    <link rel="stylesheet" href="{{ asset('../css/style.css') }}">
</head>

<body>
    <!-- HEADER -->
    <div id="admin-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-2">

                    <a href="dashboard.php" class="logo-img"><img
                            src="{{ asset('../images/1607398563shopping-logo.png') }}" alt=""></a>

                    <a href="dashboard.php" class="logo"></a>

                </div>
                <div class="col-md-offset-8 col-md-2">
                    <div class="dropdown">
                        <a href="" class="dropdown-toggle logout" data-toggle="dropdown">

                            @if (Auth::check())
                                Hi {{ Auth::user()->name }}

                                <span class="caret"></span>
                            @endif
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ route('profile.show') }}">Change Password</a></li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button style="margin-left: 7px" type="submit"
                                    class="btn btn-link text-dark">Logout</button>
                            </form>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /HEADER -->
    <div id="admin-wrapper">
        <div class="container-fluid">
            <div class="row">
                <!-- Menu Bar Start -->
                <div class="col-md-2 col-sm-3" id="admin-menu">
                    <ul class="menu-list">
                        <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li><a href="{{ route('product.index') }}">Products</a></li>
                        <li><a href="{{ route('category.index') }}">Categories</a></li>
                        <li><a href="{{ route('subcategory.index') }}">Sub-Categories</a></li>
                        <li><a href="{{ route('brand.index') }}">Brands</a></li>
                        <li><a href="{{ route('backorder.index') }}">Orders</a></li>
                        <li><a href="{{ route('user.index') }}">Users</a></li>
                        <li><a href="{{ route('adminreviews') }}">Reviews</a></li>
                    </ul>
                </div>
                <!-- Menu Bar End -->
                <!-- Content Start -->
                <div class="col-md-10 col-sm-9 clearfix" id="admin-content">


                    @yield('content')

                    <!-- Footer Start-->
                    <div id="admin-footer">

                        <span></span>
                        <span>Created By Muhammad Rafay Shaikh</span>

                    </div>
                    <!-- Footer End-->
                </div>
                <!-- Content End-->
            </div>
        </div>
    </div>
    <script src="{{ asset('js/jquery.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/admin_actions.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/jquery-te-1.4.0.min.js') }}" type="text/javascript"></script>
    <!-- https://jqueryte.com/ -->
    <script>
        $('.product_description').jqte({
            link: false,
            unlink: false,
            color: false,
            source: false,
        });
    </script>
</body>

</html>
