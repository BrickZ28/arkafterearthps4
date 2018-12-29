@extends ('layouts.admin')

@section('content')

    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <strong>Add Exchange Rate</strong>
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
            <div class="card">
                <div class="card-body card-block">
                    <form action="/exchangeRates" method="post" class="form-horizontal">
                        @csrf
                        <div class="row form-group">
                            <div class="col col-md-3"><label for="hf-material" class=" form-control-label">Material</label></div>
                            <div class="col-12 col-md-9"><input type="material" id="material" name="material" placeholder="Material" class="form-control"><span class="help-block">Please enter Material</span></div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3"><label for="worth" class=" form-control-label">Worth</label></div>
                            <div class="col-12 col-md-9"><input type="text" id="worth" name="worth" placeholder="Worth" class="form-control"><span class="help-block">Please enter material worth</span></div>
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


        </div>

@endsection