<header class="header">
    <div class="header-top" data-animate="fadeInDown" data-delay=".5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-7">
                    <div class="header-info text-center text-md-left">
                        <span>Get up to 1 Gbps Download Speed on $98.50/m <a href="#">Get It Now</a></span>
                    </div>
                </div>
                <div class="col-lg-6 col-md-5">
                    <div class="header-top-right d-flex align-items-center justify-content-center justify-content-md-end">
                        <form method="GET" action="{{ route('search') }}" class="parsley-validate d-flex position-relative">
                            <input type="text" name="query" value="{{ isset($query) ? $query : '' }}" placeholder="I am looking for" required>
                            <button type="submit"><i class="fa fa-search"></i></button>
                        </form>
                        <div class="client-area position-relative">
                            @guest
                                <a href="{{ route('login') }}">Login</a>
                            @else
                                @if(Auth::user()->role->id == 1)
                                    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                                @endif
                                @if(Auth::user()->role->id == 2)
                                    <a href="{{ route('author.dashboard') }}">Dashboard</a>
                                @endif
                            @endguest
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="main-header" data-animate="fadeInUp" data-delay=".9">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-2 col-lg-2 col-md-3 col-sm-4 col-9">
                    <!-- Logo -->
                    <div class="logo">
                        <a href="{{ route('home')}} ">
                            <img src="{{ asset('assets/frontend/img/logo.png') }}" data-rjs="2" alt="VPNet">
                        </a>
                    </div>
                </div>
                <div class="col-xl-8 col-lg-8 col-md-5 col-sm-2 col-3">
                    <nav>
                        <!-- Header-menu -->
                        <div class="header-menu">
                            <ul>
                                <li class="{{ Request::is('home') ? 'active' : '' }}">
                                    <a href="{{ route('home') }}">Home</a>
                                </li>
                                <li>
                                    <a href="#">Pages <i class="fa fa-caret-down"></i></a>
                                    <ul>
                                        <li><a href="about.html">About</a></li>
                                        <li><a href="packages.html">Packages</a></li>
                                        <li><a href="reviews.html">Reviews</a></li>
                                        <li><a href="faq.html">FAQ</a></li>
                                        <li><a href="404.html">404</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#">Services <i class="fa fa-caret-down"></i></a>
                                    <ul>
                                        <li><a href="services.html">All services</a></li>
                                        <li><a href="cable-tv.html">Cable TV</a></li>
                                        <li><a href="dedicated-server.html">Dedicated server</a></li>
                                        <li><a href="internet.html">Internet provider</a></li>
                                        <li><a href="mobile.html">Mobile packages</a></li>
                                    </ul>
                                </li>
                                <li class="{{ Request::is('post*') ? 'active' : '' }}">
                                    <a href="{{ route('post.index') }}">Blog </a>
                                </li>
                                <li><a href="contact.html">Contact</a></li>
                                <li class="{{ Request::is('team') ? 'active' : '' }}">
                                    <a href="{{ route('team') }}">Our Teams</a>
                                </li>
                            </ul>
                        </div>
                        <!-- End of Header-menu -->
                    </nav>
                </div>
                <div class="col-xl-2 col-lg-2 col-md-4 col-sm-6 d-none d-sm-block">
                    <!-- Header Call -->
                    <div class="header-call text-right">
                        <span>Call Now</span>
                        <a href="tel:+1234567890">(+1) 234-567-8900</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>