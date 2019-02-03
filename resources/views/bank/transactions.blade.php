@extends ('layouts.admin')

@section('content')

    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <strong class="card-title">Transaction List</strong>
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
                        <th scope="col">Receiver</th>
                        <th scope="col">Item</th>
                        <th scope="col">Reason</th>
                        <th scope="col">Date</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($transactions as $transaction)
                        <tr>
                            <td>{{$transaction->id}}</td>
                            <td>{{$transaction->transaction_amount}}</td>
                            @if($transaction->reason === 'Bank Payment')
                                <td>Bank</td>
                            @elseif($transaction->reason === 'Bank always has money')
                                <td>Owners</td>
                            @elseif($transaction->payer_id !== '0')
                                <td>{{$transaction->payer}}</td>
                            @endif


                            @if($transaction->receiver_id !== 'bank')
                                <td>{{$transaction->receiver}}</td>
                            @else
                                <td>Bank</td>
                            @endif
                            <td>{{$transaction->dino_id}}</td>
                            <td>{{$transaction->reason}}</td>
                            <td>{{Carbon\Carbon::parse($transaction->created_at)->format('d M Y')}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $transactions->links() }}
            </div>

        </div>
    </div>

@endsection