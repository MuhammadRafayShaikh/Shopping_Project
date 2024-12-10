<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>OnlineShop</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />
    <!-- Google font -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700,900|Montserrat:400,500,700,900"
        rel="stylesheet">
    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="{{ asset('css/font-awesome.css') }}">
    <!-- Custom stylesheet -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/owl.theme.default.min.css') }}" />
</head>

<body>
    <!-- HEADER -->
    <div id="header">
        <div class="container">
            <div class="row">
                <div class="col-md-2">
                    <a href="/" class="logo-img"><img src="{{ asset('images/1607398563shopping-logo.png') }}"
                            alt=""></a>
                    <a href="" class="logo"></a>
                </div>
                <div class="col-md-6">

                </div>
                <div class="col-md-4">
                    <ul class="header-info">
                        <li class="dropdown">
                            <a class="dropdown-toggle" href="#" data-toggle="dropdown">
                                @auth
                                    Hello {{ Auth::user()->name }}
                                    <i class="caret"></i>
                                @endauth
                                <i class="fa fa-user"></i>
                            </a>
                            <ul class="dropdown-menu">
                                @if (Auth::check())
                                    {{-- <li><a href="{{ route('singleuserview') }}" class="">My Profile</a></li> --}}
                                    <li><a href="{{ route('profile.show') }}" class="">My Profile</a></li>
                                    <li><a href="{{ route('order') }}" class="">My Orders</a></li>
                                    <!-- Logout Form -->
                                    <li>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button style="margin-left: 15px" type="submit"
                                                class="btn btn-link text-dark">Logout</button>
                                        </form>
                                    </li>
                                @else
                                    <li><a href="{{ route('login') }}">Login</a>
                                    </li>
                                    <li><a href="{{ route('register') }}">Register</a></li>
                                @endif
                            </ul>
                        </li>
                        <li>
                            <a href="{{ route('wishlist.index') }}"><i class="fa fa-heart"></i>
                                <span>{{ $wishcount }}</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('cart.index') }}"><i class="fa fa-shopping-cart"></i>
                                <span>{{ $cartcount }}</span>
                            </a>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
    </div>
    <div id="header-menu">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <ul class="menu-list">
                        @foreach ($subcategory as $subcategories)
                            <li><a
                                    href="{{ route('frontcategory', $subcategories->id) }}">{{ $subcategories->sub_cat_name }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>

    @yield('content')
    <div id ="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-3">

                    <h3>Super Market</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequuntur, perspiciatis quia
                        repudiandae sapiente sed sunt.</p>
                </div>
                <div class="col-md-3">
                    <h3>Categories</h3>
                    <ul class="menu-list">


                        @foreach ($subcategory2 as $subcategories2)
                            <li><a
                                    href="{{ route('frontcategory', $subcategories2->id) }}">{{ $subcategories2->sub_cat_name }}</a>
                            </li>
                        @endforeach

                    </ul>
                </div>
                <div class="col-md-3">
                    <h3>Useful Links</h3>
                    <ul class="menu-list">
                        <li><a href="">Home</a></li>
                        <li><a href="all_products.php">All Products</a></li>
                        <li><a href="latest_products.php">Latest Products</a></li>
                        <li><a href="popular_products.php">Popular Products</a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h3>Contact Us</h3>
                    <ul class="menu-list">

                        <li><i class="fa fa-home"></i><span>: #123, Lorem Ipsum</span></li>


                        <li><i class="fa fa-phone"></i><span>: 03153307757</span></li>


                        <li><i class="fa fa-envelope"></i><span>: rafay6744@gmail.com</span></li>

                    </ul>
                </div>
                <div class="col-md-12">
                    <span> | Created by <a href="https://muhammadrafayshaikh.github.io/Monument"
                            target="_blank">Muhammad Rafay
                            Shaikh</a></span>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js\jquery-1.10.2.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js\bootstrap.min.js') }}"></script>
    <script src="{{ asset('js\actions.js') }}"></script>
    <!--okzoom Plugin-->
    <script src="{{ asset('js/okzoom.min.js') }}" type="text/javascript"></script>
    <!--owl carousel plugin-->
    <script type="text/javascript" src="{{ asset('js/owl.carousel.js') }}"></script>

    <script>
        $(document).ready(function() {

            $('#product-img').okzoom({
                width: 200,
                height: 200,
                scaleWidth: 800
            });

            $('.banner-carousel').owlCarousel({
                loop: true,
                margin: 0,
                responsiveClass: true,
                navText: ["", ""],
                responsive: {
                    0: {
                        items: 1,
                        nav: true

                    },
                    600: {
                        items: 1,
                        nav: true
                    },
                    1000: {
                        items: 1,
                        nav: true,
                        loop: false,
                        margin: 10
                    }
                }
            });

            $('.popular-carousel').owlCarousel({
                loop: true,
                margin: 0,
                responsiveClass: true,
                navText: ["", ""],
                responsive: {
                    0: {
                        items: 1,
                        nav: true

                    },
                    600: {
                        items: 2,
                        nav: true
                    },
                    800: {
                        items: 4,
                        nav: true
                    },
                    1000: {
                        items: 5,
                        nav: true,
                        loop: false,
                        margin: 10
                    }
                }
            });

            $('.latest-carousel').owlCarousel({
                loop: true,
                margin: 0,
                responsiveClass: true,
                navText: ["", ""],
                responsive: {
                    0: {
                        items: 1,
                        nav: true

                    },
                    600: {
                        items: 2,
                        nav: true
                    },
                    800: {
                        items: 3,
                        nav: true
                    },
                    1000: {
                        items: 4,
                        nav: true,
                        loop: false,
                        margin: 5
                    }
                }
            });
        });
    </script>

</body>

</html>
