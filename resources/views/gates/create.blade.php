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
    <div class="col-xs-12 col-sm-12">
        <div class="card">
            <div class="card-header">
                <strong class="card-title">Send Money to user</strong
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