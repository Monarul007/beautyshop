<?php 
use App\Http\Controllers\Controller;
$navCats = Controller::navCats();
$userCart = Controller::cartData();
$navBrands = Controller::navBrands();
$settings = Controller::generalSettings();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Beauty Shop Template">
    <meta name="keywords" content="Beauty Shop, Buy Online, Cosmetics, Healthcare">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Beauty Shop | Aristocracy in Beauty</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('css/elegant-icons.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('css/nice-select.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('css/jquery-ui.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('css/owl.carousel.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('css/slicknav.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('css/style.css')}}" type="text/css">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    <script src="{{asset('js/jquery-3.3.1.min.js')}}"></script>
    <!-- SweetAlert2 -->
    <script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
</head>

<body>

    <!-- Humberger Begin -->
    <div class="humberger__menu__overlay"></div>
    <div class="humberger__menu__wrapper">
        <div class="humberger__menu__logo">
            <a href="#">Beauty Shop</a>
        </div>
        <div class="humberger__menu__cart">
            <?php 
                $total_amount = 0;
                $total_qty = 0;
				foreach($userCart as $item){
                    $total_amount = $total_amount + ($item->price * $item->quantity);
                    $total_qty = $total_qty + $item->quantity;
				}
			?>
            <ul>
                <li><a href="{{ route('cart') }}"><i class="fa fa-shopping-bag"></i> <span><?= $total_qty ?></span></a></li>
            </ul>
            
            @if(!empty(Session::get('CouponAmount')))
            <div class="header__cart__price">item: <span>£ <?= $total_amount - Session::get('CouponAmount') ?></span></div>
            @else
            <div class="header__cart__price">item: <span>£ <?= $total_amount ?></span></div>
            @endif
        </div>
        <div class="humberger__menu__widget">
            <div class="header__top__right__language">
                @if (Route::has('login'))
                    @auth
                        <div>My Account</div>
                        <span class="arrow_carrot-down"></span>
                        <ul>
                            <li><a href="#">My Orders</a></li>
                            <li><a href="#">Account Settings</a></li>
                            <li><a href="#">Pending Orders</a></li>
                            <li><a href="{{ route('user_logout') }}">Login/Logout</a></li>
                        </ul>
                    @else
                        <div>Welcome! Guest</div>
                    @endauth
                @endif
            </div>
            <div class="header__top__right__auth">
                @auth
                    <a href="{{ url('/myaccount') }}"><i class="fa fa-home"></i> My Account</a>
                        @else
                            <a href="{{ route('LoginRegister') }}" style="margin-right:10px;"><i class="fa fa-user"></i> Login</a>
                            @if (Route::has('register'))
                                <a href="{{ route('LoginRegister') }}"><i class="fa fa-user"></i>Register</a>
                        @endif
                @endauth
            </div>
        </div>
        <nav class="humberger__menu__nav mobile-menu">
            <ul>
                <li class="active"><a href="/">Home</a></li>
                <li><a href="{{ route('shop') }}">Shop</a></li>
                <li><a href="#">Brands</a>
                    <ul class="header__menu__dropdown">
                        @foreach($navBrands as $brands)
                            <li><a href="http://localhost:8000/brands/{{$brands->url}}">{{$brands->name}} </a></li>
                        @endforeach
                    </ul>
                </li>
                @foreach($navCats as $cat)
                <li><a href="http://localhost:8000/category/{{$cat->url}}">{{$cat->name}}</a>
                    <ul class="header__menu__dropdown">
                        @foreach($cat->categories as $subcat)
                            <li><a href="http://localhost:8000/category/{{$subcat->url}}">{{$subcat->name}} </a></li>
                        @endforeach
                    </ul>
                </li>
                @endforeach
                <li><a href="./blog.html">Blog</a></li>
                <li><a href="./contact.html">Contact</a></li>
            </ul>
        </nav>
        <div id="mobile-menu-wrap"></div>
        <div class="header__top__right__social">
            <a href="#"><i class="fa fa-facebook"></i></a>
            <a href="#"><i class="fa fa-twitter"></i></a>
            <a href="#"><i class="fa fa-linkedin"></i></a>
            <a href="#"><i class="fa fa-pinterest-p"></i></a>
        </div>
        <div class="humberger__menu__contact">
            <ul>
                <li><i class="fa fa-envelope"></i> hello@beautyshop.com</li>
                <li>Free Shipping for all Order of £99</li>
            </ul>
        </div>
    </div>
    <!-- Humberger End -->

    <!-- Header Section Begin -->
    <header class="header">
        <div class="header__top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__left">
                            <ul>
                                <li><i class="fa fa-envelope"></i> hello@beautyshop.com</li>
                                <li>Free Shipping for all Order of £999</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__right">
                            <div class="header__top__right__social">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-linkedin"></i></a>
                                <a href="#"><i class="fa fa-pinterest-p"></i></a>
                            </div>
                            <div class="header__top__right__language">
                                @if (Route::has('login'))
                                    <div class="top-right links">
                                        @auth
                                        <div>My Account</div>
                                        <span class="arrow_carrot-down"></span>
                                        <ul>
                                            <li><a href="#">My Orders</a></li>
                                            <li><a href="#">Account Settings</a></li>
                                            <li><a href="#">Pending Orders</a></li>
                                            <li><a href="{{ route('user_logout') }}">Login/Logout</a></li>
                                        </ul>
                                        @else
                                        <div>Welcome! Guest</div>
                                        @endauth
                                    </div>
                                @endif
                            </div>
                            <div class="header__top__right__auth">
                                @if (Route::has('login'))
                                    <div class="top-right links">
                                        @auth
                                            <a href="{{ url('/myaccount') }}"><i class="fa fa-home"></i> My Account</a>
                                        @else
                                            <a href="{{ route('LoginRegister') }}" style="margin-right:10px;"><i class="fa fa-user"></i> Login</a>

                                            @if (Route::has('register'))
                                                <a href="{{ route('LoginRegister') }}"><i class="fa fa-user"></i>Register</a>
                                            @endif
                                        @endauth
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="header__logo">
                        <a href="{{ route('home') }}"><img src="public/images/theme/{{$settings->logo_small}}" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="hero__search">
                        <div class="hero__search__form">
                            <form action="{{ route('search') }}" method="post">
                            @csrf
                                <div style="">
                                    <input type="text" name="search" placeholder="What do yo u need?">
                                    <button type="submit" class="site-btn">SEARCH</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="header__cart">
                    <?php 
                $total_amount = 0;
                $total_qty = 0;
				foreach($userCart as $item){
                    $total_amount = $total_amount + ($item->price * $item->quantity);
                    $total_qty = $total_qty + $item->quantity;
				}
			?>
            <ul>
                <li><a href="{{ route('cart') }}"><i class="fa fa-shopping-bag"></i> <span><?= $total_qty ?></span></a></li>
            </ul>
            
            @if(!empty(Session::get('CouponAmount')))
            <div class="header__cart__price">item: <span>£ <?= $total_amount - Session::get('CouponAmount') ?></span></div>
            @else
            <div class="header__cart__price">item: <span>£ <?= $total_amount ?></span></div>
            @endif
                    </div>
                </div>
            </div>
            <div class="humberger__open">
                <i class="fa fa-bars"></i>
            </div>
        </div>
    </header>
                    <nav class="header__menu">
                        <div class="container">
                            <ul>
                                <li class="active"><a href="/">Home</a></li>
                                <li><a href="{{ route('shop') }}">Shop</a></li>
                                <li><a href="#">Brands</a>
                                    <ul class="header__menu__dropdown">
                                        @foreach($navBrands as $brands)
                                            <li><a href="http://localhost:8000/brands/{{$brands->url}}">{{$brands->name}} </a></li>
                                        @endforeach
                                    </ul>
                                </li>
                                @foreach($navCats as $cat)
                                <li><a href="http://localhost:8000/category/{{$cat->url}}">{{$cat->name}}</a>
                                    <ul class="header__menu__dropdown">
                                    @foreach($cat->categories as $subcat)
                                        <li><a href="http://localhost:8000/category/{{$subcat->url}}">{{$subcat->name}} </a></li>
                                    @endforeach
                                    </ul>
                                </li>
                                @endforeach
                                <li><a href="">Contact</a></li>
                            </ul>
                        </div>
                    </nav>
                
    <!-- Header Section End -->

    <!-- Hero Section Begin -->
    <section class="hero">
            <div class="row">
                <div class="container">
                    @yield('content')
    <!-- Footer Section Begin -->
    <footer class="footer spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="footer__about">
                        <div class="footer__about__logo">
                            <a href="./index.html"><h3>BeautyShop</h3></a>
                        </div>
                        <ul>
                            <li>Address: Kamal Ataturke Avenue, Banani, Dhaka-1212</li>
                            <li>Phone: +8801700 000 000</li>
                            <li>Email: hello@beautyshop.com</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 offset-lg-1">
                    <div class="footer__widget">
                        <h6>Useful Links</h6>
                        <ul>
                            <li><a href="#">About Our Shop</a></li>
                            <li><a href="#">Secure Shopping</a></li>
                            <li><a href="#">Delivery infomation</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                        </ul>
                        <ul>
                            <li><a href="#">Our Services</a></li>
                            <li><a href="#">Contact</a></li>
                            <li><a href="#">Innovation</a></li>
                            <li><a href="#">Testimonials</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="footer__widget">
                        <h6>Join Our Newsletter Now</h6>
                        <p>Get E-mail updates about our latest shop and special offers.</p>
                        <form action="#">
                            <input type="text" placeholder="Enter your mail">
                            <button type="submit" class="site-btn">Subscribe</button>
                        </form>
                        <div class="footer__widget__social">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-instagram"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-pinterest"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="footer__copyright">
                        <div class="footer__copyright__text"><p>
                            Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | Design & Developed by <a href="https://mousetechnology.com" target="_blank">Mouse Technology</a></p></div>
                        <div class="footer__copyright__payment"><img src="images/payment-item.png" alt=""></div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Section End -->
    <!-- Js Plugins -->
    <script src="{{asset('js/popper.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/jquery.nice-select.min.js')}}"></script>
    <script src="{{asset('js/jquery-ui.min.js')}}"></script>
    <script src="{{asset('js/jquery.slicknav.js')}}"></script>
    <script src="{{asset('js/jquery.zoom.min.js')}}"></script>
    <script src="{{asset('js/mixitup.min.js')}}"></script>
    <script src="{{asset('js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('js/main.js')}}"></script>
    <script>
        $(document).ready(function(){
          $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
</body>

</html>