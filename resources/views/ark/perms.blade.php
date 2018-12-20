@extends ('layouts.admin')

@section('content')

    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <strong class="card-title">Permissions</strong>
            </div>
            <div class="card-body">
                @if (session('success'))
                    <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
                        <span class="badge badge-pill badge-success">Success</span>
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">Permission Name</th>
                        <th scope="col">Delete Permission</th>
                        <th scope="col">Edit Permission</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($perms as $perm)
                        <tr>
                            <td>{{$perm->name}}</td>
                            <td>

                                <form action="/permissions/{{$perm->id}}" onclick="return confirm('Are you sure you want to delete this permission?')" method="post">
                                    @csrf
                                    @method('delete')
                                    <div>
                                        <button type="submit" class="btn btn-danger btn-sm">Delete Permission</button>
                                    </div>
                                </form>
                            </td>
                            <td>
                                <a href="/permissions/{{$perm->id}}">
                                    <button type="button" class="btn btn-secondary btn-sm" >Update Permission</button>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection