@extends('layouts.admin')

@section('content')
    <div class="breadcrumbs">
        <div class="col-sm-12">
            <div class="page-header float-left">
                <div class="page-title">
                    <h1>Welcome, {{Auth::user()->name}} to AfterEarth user Area. Mange your tribe, or view the store </h1>
                </div>
            </div>
        </div>
@endsection
