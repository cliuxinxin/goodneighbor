@extends('app')

@section('content')

    <div class="container">
        <div class="row">
            @include('tasks.singleTask',['task' => $task])
        </div>
        @include('comments.create')
        {{ $comments->links()  }}
        @foreach($comments as $comment )
            @include('comments.show',['comment' => $comment,'task' => $task])
        @endforeach



    </div>


@endsection


