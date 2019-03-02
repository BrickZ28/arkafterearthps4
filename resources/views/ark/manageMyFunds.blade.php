@extends ('layouts.admin')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
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
                <strong class="card-title">Funds Manager</strong>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">My Balance</th>
                        <th scope="col">Current Interest Rate</th>
                        <th scope="col">Projected Interest Earned <span class="badge badge-info">(Fridays @ 12:00a.m. EST)</span></th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{Auth::user()->gem_balance}}</td>
                            @foreach($banks_info as $banks)
                            <td>{{$banks->interest_rate.'%'}}</td>

                            <td>{{round($interestEarned)}}</td>
                            @endforeach
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


        <div class="col-xs-12 col-sm-12">
            <div class="card">
                <div class="card-header">

                    <strong class="card-title">Send Web Currency to user</strong>
                    <form action="/searchToSend" method="get">
                        @csrf
                        <input  name="search_text" placeholder="Insert value to search" class="text-muted" type="text"/>
                        <button type="submit" class="btn btn-primary">Search Users</button>
                    </form>
                </div>

                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">Member Name</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Reason</th>
                            <th scope="col">Pay</th>
                        </tr>
                        </thead>
                        @foreach($users as $user) <form method="post" action="/user/user/transaction">
                            @method('PATCH')
                            @csrf

                        <tbody>

                        <tr>

                            <td>{{$user->name}}</td>
                            <td>
                                <input id="reason" name="amount" type="text" class="form-control" aria-required="true" aria-invalid="false">
                            </td>
                            <td><input id="amount" name="reason" type="text" class="form-control" aria-required="true" aria-invalid="false" ></td>
                            <td> <button id="payment-button" type="submit" class="btn btn-sm btn-info">
                                    <i class="fa fa-lock fa-lg"></i>&nbsp;
                                    <span id="payment-button-amount">Pay User</span>
                                </button>
                            </td>
                        </tr>
                        <input type="hidden" name="receiver" value="{{$user->id}}">
                        </tbody>
                        </form>
                        @endforeach
                    </table>
                    {{$users->links()}}
                </div>

            </div>
        </div>


    <form method="post" action="/user/bank/transaction/{{Auth::user()->id}}">
        @method('PATCH')
        @csrf
        <div class="col-xs-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <strong class="card-title">Send to bank</strong>
                </div>
                <div class="card-body">

                    <label for="cc-payment" class="control-label mb-1">Insert Amount</label>
                    <input id="amount" name="amount" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{Request::old('amount')}}">
                </div>
                <div class="card-body">
                    <label for="user-payment" class="control-label mb-1">Reason</label>
                    <input id="reason" name="reason" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{Request::old('reason')}}">
                    <div class="card-footer">
                        <button id="payment-button" type="submit" class="btn btn-lg btn-info">
                            <i class="fa fa-lock fa-lg"></i>&nbsp;
                            <span id="payment-button-amount">Pay Bank</span>
                        </button>
                    </div>
                </div>
            </div>

            </div>

    </form>
@endsection