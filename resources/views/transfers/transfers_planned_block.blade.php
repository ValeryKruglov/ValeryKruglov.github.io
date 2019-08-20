<div class="alert alert-secondary m-3" role="alert">
    <h5 class="alert-heading">{{ __('Your planned transfers:') }}</h5>
    <hr>
    <ul class="list-group list-group-flush">
      @if(count($planned_transfers) > 0)
        @foreach ($planned_transfers as $transfer)
          <li class="list-group-item list-group-item-action list-group-item-danger mb-3 border">
            <strong>- {{$transfer->invoice_amount}} &#8364;</strong> {{ __(' to '.$users_list->find($transfer->to_user_id)->name) }}
            <br>
            {{\Carbon\Carbon::parse($transfer->dateTime_transfer)->format('d.m.Y H:00')}}
            @if($transfer->comment) 
              <br><span class="badge badge-light font-italic w-100 p-2 mt-2">{{ __('Comment: "'.$transfer->comment.'"') }}</span>
              <a class="btn btn-info mt-3" href="{{ route('transfer.send', $transfer->id) }}">{{ __('Send this transfer') }}</a>
            @endif
          </li>
        @endforeach
        @else
          <li class="list-group-item list-group-item-action list-group-item-warning">{{ __('You do not have planned transfers') }}</li>
      @endif
    </ul>
</div>