@extends ('layouts.admin')

@section('content')

    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <strong>Add Permissions</strong>
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
                <form action="/permissions" method="post" class="form-horizontal">
                    @csrf
                    <div class="row form-group">
                        <div class="col col-sm-5"><label for="input-normal" class=" form-control-label">Permission Name</label></div>
                        <div class="col col-sm-6"><input type="text" id="input-normal" name="name" placeholder="Permission Name" class="form-control" value="{{old('name')}}" required></div>
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

        </div>

@endsection