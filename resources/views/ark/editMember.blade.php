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
                        <th scope="col">PVE Tribe</th>
                        <th scope="col">PVP Tribe</th>
                        <th scope="col">Member Role</th>
                        <th scope="col">Member Permissions</th>
                    </tr>
                    </thead>
                    <tbody>

                        <tr>
                            <td>{{$member->name}}</td>
                            <td>{{$member->tribeName_pve}}</td>
                            <td>{{$member->tribeName_pve}}</td>
                            <td>{{$member->roles->first()->name}}</td>
                            <td>{{$member->permissions->first()->name}}</td>
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
                <form action="/editMember/{{$member->id}}"  method="post" enctype="multipart/form-data" class="form-horizontal">
                    @method('PATCH')
                    @csrf
                    <div class="row form-group">
                        <div class="col col-md-3"><label class=" form-control-label">Member Name</label></div>
                        <div class="col-12 col-md-9">
                            <p class="form-control-static">{{$member->name}}</p>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">PVE Tribe Name</label>
                        </div>
                        <div class="col-12 col-md-9"><input type="input" id="text-input" name="pve" value="{{$member->tribeName_pve}}" class="form-control" required>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">PVP Tribe Name</label>
                        </div>
                        <div class="col-12 col-md-9"><input type="input" id="text-input" name="pvp" value="{{$member->tribeName_pvp}}" class="form-control" required>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="selectLg" class=" form-control-label">Select Role</label></div>
                        <div class="col-12 col-md-9">
                            <select name="role" id="selectLg" class="form-control-lg form-control" required>
                                <option value="{{$member->roles->first()->id}}">{{$member->roles->first()->name}}</option>
                                @foreach($roles as $role)
                                <option value="{{$role->id}}">{{$role->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="selectLg" class=" form-control-label">Remove Permission</label></div>
                        <div class="col-12 col-md-9">
                            <select name="permissionR" id="selectLg" class="form-control-lg form-control">
                                <option value="">Select One</option>
                                @foreach($member->permissions as $permission)
                                    <option value="{{$permission->id}}">{{$permission->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="selectLg" class=" form-control-label">Add Permission</label></div>
                        <div class="col-12 col-md-9">
                            <select name="permissionA" id="selectLg" class="form-control-lg form-control" >
                                <option value="">Select One</option>
                                @foreach($noPerms as $noPerms)
                                    <option value="{{$noPerms->id}}">{{$noPerms->name}}</option>
                                @endforeach
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