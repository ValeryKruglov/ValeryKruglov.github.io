@extends('index')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card cover-form">
                <div class="card-header cover-form-header">{{ __('To plan transfer') }}</div>

                <div class="card-body cover-form-body">
                    <form class="needs-validation" novalidate method="POST" action="{{ route('transfer.plan.store') }}">
                        @csrf

                        <div class="form-group row">
                            <h5 class="ml-2">{{ __('At the moment, your balance is: ') }}<span class="badge badge-success">{{ Auth::user()->balance }} &#8364;</span></h5>
                        </div>

                        <div class="form-group row">
                            <h5 class="ml-2">{{ __('Your planned transfers: ') }}<span class="badge badge-warning">{{ $planned }} &#8364;</span></h5>
                        </div>

                        <div class="form-group row">    
                            <h5 class="ml-2">{{ __('Available to transfer: ') }}
                                <span class="badge badge-light">
                                    @if($available < 0)
                                        0 &#8364;
                                    @else
                                        {{ $available }} &#8364;
                                    @endif
                                </span>
                            </h5>
                        </div>
                        <hr>
                        @if($available < 10)
                            <div class="alert alert-danger text-center" role="alert">
                              <h2 class="text-danger"><strong>{{ __('You do not have enough funds to make transfers!') }}</strong><br>{{ __('Minimum payment amount 10') }}&#8364;</h2>
                            </div>
                        @else
                            @if($errors->any())
                                <div class="alert alert-danger" role="alert">
                                    {{ __('Received the following input errors:') }}
                                    <ul>
                                @foreach($errors->all() as $error)
                                        <li>{{$error}}</li>
                                @endforeach
                                    </ul>
                                </div>
                            @endif
                            <div class="form-group row">
                                <label for="username" class="col-md-3 col-form-label text-md-right">{{ __('To user *') }}</label>

                                <div class="col-md-8">
                                    <div class="input-group">
                                        <select class="custom-select form-control" id="username" name="username" required autofocus>
                                            <option selected disabled value="">{{ __('User name') }}</option>
                                            @foreach($users_list as $user)
                                                <option value="{{$user->id}}">{{$user->name}}</option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback w-100" role="alert">
                                            <ul>
                                                <li><strong>{{ __('You must select the user who you want to transfer.') }}</strong></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="date_plan" class="col-md-3 col-form-label text-md-right">{{ __('Date of transfer *') }}</label>

                                <div class="col-md-8 bg-light p-3 rounded text-dark">
                                    <div class="col-md-10 ml-auto mr-auto" id="date_plan">
                                            <input id="date_pay" type="hidden"  name="date_pay" value="" required >
                                    </div>
                                    <hr>
                                    <small id="date_planHelpBlock" class="form-text text-center text-dark">
                                        {{ __('* The date and time can be set in increments of 1 hour.') }}<br>
                                        {{ __('The nearest date is the current and next hour.') }}
                                    </small>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="summ" class="col-md-3 col-form-label text-md-right">{{ __('Amount *') }}</label>

                                <div class="col-md-8">
                                        <div class="input-group">
                                            <input id="summ" type="number" min="10" max="{{$available}}" step="0.01" value="10.00" placeholder="00,00" inputmode="decimal" class="form-control" name="summ" value="{{ old('summ') }}" required > 
                                            <div class="input-group-append">
                                              <div class="input-group-text">&#8364;</div>
                                            </div>
                                            <div class="invalid-feedback w-100" role="alert">
                                                <ul>
                                                    <li><strong>{{ __('Amount field is empty or filled out with an error.') }}<br>{{ __('(Input format example: 00.00 )') }}&#8364;</strong></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <small id="summHelpBlock" class="form-text text-info">
                                            {{ __('* Minimum payment amount 10') }}&#8364;{{ __(', maximum payment amount '.$available) }}&#8364;
                                        </small>

                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="comment" class="col-md-3 col-form-label text-md-right">{{ __('Comment') }}</label>

                                <div class="col-md-8">
                                        <div class="input-group">
                                            <textarea class="form-control" id="comment" name="comment" placeholder="Comment" ></textarea>
                                        </div>
                                        <small id="commentHelpBlock" class="form-text text-info">
                                            {{ __('* If you wish, you can leave a comment for payment') }}
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
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
