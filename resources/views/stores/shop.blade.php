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
                        <th scope="col">Price</th>
                        <th scope="col">In Stock</th>
                        <th scope="col">Level</th>
                        <th scope="col">Description</th>
                        <th scope="col">Request Item</th>
                        @can('Store Owner')
                            <th scope="col">Update Item</th>
                        @endcan
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($shops as $shop)
                        <tr>
                            <td>{{$shop->item['name']}}
                                @if(strtotime($shop->item['created_at']) > strtotime('-7 day'))
                                    <span class="badge badge-success pull-right">New</span>
                                @endif
                            </td>
                            <td>{{$shop->item['price']}}</td>
                            <td>{{$shop->item['qty']}}</td>
                            <td>{{$shop->item['level']}}</td>
                            <td>{{$shop->item['description']}}</td>
                            <td>
                                <a href="/item/requestItem/{{$shop->item['id']}}">
                                    <button type="button" class="btn btn-secondary btn-sm" >Request Item</button>
                                </a>
                            </td>
                            @can('Store Owner')
                                <td>
                                    <a href="/item/{{$shop->item['id']}}">
                                        <button type="button" class="btn btn-secondary btn-sm">Update Dino</button>
                                    </a>
                                </td>
                            @endcan
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $shops->appends(request()->query())->links() }}
            </div>

        </div>
    </div>

@endsection