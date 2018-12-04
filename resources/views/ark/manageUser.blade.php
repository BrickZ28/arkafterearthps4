@extends ('layouts.admin')

@section('content')

    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <strong class="card-title">Roles</strong>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">PSN Name</th>
                        <th scope="col">Member Tribe</th>
                        <th scope="col">Users Role</th>
                        <th scope="col">Update User</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($members as $member)
                        <tr>
                            <td>{{$member->name}}</td>
                            <td>{{$member->tribename}}</td>
                            <td>HAVE TO ADD</td>
                            <td><button type="button" class="btn btn-secondary btn-sm">Update Member</button></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection