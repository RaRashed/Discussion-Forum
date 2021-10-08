@extends('layouts.app')

@section('content')


        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif




    @foreach ($discussions as $discussion )

    <div class="card mb-4">

        @include('partials.discussion-header')


        <div class="card-body">
            <div class="text-center">
                <strong>
                    {{ $discussion->title }}

                </strong>
            </div>


        </div>


    </div>



    @endforeach

    {{ $discussions->appends(['channel'=>request()->query('channel')])->links() }}



@endsection
