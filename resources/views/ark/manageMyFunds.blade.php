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
                        <th scope="col">Current Interest Earned <span class="badge badge-info">(paid weekly)</span></th>
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

    <form method="post" action="/user/user/transaction/{{Auth::user()->id}}">
        @method('PATCH')
        @csrf
        <div class="col-xs-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <strong class="card-title">Send Money to user</strong>
                </div>
                <div class="card-body">
                    <select data-placeholder="Select Currency" class="standardSelect" tabindex="1" name="receiver">
                        <option value="">Select One</option>
                        @foreach($users as $user)
                            <option value="{{$user->id}}">{{$user->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="card-body">
                    <label for="user-payment" class="control-label mb-1">Insert Amount</label>
                    <input id="amount" name="amount" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{Request::old('amount')}}">
                </div>
                <div class="card-body">
                    <label for="user-payment" class="control-label mb-1">Reason</label>
                    <input id="reason" name="reason" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{Request::old('reason')}}">
                    <div class="card-footer">
                        <button id="payment-button" type="submit" class="btn btn-lg btn-info">
                            <i class="fa fa-lock fa-lg"></i>&nbsp;
                            <span id="payment-button-amount">Pay User</span>
                        </button>
                    </div>
                </div>

            </div>

        </div>
    </form>
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
                            <span id="payment-button-amount">Pay User</span>
                        </button>
                    </div>
                </div>
            </div>
                <button id="payment-button" type="submit" class="btn btn-lg btn-info">
                    <i class="fa fa-lock fa-lg"></i>&nbsp;
                    <span id="payment-button-amount">Pay Bank</span>
                </button>
            </div>

    </form>
@endsection