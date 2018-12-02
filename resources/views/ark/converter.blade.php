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
    <form method="post" action="/converted">
    @csrf

        <div class="col-xs-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <strong class="card-title">Select Currency</strong>
                </div>
                <div class="card-body">

                    <select data-placeholder="Select Currency" class="standardSelect" tabindex="1" name="currency">
                        <option value="">Select One</option>
                        <option value="pearls"  @if (old('currency') == 'pearls') selected="selected" @endif>Black Pearls</option>
                        <option value="metal" @if (old('currency') == 'metal') selected="selected" @endif>Metal Ingots</option>
                    </select>
                </div>
            </div>
        </div>

            <div class="col-xs-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Input Amount</strong>
                    </div>
                    <div class="card-body">

                        <label for="cc-payment" class="control-label mb-1">Currency Selected Amount</label>
                        <input id="amount" name="amount" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{Request::old('amount')}}">
                    </div>
                </div>

        <div class="form-group row mb-0">
                <div class="col-md-8 offset-md-4">
                    <button type="submit" class="btn btn-dark ">
                        {{ __('Convert') }}
                    </button>
                </div>
            </div>
        </div>
    </form>
@endsection