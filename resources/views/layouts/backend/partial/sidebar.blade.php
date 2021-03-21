<aside id="leftsidebar" class="sidebar">
    <!-- User Info -->
    <div class="user-info">
        <div class="image">
            <img src="{{ url('storage/profile/'.Auth::user()->image) }}" width="48" height="48" alt="User" />
        </div>
        <div class="info-container">
            <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->name }}</div>
            <div class="email">{{ Auth::user()->email }}</div>
            <div class="btn-group user-helper-dropdown">
                <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                <ul class="dropdown-menu pull-right">
                    <li>
                        <a href="{{ Auth::user()->role->id == 1 ? route('admin.settings') : route('author.settings') }}">
                            <i class="material-icons">person</i>Profile
                        </a>
                    </li>
                    <li role="separator" class="divider"></li>
                    <li>
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                            <i class="material-icons">input</i><span>{{ __('Logout') }}</span>
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- #User Info -->
    <!-- Menu -->
    <div class="menu">
        <ul class="list">
            <li class="header">MAIN NAVIGATION</li>

            @if(Request::is('admin*'))
                <li class="{{ Request::is('admin/dashboard') ? 'active' : '' }}">
                    <a href="{{ route('admin.dashboard') }}">
                        <i class="material-icons">dashboard</i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/slider*') ? 'active' : '' }}">
                    <a href="{{ route('admin.slider.index') }}">
                        <i class="material-icons">slideshow</i>
                        <span>Slider</span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/brand*') ? 'active' : '' }}">
                    <a href="{{ route('admin.brand.index') }}">
                        <i class="material-icons">extension</i>
                        <span>Brands</span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/review*') ? 'active' : '' }}">
                    <a href="{{ route('admin.review.index') }}">
                        <i class="material-icons">rate_review</i>
                        <span>Review</span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/faq*') ? 'active' : '' }}">
                    <a href="{{ route('admin.faq.index') }}">
                        <i class="material-icons">extension</i>
                        <span>FAQs</span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/plan*') ? 'active' : '' }}">
                    <a href="{{ route('admin.plan.index') }}">
                        <i class="material-icons">pets</i>
                        <span>All Plans</span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/package*') ? 'active' : '' }}">
                    <a href="{{ route('admin.package.index') }}">
                        <i class="material-icons">local_laundry_service</i>
                        <span>All Package</span>
                    </a>
                </li>
                {{-- <li class="{{ Request::is('admin/designation*') ? 'active' : '' }}">
                    <a href="{{ route('admin.designation.index') }}">
                        <i class="material-icons">sentiment_very_satisfied</i>
                        <span>Designation</span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/team*') ? 'active' : '' }}">
                    <a href="{{ route('admin.team.index') }}">
                        <i class="material-icons">sentiment_very_satisfied</i>
                        <span>Our Teams</span>
                    </a>
                </li> --}}

                <li class="{{ Request::is('admin/team*', 'admin/designation*') ? 'active' : '' }}">
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="material-icons">sentiment_very_satisfied</i>
                        <span>Our Teams</span>
                    </a>
                    <ul class="ml-menu">
                        <li class="{{ Request::is('admin/team*') ? 'active' : '' }}">
                            <a href="{{ route('admin.team.index') }}">
                                <span>Add New</span>
                            </a>
                        </li>
                        <li class="{{ Request::is('admin/designation*') ? 'active' : '' }}">
                            <a href="{{ route('admin.designation.index') }}">
                                <span>Designation</span>
                            </a>
                        </li>
                    </ul>
                </li>

                
                <li class="{{ Request::is('admin/tag*', 'admin/category*', 'admin/post*', 'admin/pending/post', 'admin/favorite') ? 'active' : '' }}">
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="material-icons">widgets</i>
                        <span>Blog Posts</span>
                    </a>
                    <ul class="ml-menu">
                        <li class="{{ Request::is('admin/tag*') ? 'active' : '' }}">
                            <a href="{{ route('admin.tag.index') }}">
                                {{-- <i class="material-icons">label</i> --}}
                                <span>Tag</span>
                            </a>
                        </li>
                        <li class="{{ Request::is('admin/category*') ? 'active' : '' }}">
                            <a href="{{ route('admin.category.index') }}">
                                {{-- <i class="material-icons">apps</i> --}}
                                <span>Category</span>
                            </a>
                        </li>
                        <li class="{{ Request::is('admin/post*') ? 'active' : '' }}">
                            <a href="{{ route('admin.post.index') }}">
                                {{-- <i class="material-icons">library_books</i> --}}
                                <span>Blog Post</span>
                            </a>
                        </li>
                        <li class="{{ Request::is('admin/pending/post') ? 'active' : '' }}">
                            <a href="{{ route('admin.post.pending') }}">
                                {{-- <i class="material-icons">library_books</i> --}}
                                <span>Pending Post</span>
                            </a>
                        </li>
                        <li class="{{ Request::is('admin/favorite') ? 'active' : '' }}">
                            <a href="{{ route('admin.favorite.index') }}">
                                {{-- <i class="material-icons">favorite</i> --}}
                                <span>Favorite Post</span>
                            </a>
                        </li>
                    </ul>
                </li>
                
                
                <li class="{{ Request::is('admin/comments') ? 'active' : '' }}">
                    <a href="{{ route('admin.comment.index') }}">
                        <i class="material-icons">comment</i>
                        <span>Comment</span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/subscriber') ? 'active' : '' }}">
                    <a href="{{ route('admin.subscriber.index') }}">
                        <i class="material-icons">subscriptions</i>
                        <span>All Subscribers</span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/authors') ? 'active' : '' }}">
                    <a href="{{ route('admin.authors.index') }}">
                        <i class="material-icons">account_circle</i>
                        <span>All Authors</span>
                    </a>
                </li>
                <li role="separator" class="header">System</li>
                <li class="{{ Request::is('admin/settings') ? 'active' : '' }}">
                    <a href="{{ route('admin.settings') }}">
                        <i class="material-icons">settings</i>
                        <span>Settings</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                        <i class="material-icons">input</i><span>{{ __('Logout') }}</span>
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            @endif
            @if(Request::is('author*'))
                <li class="{{ Request::is('author/dashboard') ? 'active' : '' }}">
                    <a href="{{ route('author.dashboard') }}">
                        <i class="material-icons">dashboard</i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="{{ Request::is('author/post*') ? 'active' : '' }}">
                    <a href="{{ route('author.post.index') }}">
                        <i class="material-icons">library_books</i>
                        <span>Blog Post</span>
                    </a>
                </li>
                <li class="{{ Request::is('author/comments') ? 'active' : '' }}">
                    <a href="{{ route('author.comment.index') }}">
                        <i class="material-icons">comment</i>
                        <span>Comment</span>
                    </a>
                </li>
                <li class="{{ Request::is('author/favorite') ? 'active' : '' }}">
                    <a href="{{ route('author.favorite.index') }}">
                        <i class="material-icons">favorite</i>
                        <span>Favorite Post</span>
                    </a>
                </li>
                <li role="separator" class="header">System</li>
                <li class="{{ Request::is('author/settings') ? 'active' : '' }}">
                    <a href="{{ route('author.settings') }}">
                        <i class="material-icons">settings</i>
                        <span>Settings</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                        <i class="material-icons">input</i><span>{{ __('Logout') }}</span>
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            @endif
            
        </ul>
    </div>
    <!-- #Menu -->
    <!-- Footer -->
    <div class="legal">
        <div class="copyright">
            &copy; 2020 <a href="javascript:void(0);">Admin - MY-WEB</a>.
        </div>
        <div class="version">
            <b>Version: </b> 1.0.0
        </div>
    </div>
    <!-- #Footer -->
</aside>