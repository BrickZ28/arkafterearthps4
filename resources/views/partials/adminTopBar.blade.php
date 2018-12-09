<header id="header" class="header">

    <div class="header-menu">

        <div class="col-sm-7">
            <a id="menuToggle" class="menutoggle pull-left"><i class="fa fa fa-tasks"></i></a>
            <div class="header-left">

                <div class="dropdown for-notification">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="notification" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-desktop"></i>
                        <span class="badge badge-warning">PVP</span>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="notification">
                        <p class="red">PVP CLuster Servers</p>
                        <a class="dropdown-item media bg-flat-color-3" href="#">
                            <span class="photo media-left"><img alt="t-rex" src="{{asset('img/dinos/trex.png')}}"></span>
                            <span class="message media-body">
                                    <span class="name float-left"> Ultraboost\ /AfterEarth\ /Moddeddrops </span>
                                    <span class="time float-right">CLUSTER</span>
                            </span>
                        </a>
                        <a class="dropdown-item media bg-flat-color-4" href="#">
                            <span class="photo media-left"><img alt="t-rex" src="{{asset('img/dinos/trex.png')}}"></span>
                            <span class="message media-body">
                                    <span class="name float-left">  Extinction\ /AfterEarth\ /Free4all</span>
                                    <span class="time float-right">CLUSTER</span>
                            </span>
                        </a>
                    </div>
                </div>

                <div class="dropdown for-message">
                    <button class="btn btn-secondary dropdown-toggle" type="button"
                            id="message"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-desktop"></i>
                        <span class="badge badge-primary">PVE</span>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="message">
                        <p class="red">PVE CLuster Servers</p>
                        <a class="dropdown-item media bg-flat-color-1" href="#">
                            <span class="photo media-left"><img alt="t-rex" src="{{asset('img/dinos/dodo.png')}}"></span>
                            <span class="message media-body">
                                    <span class="name float-left"> Extinction\ /AfterEarthCluster \ /LightBoost </span>
                                    <span class="time float-right">CLUSTER</span>
                            </span>
                        </a>
                        <a class="dropdown-item media bg-flat-color-4" href="#">
                            <span class="photo media-left"><img alt="t-rex" src="{{asset('img/dinos/dodo.png')}}"></span>
                            <span class="message media-body">
                                    <span class="name float-left">  Ragnarok\ /AfterEarthCluster\ / Lightboost </span>
                                    <span class="time float-right">CLUSTER</span>
                            </span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-5">
            <div class="user-area dropdown float-right">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="user-avatar rounded-circle" src="{{asset('img/dinos/Griffin.jpg')}}" alt="User Avatar">User Menu
                </a>

                <div class="user-menu dropdown-menu">
                    <a class="nav-link" href="#"><i class="fa fa-user"></i> My Profile</a>
                    <a class="nav-link" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                        <i class="fa fa-power-off"></i></a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>

</header><!-- /header -->