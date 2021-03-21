<footer class="main-footer">
        <div class="footer-widgets light-bg border-top pt-80 pb-50">
            <div class="container">
                <div class="row">
                    <!-- Footer Widget -->
                    <div class="col-lg-3 col-sm-6">
                        <div class="footer-widget mb-30" data-animate="fadeInUp" data-delay=".1">
                            <h3 class="h4">Contact Us</h3>
                            <div class="contact-widget-content">
                                <p>Sed ut perspiciatis unde omnis natus vitae dicta sunt explicabo.</p>
                                <ul class="list-unstyled">
                                    <li>
                                        <i class="fa fa-phone"></i>
                                        <a href="tel:+1234567890">(+1) 234-567-890</a>
                                    </li>
                                    <li>
                                        <i class="fa fa-envelope-o"></i>
                                        <a href="mailto:serviney.demo@fakemail.com">serviney.demo@fakemail.com</a>
                                    </li>
                                    <li>
                                        <i class="fa fa-map-marker"></i>
                                        <span>784/A Zirtoli Bazar, Begumgonj, Noakhali-3800, BD</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- End of Footer Widget -->

                    <!-- Footer Widget -->
                    <div class="col-lg-3 col-sm-6">
                        <div class="footer-widget mb-30" data-animate="fadeInUp" data-delay=".3">
                            <h3 class="h4">My Account</h3>
                            <div class="menu-wrap">
                                <ul class="menu">
                                    <li><a href="#">Pay My Bills</a></li>
                                    <li><a href="#">Manage My Account</a></li>
                                    <li><a href="#">Constant Guard</a></li>
                                    <li><a href="#">Cable Customer Agreement</a></li>
                                    <li><a href="#">Move Services</a></li>
                                    <li><a href="#">Manage Users & Alerts</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- End of Footer Widget -->

                    <!-- Footer Widget -->
                    <div class="col-lg-3 col-sm-6">
                        <div class="footer-widget mb-30" data-animate="fadeInUp" data-delay=".5">
                            <h3 class="h4">Support Links</h3>
                            <div class="menu-wrap">
                                <ul class="menu">
                                    <li><a href="#">Comcast Customer Service</a></li>
                                    <li><a href="#">Bill & Payment Methods</a></li>
                                    <li><a href="#">Support Forums</a></li>
                                    <li><a href="#">Privacy Statement</a></li>
                                    <li><a href="#">Comcast Customer Service</a></li>
                                    <li><a href="#">Social Responsibility</a></li>
                                    <li><a href="#">Support Forums</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- End of Footer Widget -->

                    <!-- Footer Widget -->
                    <div class="col-lg-3 col-sm-6">
                        <div class="footer-widget mb-30" data-animate="fadeInUp" data-delay=".7">
                            <h3 class="h4">Category</h3>
                            <div class="menu-wrap">
                                <ul class="menu">
                                    @foreach($categories as $key => $category)
                                        <li><a href="{{ route('category.posts', $category->slug) }}">{{ $category->name }}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- End of Footer Widget -->
                </div>
            </div>
        </div>

        <div class="bottom-footer dark-bg">
            <div class="container">
                <div class="row align-items-center">
                    <!-- Copyright -->
                    <div class="col-md-6">
                        <div class="copyright-text text-center text-md-left">
                            <p class="mb-md-0">&copy; 2018 {{config('app.name')}}. All rights reserved.</p>
                        </div>
                    </div>

                    <!-- Social Profiles -->
                    <div class="col-md-6">
                        <ul class="social-profiles nav justify-content-center justify-content-md-end">
                            <li><a href="#" target="_blank"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#" target="_blank"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#" target="_blank"><i class="fa fa-google-plus"></i></a></li>
                            <li><a href="#" target="_blank"><i class="fa fa-linkedin"></i></a></li>
                            <li><a href="#" target="_blank"><i class="fa fa-vimeo"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>