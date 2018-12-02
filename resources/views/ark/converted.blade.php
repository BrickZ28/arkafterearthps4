@extends ('layouts.admin')

@section('content')
    <div class="col-sm-12">
        <div class="alert  alert-primary fade show" role="alert">
            <span class="badge badge-pill badge-alert">CONVERTED</span> <span class="alert alert-secondary">{{$amount}} {{$currency}} </span>is converted for a total of <span class="alert alert-warning">{{$gems}} gems.
                @if($remainder > 0)
            </span> <span class="alert alert-success">{{$refund}} </span>
            @endif
        </div>
    </div>

@endsection