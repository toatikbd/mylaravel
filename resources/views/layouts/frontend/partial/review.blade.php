<section class="theme-bg-overlay bg-img-xs-none pt-120 pb-120" data-bg-img="{{ url('assets/frontend/img/earth.jpg') }}" data-rjs="2">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-6 col-lg-8 col-md-10">
                    <div class="section-title section-title-white text-center" data-animate="fadeInUp" data-delay=".1">
                        <h2>What Our Client’s Say</h2>
                        <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form by injected humour</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <!-- Review Slider -->
                    <div class="review-slider-wraper position-relative">
                        <div class="swiper-container review-slider">
                            <div class="swiper-wrapper">
                                <!-- Single Review -->
                                @foreach ($reviews as $key => $review)
                                <div class="swiper-slide">
                                    <div class="review-text">
                                        <p>{{$review->review_text}}</p>
                                    </div>
                                    <div class="review-author d-flex align-items-center">
                                        <div class="review-author-img">
                                            <img src="{{ url('storage/review/'. $review->image)  }}" alt="{{ $review->name }}">
                                        </div>
                                        <div class="review-author-info">
                                            <ul class="list-inline">
                                                @for($i=1; $i<=5; $i++)
                                                    @if($i<=$review->review_count)
                                                        <li><i class="fa fa-star"></i></li>
                                                    @else
                                                        <li><i class="fa fa-star-o"></i></li>
                                                    @endif
                                                @endfor
                                            </ul>
                                            <span><strong>{{ $review->name }}</strong>  {{ $review->job_title }}</span>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                <!-- End of Single Review -->
                                
                            </div>
                        </div>
                        
                        <!-- Arrows -->
                        <div class="swiper-button-next next-review">
                            <img src="{{ url('assets/frontend/img/icons/right-arrow.svg') }}" alt="" class="svg">
                        </div>
                        <div class="swiper-button-prev prev-review">
                            <img src="{{ url('assets/frontend/img/icons/left-arrow.svg') }}" alt="" class="svg">
                        </div>
                    </div>
                    <!-- End of Review Slider -->
                </div>
            </div>
        </div>
    </section>