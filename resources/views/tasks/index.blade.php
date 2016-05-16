@extends('app')

@section('content')

    <div class="container">
        <h1>需求列表</h1>
        @foreach($tasks as $task)
            <div class="col-md-12">
                <div class="well well-lg col-md-12">
                    {{ $task->content }}
                </div>

                <div class="col-md-offset-10">
                    <div class="btn btn-info">{{ $task->sender->name }}</div>
                </div>

            </div>

        @endforeach
    </div>
@endsection
