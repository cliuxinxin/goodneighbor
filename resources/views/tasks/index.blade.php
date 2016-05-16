@extends('app')

@section('content')

    <div class="container">
        <h1>大家的需求</h1>
        @foreach($tasks as $task)
            <div class="row">
                    <div class="well well-lg col-md-12">
                        <p class="text-primary text-left lead">{{ $task->content }}</p>

                        <div class="row">
                            <div class="col-md-1 col-md-offset-9">
                                <div class="btn btn-primary">{{ $task->created_at->diffForHumans() }}</div>
                            </div>

                            <div class="col-md-1">
                                <div class="btn btn-info">{{ $task->sender->name }}</div>
                            </div>

                            <div class="col-md-1">
                                {!! Form::open(['method' => 'DELETE','url' => ['tasks',$task->id]])  !!}
                                    {!! Form::submit('删除',['class' => 'btn btn-danger']) !!}
                                {!! Form::close() !!}
                            </div>

                        </div>

                    </div>
            </div>

        @endforeach
    </div>
@endsection
