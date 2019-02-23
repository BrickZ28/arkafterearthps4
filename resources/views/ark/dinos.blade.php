@extends ('layouts.admin')

@section('content')

    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <strong class="card-title">Dino List
                    <div class="alert alert-danger" role="alert">
                       Only Dinos that you can afford are shown.
                    </div>
                </strong>
            </div>
            <div class="card-body">
                @if (session('success'))
                    <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
                        <span class="badge badge-pill badge-success">Success</span>
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                @if(!auth()->user()->hasRole('Owner') || !auth()->user()->hasRole('Admin'))
                    @if($viewDinos === 'PVP')
                    <form action="/pvpLimitedsearchDinos" method="get">
                        @csrf
                        <input  name="search_text" placeholder="Insert value to search" class="text-muted" type="text"/>
                        <button type="submit" class="btn btn-primary">Search PVP Dinos</button>
                    </form>

                    @elseif($viewDinos  === 'PVE')
                            <form action="/pveLimitedsearchDinos" method="get">
                                @csrf
                                <input  name="search_text" placeholder="Insert value to search" class="text-muted" type="text"/>
                                <button type="submit" class="btn btn-primary">Search PVE Dinos</button>
                            </form>
                    @elseif($viewDinos  === 'all') <form action="/searchDinos" method="get">
                            @csrf
                            <input  name="search_text" placeholder="Insert value to search" class="text-muted" type="text"/>
                            <button type="submit" class="btn btn-primary">Search All Dinos</button>
                        </form>
                    @endif
                @endif
                @if(auth()->user()->hasRole('Owner') || auth()->user()->hasRole('Admin'))
                    @if($adminDinoSearch === 'pve')
                            <form action="/pveLimitedsearchDinosAdmin" method="get">
                                @csrf
                                <input  name="search_text" placeholder="Insert value to search" class="text-muted" type="text"/>
                                <button type="submit" class="btn btn-primary">Search PVE Dinos</button>
                            </form>
                    @elseif($adminDinoSearch === 'pvp')
                        <form action="/pvpLimitedsearchDinosAdmin" method="get">
                            @csrf
                            <input  name="search_text" placeholder="Insert value to search" class="text-muted" type="text"/>
                            <button type="submit" class="btn btn-primary">Search PVP Dinos</button>
                        </form>
                    @elseif($adminDinoSearch === 'all')
                        <form action="/searchDinosAdmin" method="get">
                        @csrf
                        <input  name="search_text" placeholder="Insert value to search" class="text-muted" type="text"/>
                        <button type="submit" class="btn btn-primary">Search All </button>
                        </form>
                    @endif
                @endif
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">Dino Name</th>
                        <th scope="col">Price</th>
                        <th scope="col">In Stock</th>
                        <th scope="col">Estimated Level</th>
                        <th scope="col">Dino Platform</th>
                        <th scope="col">Dino Details</th>
                        <th scope="col">Request Dino</th>
                        @can('PVP Dino Seller')
                        <th scope="col">Update Dino</th>
                            @endcan
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($dinos as $dino)
                        <tr>
                            <td>{{$dino->name}} <span class="photo media-left"><img  src="{{$dino->img}}"></span></td>
                            <td>{{$dino->price}}</td>
                            <td>{{$dino->qty}}</td>
                            <td>{{$dino->level}}</td>
                            <td>{{$dino->platform}}</td>
                            <td>{{$dino->details}}</td>
                            <td>
                                <a href="/dinos/requestDino/{{$dino->id}}">
                                    <button type="button" class="btn btn-secondary btn-sm" >Request Dino</button>
                                </a>
                            </td>
                            @can('PVP Dino Seller')
                            <td>
                                <a href="/dinos/{{$dino->id}}">
                                    <button type="button" class="btn btn-secondary btn-sm">Update Dino</button>
                                </a>
                            </td>
                                @endcan
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                    {{ $dinos->appends(request()->query())->links() }}
            </div>

        </div>
    </div>

@endsection