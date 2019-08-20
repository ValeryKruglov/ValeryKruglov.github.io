@extends('index')

@section('content')
<h2>{{ __('Users list page. Total Users: '.count($users_list)) }}</h2>
<div class="container">
  <div class="row justify-content-center">

    @if(count($users_list)>0)
      @foreach($users_list as $user)
    
        <div class="w-100 alert alert-secondary m-3" role="alert">
            <h5 class="alert-heading">{{ __('User: ') }}
              <strong>{{$user->username}}</strong>
            </h5>
            @if($user->invoice_amount)
              <div class="alert alert-light" role="alert">
                  {{ __('The last transfer was made on '.\Carbon\Carbon::parse($user->dateTime_transfer)->format('d.m.Y H:m')) }}
                  <br>
                  <strong>- {{$user->invoice_amount}}&#8364;</strong> {{ __(' to '.$user->user_to_name) }}
                  <br>
                  <span class="badge badge-dark font-italic p-2 mt-2">
                    @if($user->comment)
                      {{ __('With comment: "'.$user->comment.'"') }}
                    @else
                      {{ __('No comment') }}
                    @endif
                  </span>
              </div>
            @else
              <div class="alert alert-light" role="alert">
                  {{ __('This user has not yet made transfers.') }}
              </div>
            @endif
        </div>
      @endforeach
    @endif
  </div>
</div>

@endsection
