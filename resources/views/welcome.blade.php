@extends('layouts.frontend.app')

@section('title','Home')

@push('css')
@endpush

@section('content')
    <!-- Banner -->
    <section>
        <div class="main-slider swiper-container">
            <div class="swiper-wrapper">
                @foreach($sliders as $key => $slider)
                    <!-- Single slide -->
                    <div class="swiper-slide position-relative">
                    <img src="{{ url('storage/slider/'. $slider->image)  }}" data-rjs="2" alt="{{ $slider->title }}">
                        <div class="slide-content container">
                            <div class="row align-items-center">
                                <div class="col-xl-8 col-lg-8">
                                    <div class="slide-content-inner">
                                        <h4 data-animate="fadeInUp" data-delay=".05">{{ $slider->sub_title }}</h4>
                                        <h2 data-animate="fadeInUp" data-delay=".3">{{ $slider->title }}</h2>
                                        <a data-animate="fadeInUp" data-delay=".6" href="{{ $slider->link }}" class="btn">Learn More</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End of Single slide -->
                @endforeach
            </div>
            <!-- Banner Pagination -->
            <div class="swiper-pagination main-slider-pagination"></div>
        </div>
    </section>
    <!-- End of Banner -->
    
    <!-- Abut Us -->
    <section class="pt-120 pb-55">
        <div class="container">
            <div class="row align-items-center pb-80">
                <div class="col-lg-6 d-none d-lg-block">
                    <div class="text-center" data-animate="fadeInUp" data-delay=".1">
                        <img src="img/number-one.png" alt="" data-rjs="2">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="number-one-content" data-animate="fadeInUp" data-delay=".5">
                        <h2 class="mb-3">We are no. 1 internet service provider company in United States.</h2>
                        <p>On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame belongs to those who fail in their duty through weakness of will, which is the same as saying through shrinking from toil and pain.</p>
                        <a href="#" class="btn">View Details</a>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-4 col-sm-6">
                    <div class="single-feature single-feature-img-top text-center" data-animate="fadeInUp" data-delay=".1">
                        <div class="single-feature-img">
                            <img src="img/icons/setup.svg" alt="" class="svg">
                        </div>
                        <div class="single-feature-content">
                            <h4>Free Installations & Setup</h4>
                            <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="single-feature single-feature-img-top text-center" data-animate="fadeInUp" data-delay=".4">
                        <div class="single-feature-img">
                            <img src="img/icons/download.svg" alt="" class="svg">
                        </div>
                        <div class="single-feature-content">
                            <h4>Up to 1 Gpbs Download Speed</h4>
                            <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="single-feature single-feature-img-top text-center" data-animate="fadeInUp" data-delay=".7">
                        <div class="single-feature-img">
                            <img src="img/icons/support.svg" alt="" class="svg">
                        </div>
                        <div class="single-feature-content">
                            <h4>24/7 Customer Support</h4>
                            <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End of About Us -->

    <!-- Services -->
    @include('layouts.frontend.partial.service')
    <!-- End of Services -->

    <!-- Packages Wrap -->
    @include('layouts.frontend.partial.package')
    <!-- End of Packages Wrap -->

    <!-- Reviews -->
    @include('layouts.frontend.partial.review')
    <!-- End of Reviews -->

    <!-- FAQ -->
    @include('layouts.frontend.partial.faq')
    <!-- End of FAQ -->

    <!-- Latest Blogs -->
    <section class="light-bg pt-120 pb-120">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-6 col-lg-8 col-md-10">
                    <div class="section-title text-center" data-animate="fadeInUp" data-delay=".1">
                        <h2>Latest Blogs</h2>
                        <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form by injected humour</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="latest-news-wraper position-relative">
                        <div class="swiper-container news-slider">
                            <div class="swiper-wrapper">
                                @foreach($posts as $key => $post)
                                    <div class="single-news swiper-slide">
                                        <a class="tip" href="#">News</a>
                                        <img src="{{ url('storage/post/'. $post->image) }}" data-rjs="2" alt="{{ $post->title }}">
                                        <ul class="list-unstyled d-flex align-items-center">
                                            <li><img src="{{ url('storage/profile/'. $post->user->image) }}" alt=""></li>
                                            <li>by <a href="{{ route('author.profile', $post->user->username) }}">{{ $post->user->name }}</a></li>
                                            <li><a href="#">{{ $post->created_at->diffForHumans() }}</a></li>
                                            {{-- <li>
                                                @guest
                                                    <a href="javascript:void(0)"
                                                        onclick="toastr.info('To add favorite list, You need to login first.','Info',{
                                                            closeButton: true,
                                                            progressBar: true,
                                                        })">
                                                        <i class="fa fa-heart" aria-hidden="true"></i>
                                                        {{ $post->favorite_to_users->count() }}
                                                    </a>
                                                @else
                                                    <a href="javascript:void(0)"
                                                        onclick="document.getElementById('favorite-form-{{ $post->id }}').submit();"
                                                        class="{{ !Auth::user()->favorite_posts
                                                        ->where('pivot.post_id',$post->id)
                                                        ->count() == 0 ? 'favorite_post' : '' }}">
                                                        <i class="fa fa-heart" aria-hidden="true"></i>
                                                        {{ $post->favorite_to_users->count() }}
                                                        <form id="favorite-form-{{ $post->id }}" method="POST" action="{{ route('post.favorite', $post->id) }}" 
                                                            style="display:none">
                                                            @csrf
                                                        </form>
                                                    </a>
                                                @endguest
                                            </li> --}}
                                            {{-- <li><a href="javascript:void(0)"><i class="fa fa-eye" aria-hidden="true"></i> {{ $post->view_count }}</a></li> --}}
                                            {{-- <li><a href="#"><i class="fa fa-comments" aria-hidden="true"></i> 28</a></li> --}}
                                        </ul>
                                        <h3 class="h5"><a href="{{ route('post.details', $post->slug) }}">{{ $post->title }}</a></h3>
                                        <a href="{{ route('post.details', $post->slug) }}">Continue Reading <i class="fa fa-angle-right"></i></a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="swiper-button-next next-news">
                            <img src="img/icons/right-arrow.svg" alt="" class="svg">
                        </div>
                        <div class="swiper-button-prev prev-news">
                            <img src="img/icons/left-arrow.svg" alt="" class="svg">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center pt-120">
                <div class="col-xl-6 col-lg-8 col-md-10">
                    <div class="section-title text-center" data-animate="fadeInUp" data-delay=".1">
                        <h2>All Categories</h2>
                    </div>
                </div>
            </div>
            <div class="next-prev-posts">
                <div class="row align-items-center">
                    @foreach ($categories as $key => $category)
                        <div class="col-md-3">
                            <div class="card" data-animate="fadeInUp" data-delay=".1">
                              <img class="card-img-top" src="{{ url('storage/category/blog_slider/'. $category->image) }}" alt="{{ $category->name }}">
                              <div class="card-body">
                                <h5 class="card-title">{{ $category->name }}</h5>
                                <a href="{{ route('category.posts', $category->slug) }}" class="btn btn-primary">Go</a>
                              </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <!-- End of Latest Blogs -->

    <!-- Subscription -->
    @include('layouts.frontend.partial.subscription')
    <!-- End of Subscription -->

    <!-- Brands -->
    @include('layouts.frontend.partial.brand')
    <!-- End of Brands -->

@endsection

@push('js') 
@endpush