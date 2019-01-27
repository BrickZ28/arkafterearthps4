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
                <strong class="card-title">Bank Information</strong>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">Bank balance</th>
                        <th scope="col">Interest Rate</th>
                        <th scope="col">Daily Transactions</th>
                        <th scope="col">Monthly Transactions</th>
                        <th scope="col">Yearly Transactions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($banks as $bank)
                        <tr>
                            <td>{{$bank->balance}}</td>
                            <td>{{$bank->interest_rate. '%'}}</td>
                            <td>{{$dailyTransactions}}</td>
                            <td>{{$monthlyTransactions}}</td>
                            <td>{{$yearlyTransactions}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <strong>Add transaction</strong>
            </div>
            <div class="card-body card-block">
                <form action="/bank/{{$banks->first()}}"  method="post" enctype="multipart/form-data" class="form-horizontal">
                    @method('PATCH')
                    @csrf
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">Add Funds</label>
                        </div>
                        <div class="col-12 col-md-9"><input type="input" id="text-input" name="funds" value="{{old('funds')}}" class="form-control">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">Change Interest Rate</label>
                        </div>
                        <div class="col-12 col-md-9"><input type="input" id="text-input" name="rate" value="{{$bank->interest_rate}}" class="form-control" >
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success btn-sm">
                            <i class="fa fa-dot-circle-o"></i> Submit
                        </button>
                        <button type="reset" class="btn btn-secondary btn-sm">
                            <i class="fa fa-ban"></i> Reset
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection