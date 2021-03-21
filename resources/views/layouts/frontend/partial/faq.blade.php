<section class="pt-120 pb-70">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="faq pb-50" data-animate="fadeInUp" data-delay=".1">
                        <div class="section-title">
                            <h2>Frequently Asked Questions</h2>
                            <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some</p>
                        </div>
                        <div class="accordion" id="accordionFaq">
                            @foreach($faqs as $key => $faq)
                                <div class="single-faq">
                                    <div class="faq-title d-flex align-items-center">
                                        <h3 class="h5" data-toggle="collapse" data-target="#{{$faq->slug}}" aria-expanded="{{ $loop->first ? 'true' : 'false' }}" aria-controls="{{$faq->slug}}">{{$faq->faq_title}}</h3>
                                    </div>
                                    <div id="{{$faq->slug}}" class="collapse {{ $loop->first ? 'show' : '' }}" data-parent="#accordionFaq">
                                        <div class="faq-answer">
                                        <p><span>Ans: </span>{{$faq->faq_body}}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="popup-video mb-50" data-animate="fadeInUp" data-delay=".4">
                    <img src="{{ url('assets/frontend/img/video-thumb.jpg') }}" data-rjs="2" alt="">
                        <a href="https://www.youtube.com/watch?v=6ZfuNTqbHE8" class="youtube-popup play-btn ripple">
                            <i class="fa fa-play"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>