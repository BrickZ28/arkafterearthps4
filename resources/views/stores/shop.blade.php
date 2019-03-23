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
                @if (session('nofunds'))
                    <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                        <span class="badge badge-pill badge-alert">Failed</span>
                        {{ session('nofunds') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                    <form action="/pveLimitedsearchDinos" method="get">
                        @csrf
                        <input  name="search_text" placeholder="Insert value to search" class="text-muted" type="text"/>
                        <button type="submit" class="btn btn-primary">Search PVE Dinos</button>
                    </form>


                <table class="table table-striped"  >
                    <thead>
                    <tr>
                        <th scope="col">Item Name</th>
                        <th scope="col">Item Image</th>
                        <th scope="col">Price</th>
                        <th scope="col">In Stock</th>
                        <th scope="col">Level</th>
                        <th scope="col">Information</th>
                        <th scope="col">Request Item</th>
                        <th scope="col">Update Item</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($shops as $item)
                        <tr>
                            <td>{{$item->name}}
                                @if(strtotime($item->created_at) > strtotime('-7 day'))
                                    <span class="badge badge-success pull-right">New</span>
                                @endif
                            </td>
                            <td><span><img src="{{$item->link}}"></span></td>
                            <td>{{$item->price}}</td>
                            <td>{{$item->qty}}</td>
                            <td>{{$item->level}}</td>
                            <td>{{$item->description}}</td>

                            <td>
                                <a href="/item/requestItem/{{$item->id}}">
                                    <button type="button" class="btn btn-secondary btn-sm" >Request Item</button>
                                </a>
                            </td>


                                <td>
                                    <a href="/item/{{$item->id}}">
                                        <button type="button" class="btn btn-secondary btn-sm">Update Item</button>
                                    </a>
                                </td>

                        </tr>

                    @endforeach
                    </tbody>
                </table>
                {{ $shops->appends(request()->query())->links() }}
            </div>

        </div>
    </div>

@endsection