@extends('app')

@section('content')

    <div class="container">
        @include('partial.createTask')
        {{ $tasks->links()  }}
        @foreach($tasks as $task)
            <div class="row">
                @include('tasks.singleTask',['task' => $task])
            </div>

        @endforeach
    </div>
@endsection


