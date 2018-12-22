@extends ('layouts.admin')

@section('content')

    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <strong class="card-title">Roles</strong>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Role Name</th>
                            <th scope="col">Roles Permissions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($roles as $role)
                            @foreach($role->permissions as $perm)
                        <tr>
                            <td>{{$role->name}}</td>
                            <td>{{$perm->name}}</td>
                        </tr>
                        @endforeach
                            @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection