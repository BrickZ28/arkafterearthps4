@extends ('layouts.admin')

@section('content')

    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <strong class="card-title">Dino Requests</strong>
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
                <form action="/searchDinoRequests" method="get">
                    @csrf
                    <input  name="search_text" placeholder="Insert value to search" class="text-muted" type="text"/>
                    <button type="submit" class="btn btn-primary">Search Requests</button>
                </form>

                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">Request ID</th>
                        <th scope="col">Requestor</th>
                        <th scope="col">Dino Name</th>
                        <th scope="col">Dino Platform</th>
                        <th scope="col">Dino Level</th>
                        <th scope="col">Dino Details</th>
                        <th scope="col">How Many</th>
                        <th scope="col">Amount Due</th>
                        <th scope="col">Status</th>
                        <th scope="col">Last Action By</th>
                        <th scope="col">Paid</th>
                        <th scope="col">Created Date</th>
                        <th scope="col">Updated Date</th>
                        <th scope="col">Update Request</th>
                        <th scope="col">Process Request</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($dinoRequests as $dinoRequest)
                        <tr>
                            <td>{{$dinoRequest->id}}</td>
                            <td>{{$dinoRequest->users->name}}</td>
                            <td>{{$dinoRequest->dinos->name}}</td>
                            <td>{{$dinoRequest->dinos->platform}}</td>
                            <td>{{$dinoRequest->dinos->level}}</td>
                            <td>{{$dinoRequest->dinos->details}}</td>
                            <td>{{$dinoRequest->qty}}</td>
                            <td>{{$dinoRequest->total}}</td>
                            <td>{{$dinoRequest->status}}</td>
                            <td>{{$dinoRequest->users->name}}</td>
                            @if($dinoRequest->paid === 0)
                                <td>No</td>
                            @else
                                <td>Yes</td>
                            @endif
                            <td>{{$dinoRequest->created_at->format('d M Y')}}</td>
                            <td>{{$dinoRequest->updated_at->format('d M Y')}}</td>
                            <td>
                                <a href="/dinoRequestView/{{$dinoRequest->id}}">
                                    <button type="button" class="btn btn-secondary btn-sm">Update Request</button>
                                </a>
                            </td>
                            @can('PVP Dino Seller')
                                <td>
                                    <a href="/dinos/{{$dinoRequest->id}}/edit">
                                        <button type="button" name="completed" class="btn btn-secondary btn-sm">Complete Request</button>
                                    </a>
                                </td>
                            @endcan
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                    {{ $dinoRequests->links() }}
            </div>
        </div>
    </div>

@endsection