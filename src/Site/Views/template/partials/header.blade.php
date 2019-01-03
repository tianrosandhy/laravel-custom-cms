<!-- header start -->
<header class="header-area transparent-bar sticky-bar">
    <div class="container-fluid">
        <div class="header-wrap header-flex">
            <div class="logo-2">
                <a href="{{ url('/') }}">
                    <img alt="" src="{{ asset('assets/img/logo/logo-white.png') }}" alt="{{ setting('site.title') }}">
                </a>
            </div>
            <div class="header-right-wrap mt-55">
                <div class="header-search mr-20">
                    <button onclick="gtr('Search Button Click')" class="sidebar-trigger-search">
                        <span class="ti-search"></span>
                    </button>
                </div>
            </div>
        </div>
        
        <div class="main-menu main-menu-left custom-main-menu">
            <nav>
                <ul>
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li><a href="{{ url('blog') }}">Articles</a></li>
                    <li><a href="{{ url('project') }}">Our Clients</a></li>
                    <li><a href="{{ url('contact') }}">Contact Us</a></li>
                </ul>
            </nav>
        </div>

        <div class="mobile-menu-area custom">
            <div class="mobile-menu">
                <nav id="mobile-menu-active">
                    <ul class="menu-overflow">
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li><a href="{{ url('blog') }}">Articles</a></li>
                        <li><a href="{{ url('project') }}">Our Clients</a></li>
                        <li><a href="{{ url('contact') }}">Contact Us</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</header>

<!-- main-search start -->
<div class="main-search-active">
    <div class="sidebar-search-icon">
        <button class="search-close"><span class="ti-close"></span></button>
    </div>
    <div class="sidebar-search-input">
        <form class="site-search" action="{{ url('search') }}" method="get">
            <div class="form-search">
                <input id="search_keyword" class="input-text" value="" placeholder="Type Your Keyword Here" type="search">
                <button onclick="gtr('Search Action')">
                    <i class="ti-search"></i>
                </button>
            </div>
        </form>
    </div>
</div>