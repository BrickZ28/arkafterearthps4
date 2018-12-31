@extends ('layouts.admin')

@section('content')

    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <strong class="card-title">Exchange Rates</strong>
            </div>
            <div class="card-body">
                @if (session('success'))
                    <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                        <span class="badge badge-pill badge-danger">Success</span>
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">Material</th>
                        <th scope="col">Worth</th>
                        @if(auth()->user()->hasRole('Owner'))
                        <th scope="col">Edit Rate</th>
                            @endif
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($exchangeRates as $exchangeRate)
                        <tr>
                            <td>{{$exchangeRate->material}}</td>
                            <td>{{$exchangeRate->worth}}</td>
                            @if(auth()->user()->hasRole('Owner'))
                                <td>
                                    <a href="/exchangeRates/{{$exchangeRate->id}}">
                                        <button type="button" class="btn btn-secondary btn-sm">Update Rate</button>
                                    </a>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection