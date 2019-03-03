@extends('layouts.admin')

@section('content')
    <div class="breadcrumbs">
        <div class="col-sm-12">
            <div class="page-header float-left">
                <div class="page-title">
                    <h1>Welcome, {{Auth::user()->name}} to AfterEarth user Area. Mange your tribe, view the store, and find other server info </h1>
                </div>
            </div>
        </div>

        <div class="content mt-5">
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-md-4">
                        <aside class="profile-nav alt">
                            <section class="card">
                                <div class="card-header user-header alt bg-dark">
                                    <div class="media">
                                        <a href="#">
                                            <img class="align-self-center rounded-circle mr-3" style="width:85px; height:85px;" alt="" src="{{asset('img/tribe/tribe.png')}}">
                                        </a>
                                        <div class="media-body">
                                            <h2 class="text-light display-6">Tribe Info</h2>
                                            <p>PVP - {{Auth::user()->tribeName_pvp}}</p>
                                            <p>PVE - {{Auth::user()->tribeName_pve}}</p>
                                        </div>
                                    </div>
                                </div>


                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">
                                        <a href="#"> <i class="fas fa-meh-rolling-eyes"></i> Tribe Role <span class="badge badge-primary pull-right">{{ Auth::user()->roles()->pluck('name')->toArray()[0]}}</span></a>
                                    </li>
                                    <li class="list-group-item">
                                        <a href="#"> <i class="fas fa-user"></i> Number of Members <span class="badge badge-danger pull-right">{{$tribecount}}</span></a>
                                    </li>
                                    <li class="list-group-item">
                                        <a href="#"> <i class="fas fa-user"></i> Latest PVP Member <span class="badge badge-success pull-right">{{$last_pvp->name}}</span></a>
                                    </li>
                                    <li class="list-group-item">
                                        <a href="#"> <i class="fas fa-user"></i> Latest PVE Member <span class="badge badge-success pull-right">{{$last_pve->name}}</span></a>
                                    </li>
                                </ul>

                            </section>
                        </aside>
                    </div>

                    <div class="col-md-4">
                        <aside class="profile-nav alt">
                            <section class="card">
                                <div class="card-header user-header alt bg-dark">
                                    <div class="media">
                                        <a href="#">
                                            <img class="align-self-center rounded-circle mr-3" style="width:85px; height:85px;" alt="" src="{{asset('img/store/store.jpg')}}">
                                        </a>
                                        <div class="media-body">
                                            <h2 class="text-light display-6">Store Updates</h2>

                                        </div>
                                    </div>
                                </div>


                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">
                                        <a href="#"> <i class="fas fa-paw"></i> Dinos added this week <span class="badge badge-primary pull-right">{{$newDinos}}</span></a>
                                    </li>{{--
                                    <li class="list-group-item">
                                        <a href="#"> <i class="fas fa-utensils"></i> Weaponry <span class="badge badge-danger pull-right">0</span></a>
                                    </li>
                                    <li class="list-group-item">
                                        <a href="#"> <i class="fas fa-fingerprint"></i> Rare Items <span class="badge badge-success pull-right">0</span></a>
                                    </li>
                                    <li class="list-group-item">
                                        <a href="#"> <i class="fas fa-shield-alt"></i> Armor/Saddles <span class="badge badge-warning pull-right r-activity">0</span></a>
                                    </li>--}}
                                </ul>

                            </section>
                        </aside>
                    </div>

                    <div class="col-md-4">
                        <aside class="profile-nav alt">
                            <section class="card">
                                <div class="card-header user-header alt bg-dark">
                                    <div class="media">
                                        <a href="#">
                                            <img class="align-self-center rounded-circle mr-3" style="width:85px; height:85px;" alt="" src="{{asset('img/profile/person.jpg')}}">
                                        </a>
                                        <div class="media-body">
                                            <h2 class="text-light display-6">My Profile</h2>
                                            <p>{{Auth::user()->name}}</p>
                                        </div>
                                    </div>
                                </div>


                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">
                                        <a href="#"> {{Auth::user()->email}}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <a href="#"> <i class="fas fa-campground"></i>{{Auth::user()->tribeName_pvp}} <span class="badge badge-danger pull-right">PVP</span></a>
                                    </li>
                                    <li class="list-group-item">
                                        <a href="#"> <i class="fas fa-campground"></i> {{Auth::user()->tribeName_pve}}  <span class="badge badge-success pull-right">PVE</span></a>
                                    </li>
                                    <li class="list-group-item">
                                        <a href="#"> <i class="fas fa-dollar-sign"></i> Account balance <span class="badge badge-warning pull-right r-activity">{{Auth::user()->gem_balance}}</span></a>
                                    </li>
                                    <li class="list-group-item">
                                        <a href="#"> <i class="fas fa-clock"></i> Member since <span class="badge badge-warning pull-right r-activity">{{$joined}}</span></a>
                                    </li>
                                </ul>

                            </section>
                        </aside>
                    </div>
                </div><!-- .row -->
            </div><!-- .animated -->
        </div><!-- .content -->

@endsection
