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
                @if (session('failed'))
                    <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                        <span class="badge badge-pill badge-danger">Fail</span>
                        {{ session('failed') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <strong>Add Image</strong>
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
                <form action="/images" method="post" class="form-horizontal" enctype="multipart/form-data">
                    @csrf
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="selectLg" class=" form-control-label">Image Category</label></div>
                        <div class="col-12 col-md-9">
                            <select name="category" id="selectLg" class="form-control-lg form-control" required>
                                <option value="">Select One</option>
                                @foreach($categories as $category)
                                    <option value="{{$category->folder_attribute}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">Add item image</label>
                        </div>
                        <div class="row form-group">
                            <div class="col-12 col-md-9"><input type="file" id="file-input" name="img" class="form-control-file"></div>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3""><label for="input-normal" class=" form-control-label">Name</label></div>
                        <div class="col col-sm-6"><input type="text" id="input-normal" name="name" placeholder="name" class="form-control" value="{{old('name')}}" required>
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