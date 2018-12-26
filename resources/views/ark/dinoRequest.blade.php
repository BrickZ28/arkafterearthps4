@extends ('layouts.admin')

@section('content')

    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <strong class="card-title">Request dino</strong>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">Dino Name</th>
                        <th scope="col">Dino Price</th>
                        <th scope="col">Dino Quantity</th>
                        <th scope="col">Dino Platform</th>
                    </tr>
                    </thead>
                    <tbody>

                    <tr>
                        <td>{{$dino->name}}</td>
                        <td>{{$dino->price}}</td>
                        <td>{{$dino->qty}}</td>
                        <td>{{$dino->platform}}</td>
                    </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <strong>Request Dino Form</strong>
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
                <form action="/dinos/request/send/{{$dino->id}}"  method="get" enctype="multipart/form-data" class="form-horizontal">
                    @csrf
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">Dino name</label>
                        </div>
                        <div class="col-12 col-md-9"><input type="input" id="text-input" name="name" value="{{$dino->name}}" class="form-control" required readonly>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">Dino Price</label>
                        </div>
                        <div class="col-12 col-md-9"><input type="input" id="text-input" name="price" value="{{$dino->price}}" class="form-control" required readonly>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">Dino Quantity</label>
                        </div>
                        <div class="col-12 col-md-9"><input type="input" id="text-input" name="qty" value="{{$dino->qty}}" class="form-control" required>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">Dino Level</label>
                        </div>
                        <div class="col-12 col-md-9"><input type="input" id="text-input" name="level" value="{{$dino->level}}" class="form-control" required readonly>
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