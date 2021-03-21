<section class="pt-120 pb-55">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-6 col-lg-8 col-md-10">
                    <div class="section-title text-center" data-animate="fadeInUp" data-delay=".1">
                        <h2>Choose Affordable Packages</h2>
                        <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour.</p>
                    </div>
                </div>
            </div>
            
            <!-- Packages -->
            <div class="row pb-90">
                @foreach($packages as $key => $package)
                    <div class="col-lg-3 col-sm-6">
                        <div class="single-package text-center" data-animate="fadeInUp" data-delay=".1">
                            <h4> {{ $package->title }}</h4>
                            <span> {{ $package->sub_title }}</span>
                            <hr>
                            <ul class="list-unstyled">
                                @foreach(unserialize($package->list) as $key => $item)
                                    <li>{{ $item }}</li>
                                @endforeach
                            </ul>
                            <p><sup>৳ </sup>{{ $package->price }}<span>/One Time</span></p>
                            <a href="#" class="btn">Order This Plan</a>
                        </div>
                    </div>
                @endforeach
            </div>
            <!-- End of Packages -->

            <!-- Packages Includes -->
            <div class="row justify-content-center">
                <div class="col-xl-6 col-lg-8 col-md-10">
                    <div class="section-title text-center" data-animate="fadeInUp" data-delay=".1">
                        <h2>All Plans Included</h2>
                        <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour.</p>
                    </div>
                </div>
            </div>

            <div class="row">
                @foreach($plans as $key => $plan)
                <div class="col-lg-4 col-sm-6">
                    <div class="single-feature single-feature-img-left text-left" data-animate="fadeInUp" data-delay=".05">
                        <div class="single-feature-img">
                            <img src="{{ url('storage/plan/'. $plan->image)  }}" alt="{{$plan->plan_title}}" class="svg">
                        </div>
                        <div class="single-feature-content">
                            <h4>{{$plan->plan_title}}</h4>
                            <p>{{$plan->plan_body}}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <!-- End of Packages Includes -->
        </div>
    </section>