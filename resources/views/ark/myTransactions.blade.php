@extends ('layouts.admin')

@section('content')

    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <strong class="card-title"> Paid Transaction List</strong>
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
                <form action="/searchTransactions" method="get">
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
                        <th scope="col">Item</th>
                        <th scope="col">Reason</th>
                        <th scope="col">Date</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($earns as $earn){{--{{dd($earn->transactionspay)}}--}}
                        @foreach($earn->transactionspay as $earned)
                               <tr>
                                    <td>{{$earn->id}}</td>
                                    <td>{{$earned->transaction_amount}}</td>
                                    <td>PAYER</td>
                                    <td>ID</td>
                                    <td>{{$earned->reason}}</td>
                                    <td>{{$earn->created_at->format('d M Y')}}</td>
                                </tr>
                            @endforeach
                    @endforeach
                    </tbody>
                </table>
                    {{$earns->links()}}
            </div>
        </div>
    </div>

@endsection