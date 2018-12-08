@extends ('layouts.admin')

@section('content')

    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <strong class="card-title">Member List</strong>
            </div>
            <div class="card-body">

                <form action="/searchMembers" method="get">
                    @csrf
                    <input  name="search_text" value="Insert value to search" class="text-muted" type="text"/>
                    <button type="submit" class="btn btn-primary">Search Users</button>
                </form>

                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">PSN Name</th>
                        <th scope="col">PVE Tribe</th>
                        <th scope="col">PVP Tribe</th>
                        <th scope="col">Users Role</th>
                        <th scope="col">Update User</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($members as $member)
                    @foreach($member->roles as $role)

                        <tr>
                            <td>{{$member->name}}</td>
                            <td>{{$member->tribeName_pve}}</td>
                            <td>{{$member->tribeName_pvp}}</td>

                                <td>{{$role->name}}</td>

                            <td>
                                <a href="/editMember/{{$member->id}}">
                                    <button type="button" class="btn btn-secondary btn-sm">Update Member</button>
                                </a>
                            </td>
                        </tr>

                    @endforeach
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection