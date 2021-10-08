@extends('layouts.app')

@section('content')


    <div class="card">
        @include('partials.discussion-header')


        <div class="card-body">


            <div class="text-center">
                <strong>
                    {{ $discussion->title }}

                </strong>
            </div>
            <hr>

            {!! $discussion->content !!}

            @if ($discussion->bestReply)

            <div class="card bg-success my-5" style="color: white">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <div>
                            <img width="40px" height="40px" style="border-radius:50%" src="{{ Gravatar::src($discussion->bestreply->owner->email) }}" alt="">

                            <strong>
                                {{ $discussion->bestreply->owner->name }}
                            </strong>
                        </div>
                        <div>
                            <strong>
                                Best Reply
                            </strong>
                        </div>

                    </div>
                </div>
                <div class="card-body">
                    {!! $discussion->bestReply->content !!}
                </div>
            </div>

            @endif


        </div>


    </div>
    @if (session('success'))
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
@endif


@foreach ($discussion->replies()->paginate(3) as $reply )
<div class="card my-5">
    <div class="card-header">
        <div class="d-flex justify-content-between">
            <div>
                <img width="40px" height="40px" style="border-radius: 50%" src="{{ Gravatar::src($reply->owner->email) }}" alt="">
                <span>{{ $reply->owner->name }}</span>

            </div>

            <div>

               @auth

               @if (auth()->user()->id == $discussion->user_id)




               <form action="{{ route('discussions.best-reply', ['discussion' => $discussion->slug, 'reply' => $reply->id]) }}" method="POST">
                   @csrf

                   <button type="submit" class  ="btn btn-sm btn-primary">Mark as best reply</button>

               </form>

                   @endif
               @endauth

            </div>

        </div>


    </div>
    <div class="card-body">
        {!! $reply->content !!}


    </div>
</div>



@endforeach
{{ $discussion->replies()->paginate(3)->links() }}


    <div class="card my-5">
        @include('partials.errors')
        <div class="card-header">
            Add A Reply
        </div>


    <div class="card-body">
        @auth
        <form action="{{ route('replies.store',$discussion->slug) }}" method="POST">
            @csrf
            <input type="hidden" name="content" id="content">
            <trix-editor input="content"></trix-editor>
            <button type="submit" class="btn btn-success btn-sm my-2">Leave A Reply</button>


        </form>

        @else
        <a href="{{ route('login') }}" class="btn btn-info"> Sign in to add a reply</a>
    @endauth

        </div>
    </div>






@endsection

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.0.0/trix.css">

@endsection

@section('scripts')
<script src=" 	https://cdnjs.cloudflare.com/ajax/libs/trix/1.0.0/trix.js"></script>
@endsection
