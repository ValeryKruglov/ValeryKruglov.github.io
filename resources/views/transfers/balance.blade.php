@extends('index')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card cover-form">
                <div class="card-header cover-form-header">{{ __('Top up balance') }}</div>

                <div class="card-body cover-form-body">
                    <form class="needs-validation" novalidate method="POST" action="{{ route('transfer.balance.store') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="summ" class="col-md-3 col-form-label text-md-right">{{ __('Amount *') }}</label>

                            <div class="col-md-8">
                                <div class="input-group">
                                    <input id="summ" type="number" min="10" step="0.01" value="10.00" placeholder="00,00" inputmode="decimal" class="form-control @error('summ') is-invalid @enderror" name="summ" value="{{ old('summ') }}" required autocomplete="email" autofocus> 
                                    <div class="input-group-append">
                                      <div class="input-group-text">&#8364;</div>
                                    </div>
                                    <div class="invalid-feedback w-100" role="alert">
                                        <ul>
                                            <li><strong>{{ __('Amount field is empty or filled out with an error.') }} <br>{{ __('(Input format example: 00.00 ') }}&#8364;)</strong></li>
                                            @error('summ')
                                                <li><strong>{{ $message }}</strong></li>
                                            @enderror
                                        </ul>
                                    </div>
                                </div>
                                <small id="summHelpBlock" class="form-text text-info">
                                    {{ __('* Minimum payment amount 10') }}&#8364;
                                </small>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-secondary">
                                    {{ __('Submit') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
