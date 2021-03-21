@extends('layouts.frontend.app')

@section('title')
{{$post->title}}
@endsection

@push('css')
@endpush

@section('content')
    
    <!-- Page Title -->
    <section class="page-title-wrap" data-bg-img="{{ url('storage/post/'. $post->image) }}" data-rjs="2">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="page-title" data-animate="fadeInUp" data-delay="1.2">
                        <h2>Blog Details</h2>
                        <ul class="list-unstyled m-0 d-flex">
                            <li><a href="{{ route('home') }}"><i class="fa fa-home"></i> Home</a></li>
                            <li><a href="{{ route('post.index')}}">Blog</a></li>
                            <li><a href="#">{{ $post->title }}</a></li>
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
                    <div class="blog-details mb-55">
                        <!-- Post Info -->
                        <div class="single-news">
                            <img src="{{ url('storage/post/'. $post->image) }}" data-rjs="2" alt="" data-animate="fadeInUp" data-delay=".1">
                            <ul class="list-unstyled d-flex align-items-center" data-animate="fadeInUp" data-delay=".2">
                            <li><img src="{{ url('storage/profile/'. $post->user->image) }}" alt=""></li>
                                <li>by- <a href="{{ route('author.profile', $post->user->username) }}">{{ $post->user->name }}</a></li>
                                <li><a href="#">{{ $post->created_at->diffForHumans() }}</a></li>
                                {{-- <li><a href="#" class="tip">News</a></li> --}}
                            </ul>
                        </div>
                        
                        <!-- Post Contents -->
                        <div class="post-content mb-55 clearfix" data-animate="fadeInUp" data-delay=".1">
                            <h1 class="h2">{{ $post->title }}</h1>
                            <div class="para">{!! html_entity_decode($post->body) !!}</div>
                        </div> 
                        
                        <div class="tags-and-share light-bg mb-55 d-md-flex align-items-md-center justify-content-md-between" data-animate="fadeInUp" data-delay=".1">
                            <div class="tags d-flex flex-wrap align-items-center">
                                <i class="fa fa-tags"></i>
                                @foreach($post->tags as $key => $tag)
                                    <a href="{{ route('tag.posts', $tag->slug) }}">{{ $tag->name }}</a>
                                @endforeach
                            </div>
                            <div class="post_3info d-flex flex-wrap align-items-center">
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
                                <a href="javascript:void(0)"><i class="fa fa-eye" aria-hidden="true"></i> {{ $post->view_count }}</a>
                                <a href="#comments"><i class="fa fa-comments" aria-hidden="true"></i> {{ $post->comments->count() }}</a>
                            </div>
                            <div class="post-share text-md-right">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-google-plus"></i></a>
                                <a href="#"><i class="fa fa-linkedin"></i></a>
                                <a href="#"><i class="fa fa-vimeo"></i></a>
                                <a href="#"><i class="fa fa-share-alt"></i></a>
                            </div>
                        </div>
                        
                        <!-- Post Author -->
                        <div class="post-author mb-55 d-flex align-items-center" data-animate="fadeInUp" data-delay=".1">
                            <div class="post-author-img">
                            <img src="{{ url('storage/profile/'. $post->user->image) }}" alt="{{ $post->user->name }}">
                            </div>
                            <div class="post-author-details">
                                <h5>About The Author</h5>
                            <p>{{ $post->user->about  }}</p>
                            <a href="{{ route('author.profile', $post->user->username) }}">- {{ $post->user->name }}</a>
                            </div>
                        </div>
                        
                        <hr class="mb-55">
                        
                        <!-- Post Navigation -->
                        <div class="next-prev-posts mb-55">
                            <div class="row align-items-center">
                                @foreach($randomposts as $key => $randompost)
                                    <div class="col-md-6">
                                        <div class="next-prev-post d-flex align-items-center" data-animate="fadeInUp" data-delay=".1">
                                            <div class="next-prev-post-img position-relative" style="width: auto; height: 100px;">
                                                <span>Pro.</span>
                                                <img src="{{ url('storage/post/'. $randompost->image) }}" alt="{{ $randompost->title }}">
                                            </div>
                                            <div class="rpw-content">
                                                <a class="tip" href="#">Top info.</a>
                                                <h5><a href="{{ route('post.details', $randompost->slug) }}">{{ $randompost->title }}</a></h5>
                                                <a href="{{ route('author.profile', $post->user->username) }}">by- {{ $randompost->user->name }}</a>
                                                <a href="#">{{ $randompost->created_at->diffForHumans() }}</a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Post Comments -->
                        <div class="sn-comments mb-55" data-animate="fadeInUp" data-delay=".1">
                            <h3 id="comments" class="bordered-title">{{ $post->comments()->count() }} Comments</h3>
                            <ul class="comment-list parent-comment list-unstyled p-0 m-0">
                                @if($post->comments->count() > 0)
                                    @foreach($post->comments as $key => $comment)
                                        <li>
                                            <div class="single-comment">
                                                <div class="comment-author">
                                                    <img src="{{ url('storage/profile/'. $comment->user->image) }}" alt="">
                                                </div>
                                                <div class="comment-content">
                                                    <h6>
                                                        <a href="{{ route('author.profile', $post->user->username) }}">{{$comment->user->name}} </a>
                                                        <span>{{ $comment->created_at->diffForHumans() }}</span>
                                                    </h6>
                                                    <p>{{ $comment->comment }}</p>
                                                    {{-- <a class="comment-reply" href="#">Reply</a> --}}
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                @else
                                    <li>
                                        <div class="single-comment">
                                            <div class="comment-content">
                                                <p>No Comment Yet. Be the first :)</p>
                                            </div>
                                        </div>
                                    </li>
                                @endif
                                
                            </ul>
                        </div>

                        <hr class="mb-55">

                        <!-- Post Comment Form -->
                        <div class="comment-form mb-55" data-animate="fadeInUp" data-delay=".1">
                            <h3 class="bordered-title">Leave a comment</h3>

                            @guest
                                <p>For post a new comment, You need to login first.
                                <a href="{{ route('login') }}">Login</a>
                                </p>
                            @else
                            <form class="parsley-validate" method="POST" action="{{ route('comment.store', $post->id) }}">
                                @csrf
                                    <div class="form-field">
                                        <textarea name="comment" class="theme-input-style" placeholder="Write your text" required></textarea>
                                    </div>
                                    <button type="submit" class="btn">Post Comment</button>
                                </form>
                            @endguest

                        </div>
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
                                    @foreach($post->categories as $key => $category)
                                <li><a href="{{ route('category.posts', $category->slug) }}">{{ $category->name }}</a> 22</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="sidebar-widget mb-55" data-animate="fadeInUp" data-delay=".1">
                            <h3 class="bordered-title">Recent Post</h3>
                            <div class="recent-posts-widget">
                                <ul class="list-unstyled m-0 p-0">
                                    @foreach($randomposts as $key => $randompost)
                                        <li>
                                            <div class="randomposts">
                                                <img src="{{ url('storage/post/'. $randompost->image) }}" alt="{{ $randompost->title }}">
                                            </div>
                                            <div class="rpw-content" style="margin-left: 10px">
                                                <a class="tip" href="#">News</a>
                                                <h5><a href="{{ route('post.details', $randompost->slug) }}">{{ $randompost->title }}</a></h5>
                                                <a href="#">{{ $randompost->created_at->diffForHumans() }}</a>
                                            </div>
                                        </li>
                                    @endforeach
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
                                @foreach($post->tags as $key => $tag)
                                    <a href="#">{{ $tag->name }}</a>
                                @endforeach
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