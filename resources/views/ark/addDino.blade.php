@extends ('layouts.admin')

@section('content')

   <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <strong>Add Dino</strong>
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
                <form action="/dinos" method="post" class="form-horizontal">
                    @csrf
                    <div class="row form-group">
                        <div class="col col-sm-5"><label for="input-normal" class=" form-control-label">Dino Name</label></div>
                        <div class="col col-sm-6"><input type="text" id="input-normal" name="name" placeholder="Dino Name" class="form-control" value="{{old('name')}}" required></div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-sm-5"><label for="input-normal" class=" form-control-label">Dino Price</label></div>
                        <div class="col col-sm-6"><input type="text" id="input-normal" name="price" placeholder="Price" class="form-control" value="{{old('qty')}}" required></div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-sm-5"><label for="input-normal" class=" form-control-label">Quantity</label></div>
                        <div class="col col-sm-6"><input type="text" id="input-normal" name="qty" placeholder="Quantity" value="0" required class="form-control"></div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-sm-5"><label for="input-normal" class=" form-control-label">Estimated Level</label></div>
                        <div class="col col-sm-6"><input type="text" id="input-normal" name="level" placeholder="Estimated Level" class="form-control" required></div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-sm-5"><label for="selectLg" class=" form-control-label">Dino Platform</label></div>
                        <div class="col col-sm-6">
                            <select name="platform" id="selectLg" class="form-control-lg form-control" required>



                                <option value="{{ old('platform', '') }}">{{ old('platform', 'Select One') }}</option>
                                <option value="PVP">PVP</option>
                                <option value="PVE">PVE</option>

                            </select>
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

        </div>

@endsection