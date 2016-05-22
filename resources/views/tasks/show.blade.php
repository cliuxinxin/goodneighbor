@extends('app')

@section('content')

    <div class="container">
        @include('tasks.singleTask',['task' => $task])
        @include('comments.create')
        @foreach($task->comments as $comment )
            @include('comments.show',['comment' => $comment,'task' => $task])
        @endforeach
    </div>
@endsection


