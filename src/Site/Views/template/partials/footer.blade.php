<footer class="footer-area gray-bg pt-80 pb-80">
    <div class="container">
        <div class="footer-wrap">
            <div class="footer-menu">
                <nav>
                    <ul>
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li><a href="{{ url('blog') }}">Articles</a></li>
                        <li><a href="{{ url('project') }}">Our Works</a></li>
                        <li><a href="{{ url('contact') }}">Contact Us</a></li>
                    </ul>
                </nav>
            </div>
            <div class="footer-social-2">
                <ul>
                    <li><a sync href="{{ setting('static.facebook') }}"><i class="fa fa-facebook"></i></a></li>
                    <li><a sync href="{{ setting('static.instagram') }}"> <i class="fa fa-instagram"></i></a></li>
                    <li><a onclick="gtr('Whatsapp Chat Button')" sync href="{{ setting('static.whatsapp') }}"><i class="fa fa-fa fa-whatsapp"></i> </a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>