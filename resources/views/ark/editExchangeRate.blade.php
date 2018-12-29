@extends ('layouts.admin')

@section('content')

    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <strong class="card-title">Update Exchange Rate</strong>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">Material Name</th>
                        <th scope="col">Material Worth</th>
                    </tr>
                    </thead>
                    <tbody>

                    <tr>
                        <td>{{$exchangeRate->material}}</td>
                        <td>{{$exchangeRate->worth}}</td>
                    </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <strong>Edit Rate Form</strong>
            </div>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error )
                            <li>
                                {{$error}}
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="card-body card-block">
                <form action="/exchangeRates/{{$exchangeRate->id}}"  method="post" enctype="multipart/form-data" class="form-horizontal">
                    @method('PATCH')
                    @csrf
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">Material name</label>
                        </div>
                        <div class="col-12 col-md-9"><input type="input" id="text-input" name="material" value="{{$exchangeRate->material}}" class="form-control" required>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">Material worth</label>
                        </div>
                        <div class="col-12 col-md-9"><input type="input" id="text-input" name="worth" value="{{$exchangeRate->worth}}" class="form-control" required>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary btn-sm">
                            <i class="fa fa-dot-circle-o"></i> Submit
                        </button>
                        <button type="reset" class="btn btn-danger btn-sm">
                            <i class="fa fa-ban"></i> Reset
                        </button>
                    </div>

                </form>
            </div>

@endsection