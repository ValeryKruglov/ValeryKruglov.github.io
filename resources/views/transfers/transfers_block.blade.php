<div class="alert alert-secondary m-3" role="alert">
    <h5 class="alert-heading">{{ __('Your transfers for the month:') }}</h5>
    <hr>
    <ul class="list-group">
      @if(count($transfers) > 0)
        @foreach ($transfers as $transfer)
          @switch($transfer->type)
            @case('myself')
                <li class="list-group-item list-group-item-action list-group-item-success">
                  <strong>+ {{$transfer->invoice_amount}} &#8364;</strong> {{ __(' to yourself') }}
                </li>
                @break
        
            @case('another')
                <li class="list-group-item list-group-item-action list-group-item-danger">
                  <strong>- {{$transfer->invoice_amount}} &#8364;</strong> {{ __(' to '.$users_list->find($transfer->to_user_id)->name) }}
                  @if($transfer->comment) 
                    <br><span class="badge badge-light font-italic w-100 p-2 mt-2">{{ __('Comment: "'.$transfer->comment.'"') }}</span>
                  @endif
                </li>
                @break
          @endswitch
        @endforeach
        @else
          <li class="list-group-item list-group-item-action list-group-item-warning">{{ __('You have not yet made transfers or deposits') }}</li>
      @endif
    </ul>
</div>