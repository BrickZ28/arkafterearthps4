@extends ('layouts.admin')

@section('content')

    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <strong class="card-title">Money Spent Transactions</strong>
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
                <form action="/searchTransactionsPyUser" method="get">
                    @csrf
                    <input  name="search_text" placeholder="Insert value to search" class="text-muted" type="text"/>
                    <button type="submit" class="btn btn-primary">Search Transactions</button>
                </form>

                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">Transaction ID</th>
                        <th scope="col">Transaction Amount</th>
                        <th scope="col">Receiver</th>
                        <th scope="col">Reason</th>
                        <th scope="col">Date</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($pays as $pay)
                        {{--{{dd($pays)}}--}}
                        {{--{{dd($pays, $pay)}}--}}
                        <tr>
                            <td>{{$pay->id}}</td>
                            <td>{{$pay->transaction_amount}}</td>
                            <td>{{$pay->name}}</td>

                            <td>{{$pay->reason}}</td>
                            <td>{{\Carbon\Carbon::parse($pay->created_at)->format('d M Y')}}</td>
                        </tr>

                    @endforeach
                    </tbody>
                </table>
                {{$pays->links()}}
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <strong class="card-title">Money to Bank Transactions</strong>
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
               {{-- <form action="/searchTransactionsToBank" method="get">
                    @csrf
                    <input  name="search_text" placeholder="Insert value to search" class="text-muted" type="text"/>
                    <button type="submit" class="btn btn-primary">Search Transactions</button>
                </form>--}}

                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">Transaction ID</th>
                        <th scope="col">Transaction Amount</th>
                        <th scope="col">Dino</th>
                        <th scope="col">Reason</th>
                        <th scope="col">Date</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($bankPays as $bankPay)
                        {{--{{dd($pays)}}--}}
                        {{--{{dd($pays, $pay)}}--}}
                        <tr>
                            <td>{{$bankPay->id}}</td>
                            <td>{{$bankPay->transaction_amount}}</td>
                            <td>{{$bankPay->dino_id}}</td>

                            <td>{{$bankPay->reason}}</td>
                            <td>{{\Carbon\Carbon::parse($bankPay->created_at)->format('d M Y')}}</td>
                        </tr>

                    @endforeach
                    </tbody>
                </table>
                {{$bankPays->links()}}
            </div>
        </div>
    </div>



@endsection