@extends ('layouts.admin')

@section('content')

    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <strong class="card-title">Update member</strong>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">Member Name</th>
                        <th scope="col">Member Tribe</th>
                        <th scope="col">Member Role</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$member->name}}</td>
                            <td>{{$member->tribename}}</td>
                            <td>HAVE TO ADD</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <strong>Edit member Form</strong>
            </div>
            <div class="card-body card-block">
                <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                    <div class="row form-group">
                        <div class="col col-md-3"><label class=" form-control-label">Member Name</label></div>
                        <div class="col-12 col-md-9">
                            <p class="form-control-static">{{$member->name}}</p>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="selectLg" class=" form-control-label">Select Tribe</label></div>
                        <div class="col-12 col-md-9">
                            <select name="selectLg" id="selectLg" class="form-control-lg form-control">
                                <option value="0">Please select</option>
                                <option value="1">Option #1</option>
                                <option value="2">Option #2</option>
                                <option value="3">Option #3</option>
                            </select>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="selectLg" class=" form-control-label">Select Role</label></div>
                        <div class="col-12 col-md-9">
                            <select name="selectLg" id="selectLg" class="form-control-lg form-control">
                                <option value="0">Please select</option>
                                <option value="1">Option #1</option>
                                <option value="2">Option #2</option>
                                <option value="3">Option #3</option>
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

@endsection