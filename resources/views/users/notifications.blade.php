@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-header">Notifications</div>

    <div class="card-body">
      <ul class="list-group">
        @foreach ($notifications as $notification )
        <li class="list-group-item">
        @if ( $notification->type =='LaravelForum\Notifications\NewReplyAdded')

            A new reply added to your discussion
                <strong>
                    {{ $notification->data['discussion']['title'] }}

                    </strong>
              <a href="{{ route('discussions.show',$notification->data['discussion']['slug']) }}" class="btn float-right btn-sm btn-info">
                View Discussion
            </a>
        @endif

        @if ($notification->type == 'LaravelForum\Notifications\ReplyMarkedAsBestReply')
             Your Reply to the discussion
              <strong>
                  {{ $notification->data['discussion']['title'] }}
                 </strong> was marked as best reply
                 <a href="{{ route('discussions.show',$notification->data['discussion']['slug']) }}" class="btn float-right btn-sm btn-info">
                    View Discussion
                </a>
        @endif

        </li>


        @endforeach
        {{ $notifications->links() }}
      </ul>






    </div>
</div>
@endsection
