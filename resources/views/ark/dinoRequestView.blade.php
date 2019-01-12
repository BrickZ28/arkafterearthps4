@extends ('layouts.admin')

@section('content')

    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <strong class="card-title">Update Dino Request</strong>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">Requestor</th>
                        <th scope="col">Dino Name</th>
                        <th scope="col">How Many</th>
                        <th scope="col">Amount Due</th>
                        <th scope="col">Status</th>
                        <th scope="col">Last Action By</th>
                        <th scope="col">Created Date</th>
                        <th scope="col">Updated Date</th>
                        <th scope="col">Paid</th>
                    </tr>
                    </thead>
                    <tbody>

                    <tr>
                        <td>{{$dinoRequest->users->name}}</td>
                        <td>{{$dinoRequest->dinos->name}}</td>
                        <td>{{$dinoRequest->qty}}</td>
                        <td>{{$dinoRequest->total}}</td>
                        <td>{{$dinoRequest->status}}</td>
                        <td>{{$dinoRequest->users->name}}</td>
                        <td>{{$dinoRequest->created_at->format('d M Y')}}</td>
                        <td>{{$dinoRequest->updated_at->format('d M Y')}}</td>
                        @if($dinoRequest->paid === 0)
                            <td>No</td>
                        @else
                            <td>Yes</td>
                        @endif
                    </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <strong>Update member Form</strong>
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
                <form action="/dinoRequestEdit/{{$dinoRequest->id}}"  method="post" enctype="multipart/form-data" class="form-horizontal">
                    @method('PATCH')
                    @csrf
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">Update Dino Amount</label>
                        </div>
                        <div class="col-12 col-md-9"><input type="input" id="text-input" name="qty" value="{{$dinoRequest->qty}}" class="form-control" required>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col col-md-3"><label for="selectLg" class=" form-control-label">Status Update</label></div>
                        <div class="col-12 col-md-9">
                            <select name="status" id="selectLg" class="form-control-lg form-control" required>
                                <option value="{{$dinoRequest->status}}">{{$dinoRequest->status}}</option>
                                <option value="claimed">Claimed</option>
                                <option value="in-work">Working</option>
                                <option value="cancelled">Cancel</option>
                            </select>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3"><label class=" form-control-label">Paid</label></div>
                        <div class="col col-md-9">
                            <div class="form-check">
                                <div class="checkbox">
                                    <label for="checkbox1" class="form-check-label ">
                                        <input type="checkbox" id="checkbox1" name="paid"
                                               @if($dinoRequest->paid === 1)
                                               checked
                                               @endif
                                               value="1"
                                               class="form-check-input">Check for Paid
                                    </label>
                                </div>
                            </div>
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