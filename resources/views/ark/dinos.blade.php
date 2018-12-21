@extends ('layouts.admin')

@section('content')

    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <strong class="card-title">Dino List</strong>
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
                    <form action="/searchMembers" method="get">
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
                        <th scope="col">Update Dino</th>
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
                            <td>
                                <a href="/dinos/{{$dino->id}}">
                                    <button type="button" class="btn btn-secondary btn-sm">Update Dino</button>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection