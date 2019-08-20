@extends('index')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <h2>{{ Auth::user()->name }}{{ __(', Welcome to your Personal Account') }}</h2>
    <div class="alert alert-secondary m-3" role="alert">
        <h5 class="alert-heading">{{ __('At the moment, your balance is:') }}</h5>
        <hr>
        <h2><span class="badge badge-success">{{ Auth::user()->balance }} &#8364;</span></h2>
        <a class="btn btn-dark" href="{{ route('transfer.balance') }}">{{ __('Top up balance') }}</a>
    </div>
  </div>
  <div class="row justify-content-center">  
      @include('transfers.transfers_block')
      @include('transfers.transfers_planned_block')
  </div>
</div>

@endsection
