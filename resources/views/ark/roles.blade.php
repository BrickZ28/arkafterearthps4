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
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($roles as $role)
                        <tr>
                            <td>{{$role->name}}</td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection