@extends ('layouts.admin')

@section('content')

    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <strong class="card-title">Update Store</strong>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">Store Name</th>
                        <th scope="col">Store Description</th>
                        <th scope="col">Store Location</th>
                    </tr>
                    </thead>
                    <tbody>

                    <tr>
                        <td>{{$store->name}}</td>
                        <td>{{$store->description}}</td>
                        <td>{{$store->location}}</td>
                    </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <strong>Edit Store Form</strong>
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
                <form action="/stores/{{$store->id}}"  method="post" enctype="multipart/form-data" class="form-horizontal">
                    @method('PATCH')
                    @csrf
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">Store name</label>
                        </div>
                        <div class="col-12 col-md-9"><input type="input" id="text-input" name="name" value="{{$store->name}}" class="form-control" required>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">Store Description</label>
                        </div>
                        <div class="col-12 col-md-9"><input type="input" id="text-input" name="description" value="{{$store->description}}" class="form-control" required>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">Store Location</label>
                        </div>
                        <div class="col-12 col-md-9"><input type="input" id="text-input" name="location" value="{{$store->location}}" class="form-control" required>
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
                @if(auth()->user()->hasRole('Owner'))
                    <div class="card-footer">
                        <form action="/dinos/{{$store->id}}"  method="post" class="form-horizontal">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this dino?')">
                                <i class="fa fa-dot-circle-o"></i> DELETE
                            </button>
                        </form>
                    </div>
                @endif
            </div>

@endsection