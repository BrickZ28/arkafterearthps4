@extends ('layouts.admin')

@section('content')
    <div class="content mt-3">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">Conversion Completed</strong>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">Amount Converted</th>
                                    <th scope="col">Currency</th>
                                    <th scope="col">Gems Due</th>
                                    <th scope="col">Refund Amount</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>{{$amount}}</td>
                                    <td>{{$currency}}</td>
                                    <td>{{$gems}}</td>
                                    <td>@if($remainder > 0)
                                            {{$refund}}
                                        @endif</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

@endsection