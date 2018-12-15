@extends ('layouts.admin')

@section('content')

    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <strong class="card-title">My Profile</strong>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">Member Name</th>
                        <th scope="col">PVE Tribe</th>
                        <th scope="col">PVP Tribe</th>
                        <th scope="col">Member Role</th>
                    </tr>
                    </thead>
                    <tbody>

                    <tr>
                        <td>{{Auth::user()->name}}</td>
                        <td>{{Auth::user()->tribeName_pve}}</td>
                        <td>{{Auth::user()->tribeName_pve}}</td>
                        <td>{{Auth::user()->roles()->pluck('name')->toArray()[0]}}</td>
                    </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <strong>Update My Info</strong>
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
                <form action="/myProfile/{{Auth::user()->id}}"  method="post" enctype="multipart/form-data" class="form-horizontal">
                    @method('PATCH')
                    @csrf
                    <div class="row form-group">
                        <div class="col col-md-3"><label class=" form-control-label">PSN Name</label></div>
                        <div class="col-12 col-md-9">
                            <input type="input" id="text-input" name="name" value="{{Auth::user()->name}}" class="form-control" required>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">Email/Username</label>
                        </div>
                        <div class="col-12 col-md-9"><input type="email" id="text-input" name="email" value="{{Auth::user()->email}}" class="form-control" required>
                        </div>
                    </div>



                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary btn-sm">
                            <i class="fa fa-dot-circle-o"></i> Submit
                        </button>
                        <a href="{{ route('password.request') }}" class="btn btn-danger btn-sm" role="button" aria-disabled="true">Reset Password</a>
                    </div>

                </form>
            </div>

@endsection