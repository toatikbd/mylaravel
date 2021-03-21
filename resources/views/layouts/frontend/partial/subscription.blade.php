<section class="pb-120 pt-120">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-5">
                <div class="section-title pb-0" data-animate="fadeInUp" data-delay=".1">
                    <h2>Sign Up to Newsletter</h2>
                    <p class="mb-0">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some</p>
                </div>
            </div>
            <div class="col-lg-6 col-md-7">
                <!-- Subscription form -->
                <div class="subscription-form" data-animate="fadeInUp" data-delay=".4">
                    <form class="parsley-validate" action="{{ route('subscriber.store') }}" method="POST">
                        @csrf
                        <input type="email" name="email" class="theme-input-style" placeholder="Enter your e-mail address" required>
                        <button class="btn" type="submit">Subscribe Now</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>