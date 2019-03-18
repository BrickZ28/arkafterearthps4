@extends ('layouts.admin')

@section('content')

    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <strong class="card-title">Item List
                    <div class="alert alert-danger" role="alert">
                        Only items that you can afford are shown.
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

                    <form action="/searchItems" method="get">
                        @csrf
                        <input  name="search_text" placeholder="Insert value to search" class="text-muted" type="text"/>
                        <button type="submit" class="btn btn-primary">Search store items</button>
                    </form>
                <table class="table table-striped"  >
                    <thead>
                    <tr>
                        <th scope="col">Item Name</th>
                        <th scope="col">Item Description</th>
                        <th scope="col">Item Price</th>
                        <th scope="col">In Stock</th>
                        <th scope="col">Item Level</th>
                        <th scope="col">Buy Item</th>
                        @can('Store Owner')
                            <th scope="col">Update Item</th>
                        @endcan
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($stores as $store)
                        <tr>
                            <td>{{$store->name}}
                                @if(strtotime($store->created_at) > strtotime('-7 day'))
                                    <span class="badge badge-success pull-right">New</span>
                                @endif
                            </td>
                            <td>{{$store->description}}</td>
                            <td>{{$store->price}}</td>
                            <td>{{$store->qty}}</td>
                            <td>{{$store->level}}</td>
                            <td>
                                <a href="/stores/requestItem/{{$store->id}}">
                                    <button type="button" class="btn btn-secondary btn-sm" >Request Item</button>
                                </a>
                            </td>
                            @can('Store Owner')
                                <td>
                                    <a href="/dinos/{{$store->id}}">
                                        <button type="button" class="btn btn-secondary btn-sm">Update Item</button>
                                    </a>
                                </td>
                            @endcan
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $stores->appends(request()->query())->links() }}
            </div>

        </div>
    </div>

@endsection