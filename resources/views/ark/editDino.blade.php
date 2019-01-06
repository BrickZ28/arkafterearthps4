@extends ('layouts.admin')

@section('content')

    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <strong class="card-title">Update dino</strong>
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
                <strong>Edit Dino Form</strong>
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
                <form action="/dinos/{{$dino->id}}"  method="post" enctype="multipart/form-data" class="form-horizontal">
                    @method('PATCH')
                    @csrf
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">Dino name</label>
                        </div>
                        <div class="col-12 col-md-9"><input type="input" id="text-input" name="name" value="{{$dino->name}}" class="form-control" required>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">Dino Price</label>
                        </div>
                        <div class="col-12 col-md-9"><input type="input" id="text-input" name="price" value="{{$dino->price}}" class="form-control" required>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">Dino Quanitity</label>
                        </div>
                        <div class="col-12 col-md-9"><input type="input" id="text-input" name="qty" value="{{$dino->qty}}" class="form-control" required>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">Dino Level</label>
                        </div>
                        <div class="col-12 col-md-9"><input type="input" id="text-input" name="level" value="{{$dino->level}}" class="form-control" required>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="selectLg" class=" form-control-label">Dino Platform</label></div>
                        <div class="col-12 col-md-9">
                            <select name="platform" id="selectLg" class="form-control-lg form-control" required>
                                <option value="{{$dino->platform}}">{{$dino->platform}}</option>
                                <option value="PVP">PVP</option>
                                <option value="PVE">PVE</option>

                            </select>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="textarea-input" class=" form-control-label">Textarea</label></div>
                        <div class="col-12 col-md-9"><textarea name="details" id="textarea-input" rows="9" placeholder="Neat stuff about the Dino" class="form-control">{{$dino->details}}</textarea></div>
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
                <div class="card-footer">
                <form action="/dinos/{{$dino->id}}"  method="post" enctype="multipart/form-data" class="form-horizontal">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this dino?')">
                        <i class="fa fa-dot-circle-o"></i> DELETE
                    </button>
                </form>
            </div>
            </div>

@endsection