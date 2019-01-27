@extends ('layouts.admin')

@section('content')

    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <strong class="card-title">Dino List
                    <div class="alert alert-danger" role="alert">
                       You must pay for dino's directly from your account thru " My Request", in Dinos menu.
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
                    <form action="/searchDinos" method="get">
                    @csrf
                    <input  name="search_text" placeholder="Insert value to search" class="text-muted" type="text"/>
                    <button type="submit" class="btn btn-primary">Search Dinos</button>
                </form>

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
                            <td>{{$dino->name}}</td>
                            <td>{{$dino->price}}</td>
                            <td>{{$dino->qty}}</td>
                            <td>{{$dino->level}}</td>
                            <td>{{$dino->platform}}</td>
                            <td>{{$dino->details}}</td>
                            <td>
                                <a href="/dinos/requestDino/{{$dino->id}}">
                                    <button type="button" class="btn btn-secondary btn-sm">Request Dino</button>
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
                    {{ $dinos->links() }}
            </div>

        </div>
    </div>

@endsection