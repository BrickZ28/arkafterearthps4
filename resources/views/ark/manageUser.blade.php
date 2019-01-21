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
                <strong class="card-title">Member List</strong>
            </div>
            <div class="card-body">

                <form action="/searchMembers" method="get">
                    @csrf
                    <input  name="search_text" placeholder="Insert value to search" class="text-muted" type="text"/>
                    <button type="submit" class="btn btn-primary">Search Users</button>
                </form>

                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">PSN Name</th>
                        <th scope="col">PVE Tribe</th>
                        <th scope="col">PVP Tribe</th>
                        <th scope="col">Users Role</th>
                        <th scope="col">Has Starter</th>
                        <th scope="col">Highest Level Kit</th>
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
                            @if($member->has_starter === 1)
                                <td>Yes</td>
                            @else
                                <td>No</td>
                            @endif
                            <td>{{$member->level_kit}}</td>
                            <td>
                                @if(Auth::id() !== $member->id or $member->hasRole('Owner'))
                                <a href="/editMember/{{$member->id}}">
                                    <button type="button" class="btn btn-secondary btn-sm">Update Member</button>
                                </a>
                                    @endif
                            </td>

                        </tr>
                    @endforeach
                    @endforeach
                    </tbody>
                </table>
                {{ $members->links() }}
            </div>
        </div>
    </div>

@endsection