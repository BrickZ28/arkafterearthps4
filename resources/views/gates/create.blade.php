@extends ('layouts.admin')

@section('content')

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
                <strong>Add Gate</strong>
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
                <form action="/gates" method="post" class="form-horizontal">
                    @csrf
                    <div class="row form-group">
                        <div class="col col-sm-5"><label for="input-normal" class=" form-control-label">Gate Number</label></div>
                        <div class="col col-sm-6"><input type="text" id="input-normal" name="gate" placeholder="Gate Number" class="form-control" value="{{old('gate')}}" required></div>
                    </div><div class="row form-group">
                        <div class="col col-sm-5"><label for="selectLg" class=" form-control-label">Dino Style</label></div>
                        <div class="col col-sm-6">
                            <select name="style" id="selectLg" class="form-control-lg form-control" required>
                                <option value="{{ old('style', '') }}">{{ old('style', 'Select One') }}</option>
                                <option value="PVP">PVP</option>
                                <option value="PVE">PVE</option>
                            </select>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-sm-5"><label for="input-normal" class=" form-control-label">Gate Pin</label></div>
                        <div class="col col-sm-6"><input type="text" id="input-normal" name="pin" placeholder="Pin" value="{{old('pin')}}"  class="form-control"></div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary btn-sm">
                            <i class="fa fa-dot-circle-o"></i> Submit
                        </button>
                        <button type="reset" class="btn btn-danger btn-sm">
                            <i class="fa fa-ban"></i> Reset
                        </button>
                    </div>
                    <input type="hidden", name="admin" value="{{Auth::user()->id}}">
                </form>
            </div>

        </div>

@endsection