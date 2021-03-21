@extends('layouts.frontend.app')

@section('title', 'All Blogs')

@push('css')
    <style>
        .page-item {
            margin-bottom: 0px;
            border: none;
            -webkit-transition: all .2s;
            transition: all .2s;
        }
    </style>
@endpush

@section('content')
    
    <!-- Page Title -->
<section class="page-title-wrap" data-bg-img="{{ url('assets/frontend/img/hills.jpg') }}" data-rjs="2">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="page-title" data-animate="fadeInUp" data-delay="1.2">
                        <h2>Blog</h2>
                        <ul class="list-unstyled m-0 d-flex">
                        <li><a href="{{ route('home')}}"><i class="fa fa-home"></i> Home</a></li>
                            <li><a href="{{ route('home')}}">Blog</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End of Page Title -->
    
    <!-- Blog -->
    <section class="pt-120 pb-65">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="blog">
                        <div class="row isotope">
                            <!-- Single Post -->
                            @foreach($posts as $key => $post)
                                <div class="col-md-6">
                                    <div class="single-news mb-55" data-animate="fadeInUp" data-delay=".1">
                                        <a class="tip" href="#">News</a>
                                        <img src="{{ url('storage/post/'. $post->image) }}" data-rjs="2" alt="">
                                        <ul class="list-unstyled d-flex align-items-center">
                                            <li><img src="{{ url('storage/profile/'. $post->user->image) }}" alt=""></li>
                                            <li>by <a href="{{ route('author.profile', $post->user->username) }}">{{ $post->user->name }}</a></li>
                                            <li><a href="#">{{ $post->created_at->diffForHumans() }}</a></li>
                                        </ul>
                                        <h3 class="h5"><a href="{{ route('post.details', $post->slug) }}">{{ $post->title }}</a></h3>
                                        <a href="{{ route('post.details', $post->slug) }}">Continue Reading <i class="fa fa-angle-right"></i></a>
                                    </div>
                                </div>
                            @endforeach
                            <!-- End of Single Post -->

                        </div>
                        <ul class="pagination blog-pagination align-items-center justify-content-center mb-55" data-animate="fadeInUp" data-delay=".1">
                            {{ $posts->links() }}
                        </ul>
                        {{-- <ul class="pagination blog-pagination align-items-center justify-content-center mb-55" data-animate="fadeInUp" data-delay=".1">
                            <li><a href="#"><img src="img/icons/left-arrow.svg" alt="" class="svg"></a></li>
                            <li class="active"><a href="#">01</a></li>
                            <li><a href="#">02</a></li>
                            <li><a href="#">03</a></li>
                            <li><a href="#">04</a></li>
                            <li><a href="#">05</a></li>
                            <li><a href="#"><img src="img/icons/right-arrow.svg" alt="" class="svg"></a></li>
                        </ul> --}}
                        
                    </div>
                </div>
                
                <!-- Sidebar -->
                <div class="col-lg-4">
                    <aside>
                        <div class="sidebar-widget mb-55" data-animate="fadeInUp" data-delay=".1">
                            <div class="search-widget">
                                <form class="parsley-validate" action="#">
                                    <div class="form-field">
                                        <input class="theme-input-style" type="text" placeholder="Search here..." required>
                                        <button type="submit"><i class="fa fa-search"></i></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="sidebar-widget mb-55" data-animate="fadeInUp" data-delay=".1">
                            <h3 class="bordered-title">Categories</h3>
                            <div class="list-widget">
                                <ul class="list-unstyled m-0 p-0">
                                    <li><a href="#">Design & Art</a> (29)</li>
                                    <li><a href="#">Science & Technology</a> (18)</li>
                                    <li><a href="#">Creative Design & Passon</a> (59)</li>
                                    <li><a href="#">ISP Conference News</a> (38)</li>
                                    <li><a href="#">Sports & Accessories</a> (42)</li>
                                    <li><a href="#">Envato Marketplace</a> (93)</li>
                                    <li><a href="#">WordPress Premium Themes</a> (69)</li>
                                </ul>
                            </div>
                        </div>
                        <div class="sidebar-widget mb-55" data-animate="fadeInUp" data-delay=".1">
                            <h3 class="bordered-title">Recent Post</h3>
                            <div class="recent-posts-widget">
                                <ul class="list-unstyled m-0 p-0">
                                    <li>
                                        <img src="img/posts/thumb1.jpg" alt="">
                                        <div class="rpw-content">
                                            <a class="tip" href="#">News</a>
                                            <h5><a href="#">What Is Net Neutrality? Should Iran Worried Answered faqs</a></h5>
                                            <a href="#">January 19, 2018</a>
                                        </div>
                                    </li>
                                    <li>
                                        <img src="img/posts/thumb2.jpg" alt="">
                                        <div class="rpw-content">
                                            <a class="tip" href="#">News</a>
                                            <h5><a href="#">Google Made a Small Mistake, Causing a Widespread Internet</a></h5>
                                            <a href="#">January 19, 2018</a>
                                        </div>
                                    </li>
                                    <li>
                                        <img src="img/posts/thumb3.jpg" alt="">
                                        <div class="rpw-content">
                                            <a class="tip" href="#">News</a>
                                            <h5><a href="#">Four Things You Should Check Be4 Buying a Broadband Connection</a></h5>
                                            <a href="#">January 19, 2018</a>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="sidebar-widget mb-55" data-animate="fadeInUp" data-delay=".1">
                            <ul class="social-share list-unstyled d-flex flex-wrap m-0 p-0">
                                <li><a href="#" target="_blank"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#" target="_blank"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#" target="_blank"><i class="fa fa-google-plus"></i></a></li>
                                <li><a href="#" target="_blank"><i class="fa fa-linkedin"></i></a></li>
                                <li><a href="#" target="_blank"><i class="fa fa-vimeo"></i></a></li>
                                <li><a href="#" target="_blank"><i class="fa fa-youtube"></i></a></li>
                                <li><a href="#" target="_blank"><i class="fa fa-vk"></i></a></li>
                                <li><a href="#" target="_blank"><i class="fa fa-flickr"></i></a></li>
                                <li><a href="#" target="_blank"><i class="fa fa-dribbble"></i></a></li>
                            </ul>
                        </div>
                        <div class="sidebar-widget mb-55" data-animate="fadeInUp" data-delay=".1">
                            <h3 class="bordered-title">Archives</h3>
                            <div class="list-widget">
                                <ul class="list-unstyled m-0 p-0">
                                    <li><a href="#">June 2018</a> (29)</li>
                                    <li><a href="#">May 2018</a> (18)</li>
                                    <li><a href="#">April 2018</a> (59)</li>
                                    <li><a href="#">March 2018</a> (38)</li>
                                    <li><a href="#">February 2018</a> (42)</li>
                                    <li><a href="#">January 2018</a> (93)</li>
                                    <li><a href="#">December 2017</a> (69)</li>
                                </ul>
                            </div>
                        </div>
                        <div class="sidebar-widget mb-55" data-animate="fadeInUp" data-delay=".1">
                            <div class="add-widget text-center">
                                <img src="img/add.jpg" alt="">
                            </div>
                        </div>
                        <div class="sidebar-widget mb-55" data-animate="fadeInUp" data-delay=".1">
                            <h3 class="bordered-title">Tags</h3>
                            <div class="tags d-flex flex-wrap">
                                <a href="#">envato</a>
                                <a href="#">internet</a>
                                <a href="#">technology</a>
                                <a href="#">themeforest</a>
                                <a href="#">html</a>
                                <a href="#">themelooks</a>
                                <a href="#">service</a>
                                <a href="#">provider</a>
                                <a href="#">company</a>
                            </div>
                        </div>
                    </aside>
                </div>
                <!-- End of Sidebar -->
            </div>
        </div>
    </section>
    <!-- End of Blog -->
    
@endsection

@push('js') 
@endpush