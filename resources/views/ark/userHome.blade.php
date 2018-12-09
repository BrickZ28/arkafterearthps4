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
                                        <a href="#"> <i class="fa fa-envelope-o"></i> Tribe Role <span class="badge badge-primary pull-right">{{ Auth::user()->roles()->pluck('name')->toArray()[0]}}</span></a>
                                    </li>
                                    <li class="list-group-item">
                                        <a href="#"> <i class="fa fa-tasks"></i> Number of Members <span class="badge badge-danger pull-right">{{$tribecount}}</span></a>
                                    </li>
                                    <li class="list-group-item">
                                        <a href="#"> <i class="fa fa-bell-o"></i> Latest PVP Member <span class="badge badge-success pull-right">{{$last_pvp->name}}</span></a>
                                    </li>
                                    <li class="list-group-item">
                                        <a href="#"> <i class="fa fa-bell-o"></i> Latest PVE Member <span class="badge badge-success pull-right">{{$last_pve->name}}</span></a>
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
                                            <h2 class="text-light display-6">Store Deals</h2>
                                            <p>Latest Flash Sales</p>
                                        </div>
                                    </div>
                                </div>


                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">
                                        <a href="#"> <i class="fa fa-envelope-o"></i> Dinos <span class="badge badge-primary pull-right">0</span></a>
                                    </li>
                                    <li class="list-group-item">
                                        <a href="#"> <i class="fa fa-tasks"></i> Weaponry <span class="badge badge-danger pull-right">0</span></a>
                                    </li>
                                    <li class="list-group-item">
                                        <a href="#"> <i class="fa fa-bell-o"></i> Rare Items <span class="badge badge-success pull-right">0</span></a>
                                    </li>
                                    <li class="list-group-item">
                                        <a href="#"> <i class="fa fa-comments-o"></i> Armor/Saddles <span class="badge badge-warning pull-right r-activity">0</span></a>
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
                                        <a href="#"> <i class="fa fa-tasks"></i>{{Auth::user()->tribeName_pvp}} <span class="badge badge-danger pull-right">PVP</span></a>
                                    </li>
                                    <li class="list-group-item">
                                        <a href="#"> <i class="fa fa-bell-o"></i> {{Auth::user()->tribeName_pve}}  <span class="badge badge-success pull-right">PVE</span></a>
                                    </li>
                                    <li class="list-group-item">
                                        <a href="#"> <i class="fa fa-comments-o"></i> Member since <span class="badge badge-warning pull-right r-activity">{{$joined}}</span></a>
                                    </li>
                                </ul>

                            </section>
                        </aside>
                    </div>
                </div><!-- .row -->
            </div><!-- .animated -->
        </div><!-- .content -->

@endsection
