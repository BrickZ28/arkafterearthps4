@extends ('layouts.admin')

@section('content')
    {{--Top Menu--}}
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
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
                    @if (session('failed'))
                        <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                            <span class="badge badge-pill badge-danger">Failed</span>
                            {{ session('failed') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                @if(auth()->user()->hasRole('Owner') || auth()->user()->hasRole('Admin'))
                <strong class="card-title">Update member</strong>
                @endif
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">Member Name</th>
                        @if(auth()->user()->hasRole('Owner') || auth()->user()->hasRole('Admin'))
                        <th scope="col">Member Email</th>
                        <th scope="col">Member Gems</th>
                        <th scope="col">PVP Tribe</th>
                        <th scope="col">PVE Tribe</th>
                        <th scope="col">Member Role</th>
                        <th scope="col">Member Permissions</th>
                        @endif
                    </tr>
                    </thead>
                    <tbody>

                        <tr>
                            <td>{{$member->name}}</td>
                            @if(auth()->user()->hasRole('Owner') || auth()->user()->hasRole('Admin'))
                            <td>{{$member->email}}</td>
                            <td>{{$member->gem_balance}}</td>
                            <td>{{$member->tribeName_pvp}}</td>
                            <td>{{$member->tribeName_pve}}</td>
                            <td>{{$member->roles->first()->name}}</td>
                            <td>{{$member->permissions->first()->name}}</td>
                            @endif
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{--Verify Reg Code--}}
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <strong class="card-title">Verify Registration Code</strong>
            </div>
            <div class="card-body card-block">
                <form action="/verifyCode/{{$member->id}}" method="get" enctype="multipart/form-data" class="form-horizontal">
                    @csrf
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">Insert Code</label>
                        </div>
                        <div class="col-12 col-md-9"><input type="input" id="text-input" name="regcode"  class="form-control">
                        </div>
                    </div>
                    <div class="col col-md-12">
                        <div class="form-check">
                            <div class="radio">
                                <label for="radio1" class="form-check-label ">
                                    <input type="radio" id="radio1" name="startertype" value="pvpstarter" class="form-check-input" required>PVP
                                </label>
                            </div>
                            <div class="radio">
                                <label for="radio2" class="form-check-label ">
                                    <input type="radio" id="radio2" name="startertype" value="pvestarter" class="form-check-input" required>PVE
                                </label>
                            </div>
                            {{--<div class="radio">
                                <label for="radio3" class="form-check-label ">
                                    <input type="radio" id="radio3" name="startertype" value="bothstarter" class="form-check-input" required>Both
                                </label>
                            </div>--}}
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
    </div>

    {{--Owner to send pin--}}
    @if(auth()->user()->hasRole('Owner') || auth()->user()->hasRole('Admin'))
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <strong class="card-title">Send Pin</strong>
            </div>
            <div class="card-body card-block">
                <form action="/sendpin" method="post" enctype="multipart/form-data" class="form-horizontal">
                    @csrf
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="selectLg" class=" form-control-label">Select PVE Gate</label></div>
                        <div class="col-12 col-md-9">
                            <select name="pve" id="selectLg" class="form-control-lg form-control" >
                                <option value="">SELECT EITHER PVP or PVE</option>
                                @foreach($pveGates as $gate)
                                <option value="{{$gate->id}}">{{$gate->gate}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="alert alert-danger" role="alert">
                        OR
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="selectLg" class=" form-control-label">Select PVP Gate</label></div>
                        <div class="col-12 col-md-9">
                            <select name="pvp" id="selectLg" class="form-control-lg form-control" >
                                <option value="">SELECT EITHER PVP or PVE</option>
                                @foreach($pvpGates as $gate)
                                    <option value="{{$gate->id}}">{{$gate->gate}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                   {{-- <div class="row form-group">
                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">Pin code</label>
                        </div>
                        <div class="col-12 col-md-9"><input type="input" id="text-input" name="pin" class="form-control">
                        </div>
                    </div>--}}
                    {{--<div class="row form-group">
                        <div class="col col-md-3"><label class=" form-control-label">Play Style</label></div>
                        <div class="col col-md-9">
                            <div class="form-check">
                                <div class="radio">
                                    <label for="radio1" class="form-check-label ">
                                        <input type="radio" id="radio1" name="style" value="pvp" class="form-check-input" required>PVP
                                    </label>
                                </div>
                                <div class="radio">
                                    <label for="radio2" class="form-check-label ">
                                        <input type="radio" id="radio2" name="style" value="pve" class="form-check-input" required>PVE
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>--}}
                    <input name="email" type="hidden" value="{{$member->email}}">
                    <input name="name" type="hidden" value="{{$member->name}}">
                    <input name="player" type="hidden" value="{{$member->id}}">
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


    {{--bottom menu--}}
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <strong>Edit member Form</strong>
            </div>

            <div class="card-body card-block">
                <form action="/editMember/{{$member->id}}"  method="post" enctype="multipart/form-data" class="form-horizontal">
                    @method('PATCH')
                    @csrf

                    <div class="row form-group">
                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">Member Email</label>
                        </div>
                        <div class="col-12 col-md-9"><input type="input" id="text-input" name="email" value="{{$member->email}}" class="form-control" required>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">PVP Tribe Name</label>
                        </div>
                        <div class="col-12 col-md-9"><input type="input" id="text-input" name="pvp" value="{{$member->tribeName_pvp}}" class="form-control" required>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">PVE Tribe Name</label>
                        </div>
                        <div class="col-12 col-md-9"><input type="input" id="text-input" name="pve" value="{{$member->tribeName_pve}}" class="form-control" required>
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
                        <div class="col col-md-3"><label class=" form-control-label">PVP Starter Pack</label></div>
                        <div class="col col-md-3">
                            <div class="form-check">
                                <div class="checkbox">
                                    <label for="checkbox1" class="form-check-label ">
                                        <input type="checkbox" id="checkbox1" name="pvpstarter"
                                               @if($member->has_pvp_starter===1)
                                               checked
                                               @endif
                                               value="1"
                                               class="form-check-input">Check for Yes
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col col-md-3"><label for="selectLg" class=" form-control-label">Select PVP Level Kit</label></div>
                        <div class="col-12 col-md-3">
                            <select name="pvplevelKit" id="selectLg" class="form-control-lg form-control">
                                @if($member->pvp_level_kit !== NULL)
                                    <option value="{{$member->pvp_level_kit}}">{{$member->pvp_level_kit}}</option>
                                @else
                                    <option value="">Select One</option>
                                @endif
                                <option value="40">40</option>
                                <option value="80">80</option>
                                <option value="120">120</option>
                            </select>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3"><label class=" form-control-label">PVE Starter Pack</label></div>
                        <div class="col col-md-3">
                            <div class="form-check">
                                <div class="checkbox">
                                    <label for="checkbox1" class="form-check-label ">
                                        <input type="checkbox" id="checkbox1" name="pvestarter"
                                               @if($member->has_pve_starter===1)
                                               checked
                                               @endif
                                               value="1"
                                               class="form-check-input">Check for Yes
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col col-md-3"><label for="selectLg" class=" form-control-label">Select PVE Level Kit</label></div>
                        <div class="col-12 col-md-3">
                            <select name="pvelevelKit" id="selectLg" class="form-control-lg form-control">
                                @if($member->pve_level_kit !== NULL)
                                    <option value="{{$member->pve_level_kit}}">{{$member->pve_level_kit}}</option>
                                @else
                                    <option value="">Select One</option>
                                @endif
                                <option value="40">40</option>
                                <option value="80">80</option>
                                <option value="120">120</option>
                            </select>
                        </div>
                    </div>
                    {{--<div class="row form-group">
                        <div class="col col-md-3"><label for="selectLg" class=" form-control-label">Select Level Kit</label></div>
                        <div class="col-12 col-md-9">
                            <select name="levelKit" id="selectLg" class="form-control-lg form-control">
                                @if($member->level_kit !== NULL)
                                    <option value="{{$member->level_kit}}">{{$member->level_kit}}</option>
                                @else
                                    <option value="">Select One</option>
                                @endif
                                <option value="40">40</option>
                                <option value="80">80</option>
                                <option value="120">120</option>
                            </select>
                        </div>

                    </div>--}}
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
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">Pay Member</label>
                        </div>
                        <div class="col-12 col-md-9"><input type="input" id="text-input" name="gemamount" value="{{old('gemamount')}}" class="form-control">
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
                <div class="card-footer">
                    <form action="/users/{{$member->id}}"  method="post" enctype="multipart/form-data" class="form-horizontal">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this user?')">
                            <i class="fa fa-dot-circle-o"></i> DELETE
                        </button>
                    </form>
                </div
            </div>
    @endif

@endsection