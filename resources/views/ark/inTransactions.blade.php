@extends ('layouts.admin')

@section('content')

    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <strong class="card-title">Money Earned Transactions</strong>
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
                {{--<form action="/searchTransactionsByUser" method="get">
                    @csrf
                    <input  name="search_text" placeholder="Insert value to search" class="text-muted" type="text"/>
                    <button type="submit" class="btn btn-primary">Search Transactions</button>
                </form>--}}
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">Transaction ID</th>
                        <th scope="col">Transaction Amount</th>
                        <th scope="col">Payer</th>

                        <th scope="col">Reason</th>
                        <th scope="col">Date</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($earns as $earn)
                        {{--{{dd($earns)}}--}}
                        {{--{{dd($earns, $earn)}}--}}
                        <tr>
                            <td>{{$earn->id}}</td>
                            <td>{{$earn->transaction_amount}}</td>
                            <td>{{$earn->name}}</td>

                            <td>{{$earn->reason}}</td>
                            <td>{{\Carbon\Carbon::parse($earn->created_at)->format('d M Y')}}</td>
                        </tr>

                    @endforeach
                    </tbody>
                </table>
                {{$earns->links()}}
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <strong class="card-title">Money From Bank Transactions</strong>
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
                <form action="/searchTransactionsFromBank" method="get">
                    @csrf
                    <input  name="search_text" placeholder="Insert value to search" class="text-muted" type="text"/>
                    <button type="submit" class="btn btn-primary">Search Transactions</button>
                </form>

                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">Transaction ID</th>
                        <th scope="col">Transaction Amount</th>
                        <th scope="col">Payer</th>

                        <th scope="col">Reason</th>
                        <th scope="col">Date</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($earnsBank as $bank)
                        {{--{{dd($earns)}}--}}
                        {{--{{dd($earns, $earn)}}--}}
                        <tr>
                            <td>{{$bank->id}}</td>
                            <td>{{$bank->transaction_amount}}</td>
                            <td>Bank</td>

                            <td>{{$bank->reason}}</td>
                            <td>{{\Carbon\Carbon::parse($bank->created_at)->format('d M Y')}}</td>
                        </tr>

                    @endforeach
                    </tbody>
                </table>
                {{$earnsBank->links()}}
            </div>
        </div>
    </div>

@endsection