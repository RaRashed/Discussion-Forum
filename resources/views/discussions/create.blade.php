@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-header">Add Discussion</div>
@include('partials.errors')


    <div class="card-body">
        <form action="{{route('discussions.store')}}" method="POST">

            @csrf

            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" class="form-control">
            </div>

            <div class="form-group">
                <input id="content" type="hidden" name="content">
                    <trix-editor input="content"></trix-editor>

            </div>
            <div class="form-group">
                <label for="channel">Channel</label>

<select name="channel_id" id="channel" class="form-control">
    @foreach ($channels as $channel )
    <option value="{{ $channel->id }}" >{{ $channel->name }}</option>

    @endforeach
    </select>
    </div>
    <div class="form-group">

        <button type="submit" class="btn btn-success" >Add Discussion</button>
    </div>

        </form>


    </div>
</div>
@endsection

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.0.0/trix.css">

@endsection

@section('scripts')
<script src=" 	https://cdnjs.cloudflare.com/ajax/libs/trix/1.0.0/trix.js"></script>

@endsection
