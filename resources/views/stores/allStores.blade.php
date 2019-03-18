@extends ('layouts.admin')

@section('content')

    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                @if (session('success'))
                    <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
                        <span class="badge badge-pill badge-success">Success</span>
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                @if (session('transaction'))
                    <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
                        <span class="badge badge-pill badge-success">Success</span>
                        {{ session('transaction') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <strong class="card-title">Store List</strong>
            </div>
            <div class="card-body">

                <form action="/searchStores" method="get">
                    @csrf
                    <input  name="search_text" placeholder="Insert value to search" class="text-muted" type="text"/>
                    <button type="submit" class="btn btn-primary">Search Stores</button>
                </form>

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Store name</th>
                            <th scope="col">Store Owner</th>
                            <th scope="col">Store Items</th>
                            <th scope="col">Store Location</th>
                            <th scope="col">View Store</th>
                            <th scope="col">Edit Store</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($stores as $store)
                        <tr>
                            <td>{{$store->name}}</td>
                            <td>{{$store->storeOwner->name}}</td>
                            <td>{{$store->description}}</td>
                            <td>{{$store->location}}</td>
                            <td>{{$store->pve_level_kit}}
                                <a href="stores/{{$store->id}}">
                                    <button type="button" class="btn btn-secondary btn-sm">View Store</button>
                                </a>
                            </td>
                            <td>
                                @if($store->id === Auth::id())
                                    <a href="/stores/{{$store->id}}/edit">
                                        <button type="button" class="btn btn-secondary btn-sm">Update Store</button>
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $stores->links() }}
            </div>
        </div>
    </div>

@endsection