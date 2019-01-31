@extends ('layouts.admin')

@section('content')

    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <strong class="card-title">PVE Gate List
                    @if (session('success'))
                        <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
                            <span class="badge badge-pill badge-success">Success</span>
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <div class="alert alert-danger" role="alert">
                        Pin numbers must be unique
                    </div>
                </strong>
            </div>
            <div class="card-body">

                    <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">Gate Number</th>
                        <th scope="col">Gate style</th>
                        <th scope="col">Gate Pin</th>
                        <th scope="col">Assigned To</th>
                        <th scope="col">Updated By</th>
                        <th scope="col">Date Updated</th>
                        <th scope="col">Change Pin</th>
                        <th scope="col">Delete Gate</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($pveGates as $gate)

                        <tr>
                            <td>{{$gate->gate}}</td>
                            <td>{{$gate->style}}</td>
                            <td>{{$gate->pin}}</td>
                            <td>{{$gate->usergate['name']}}</td>
                            <td>{{$gate->givenBy['name']}}</td>
                            <td>{{$gate->updated_at->format('d M Y')}}</td>
                            <td>
                                <a href="/gates/{{$gate->id}}/edit">
                                 <button type="button" class="btn btn-success btn-sm">Change Pin</button>
                                </a>
                            </td>
                            <td><form action="/gates/{{$gate->id}}"  method="post" enctype="multipart/form-data" class="form-horizontal">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this gate?')">
                                        DELETE GATE
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        {{$pveGates->links()}}
        </div>
    </div>

    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <strong class="card-title">PVP Gate List

                </strong>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">Gate Number</th>
                        <th scope="col">Gate style</th>
                        <th scope="col">Gate Pin</th>
                        <th scope="col">Assigned To</th>
                        <th scope="col">Updated By</th>
                        <th scope="col">Date Updated</th>
                        <th scope="col">Change Pin</th>
                        <th scope="col">Delete Gate</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($pvpGates as $gate)

                        <tr>
                            <td>{{$gate->gate}}</td>
                            <td>{{$gate->style}}</td>
                            <td>{{$gate->pin}}</td>
                            <td>{{$gate->usergate['name']}}</td>
                            <td>{{$gate->givenBy['name']}}</td>
                            <td>{{$gate->updated_at->format('d M Y')}}</td>
                            <td>
                                <a href="/gates/{{$gate->id}}/edit">
                                    <button type="button" class="btn btn-success btn-sm">Change Pin</button>
                                </a>
                            </td>
                            <td><form action="/gates/{{$gate->id}}"  method="post" enctype="multipart/form-data" class="form-horizontal">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete gate {{$gate->gate}} from {{$gate->style}}?')">
                                        DELETE GATE
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            {{$pvpGates->links()}}
        </div>
    </div>

@endsection