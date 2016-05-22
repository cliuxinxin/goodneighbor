@extends('app')

@section('content')

    <div class="container">
        @include('partial.createTask')
        @foreach($tasks as $task)
            <div class="row">
                    <div class="well well-lg col-md-12">

                        <p class="label label-success lead">分值:{{ $task->point->points }}</p>
                        <p class="text-primary text-left lead">
                            <a href="{{ url('tasks').'/'.$task->id }}">{{ $task->content }}</a></p>

                        <div class="row">

                            <div class="col-md-1">

                                @if($task->isProcessing())
                                    <div class="btn btn-success">{{ $task->receiver->name }} 正在帮忙</div>
                                @endif

                                @if($task->isConfirmed())
                                    <div class="btn btn-info">{{ $task->receiver->name }} 帮的忙</div>
                                @endif

                            </div>


                            <div class="col-md-1 col-md-offset-1">
                                <div class="btn btn-info">{{ $task->created_at->diffForHumans() }}</div>
                            </div>

                            <div class="col-md-1">
                                <div class="btn btn-info">求助人：{{ $task->sender->name }}</div>
                            </div>

                            <div class="col-md-1 col-md-offset-1">

                                @if($task->isNotReceived() && (Auth::guest() || $task->notSendByUser(Auth::user())))
                                    <a class="btn btn-success" href="{{ url('tasks/take').'/'.$task->id }}">我要帮忙</a>
                                @endif

                                @if(Auth::check() && $task->isCanDelete(Auth::user()))
                                    {!! Form::open(['method' => 'DELETE','url' => ['tasks',$task->id]]) !!}
                                    {!! Form::submit('删除',['class' => 'btn btn-danger']) !!}
                                    {!! Form::close() !!}
                                @endif

                                @if(Auth::check() && $task->isCanConfirm(Auth::user()))
                                    <a class="btn btn-warning" href="{{ url('tasks/confirm').'/'.$task->id }}">确认完成</a>
                                @endif

                                @if($task->isConfirmed())
                                    <div class="btn btn-info">已完成</div>
                                @endif

                            </div>

                            <div class="col-md-1">
                                @if(Auth::check() && $task->isCanRemove(Auth::user()))
                                    <a class="btn btn-warning" href="{{ url('tasks/remove').'/'.$task->id }}">取消{{ $task->receiver->name }}的帮助</a>
                                @endif
                            </div>

                            <div class="col-md-1">
                                @if(Auth::check() && $task->isReceivedByUser(Auth::user()))
                                    <a class="btn btn-info">手机号码：{{ $task->sender->profile->phone?$task->sender->profile->phone:'没留下电话号码' }}</a>
                                @endif
                            </div>




                        </div>

                    </div>
            </div>

        @endforeach
    </div>
@endsection


