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
            <strong>Add Store</strong>
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
            <form action="/stores" method="post" class="form-horizontal">
                @csrf
                <div class="row form-group">
                    <div class="col col-sm-5"><label for="input-normal" class=" form-control-label">Store Name</label></div>
                    <div class="col col-sm-6"><input type="text" id="input-normal" name="storeName" placeholder="Store Name" class="form-control" value="{{old('storeName')}}" required></div>
                </div>
                <div class="row form-group">
                    <div class="col col-sm-5"><label for="input-normal" class=" form-control-label">Store Type</label></div>
                    <div class="col col-sm-6"><input type="text" id="input-normal" name="storeItem" placeholder="What are you selling" class="form-control" value="{{old('storeItem')}}" required>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col col-sm-5"><label for="input-normal" class=" form-control-label">Store Location</label></div>
                    <div class="col col-sm-6"><input type="text" id="input-normal" name="storeLocation" placeholder="Map Location" class="form-control" value="{{old('storeLocation')}}" required>
                    </div>
                </div>
                    <input type="hidden" name="storeOwner" value="{{Auth::id()}}">
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