@extends ('layouts.admin')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="col-xs-12 col-sm-12">
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
                <strong class="card-title">Change Pin
                    <div class="alert alert-danger" role="alert">
                        Removes player from gate
                    </div>
                </strong>

            </div>
            <div class="card-body">
                <form method="post" action="/gates/{{$gate->id}}">
                    @method('PATCH')
                    @csrf
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">Gate</th>
                        <th scope="col">Gate Style</th>
                        <th scope="col">Gate Pin</th>
                    </tr>
                    </thead>
                    <tbody>
                       <tr>
                           <td>{{$gate->gate}}</td>
                            <td>{{$gate->style}}</td>
                            <td><input id="pin" name="pin" type="text" class="form-control" aria-required="true" aria-invalid="false"  ></td>
                       </tr>
                    </tbody>
                </table>
                    <button id="payment-button" type="submit" class="btn btn-sm btn-secondary">
                        <span id="payment-button-amount">Update gate</span>
                    </button>
                    <input type="hidden" name="id" value="{{$gate->id}}">
            </form>
        </div>
        </div>
    </div>
@endsection