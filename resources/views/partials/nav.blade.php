<nav class="navbar top-bar navbar-static-top sps sps--abv">
    <div class="container relative-box "> <a class="navbar-brand" href="#">Afterearth</a><img src="{{asset('/img/AE-75.png')}}" alt="" height="50" width="50">
        <a href="https://paypal.me/AfterEarthClusters?locale.x=en_US">Donate Today<i class="fas fa-donate fa-2x"></i>
            </a>&nbsp;
        <button class="navbar-toggler hidden-lg-up collapsed" type="button" data-toggle="collapse" data-target="#exCollapsingNavbar2" aria-controls="exCollapsingNavbar2" aria-expanded="false" aria-label="Toggle navigation"> ☰ </button>
        <div class="navbar-toggleable-md collapse" id="exCollapsingNavbar2" >

            <ul class="nav navbar-nav pull-xs-right">

                <li class="nav-item active"> <a class="nav-link" href="#myCarousel">Home <span class="sr-only">(current)</span></a> </li>
                <li class="nav-item"> <a class="nav-link" href="#rules">PVP Rules</a> </li>
                <li class="nav-item"> <a class="nav-link" href="/settings">Settings</a> </li>
                {{--<li class="nav-item"> <a class="nav-link" href="/tribespvp">PVP Tribes</a> </li>
                <li class="nav-item"> <a class="nav-link" href="#">PVE Tribes</a> </li>--}}
                @if(Auth::check())
                    <li class="nav-item"> <a class="nav-link" href="/userhome">My Ark</a> </li>
                @else
                    <li class="nav-item"> <a class="nav-link" href="/register">Register</a> </li>
                    <li class="nav-item"> <a class="nav-link" href="/login">Login</a> </li>
                @endif
                <li class="nav-item"> <a href="https://www.facebook.com/ArkAfterearth/"><i class="fa fa-facebook-square fa-2x" aria-hidden="true"></i>
                    </a></li>


            </ul>
        </div>
    </div>
</nav>