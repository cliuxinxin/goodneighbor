<div class="well well-lg col-md-12">

    <p class="label label-success">分值:{{ $task->point->points }}</p>
    <a class="label label-info" href="{{ url('tasks').'/'.$task->id }}">评论数：{{ count($task->comments) }}</a>
    <p class="label label-info">小区:{{ $task->sender->profile->garden?$task->sender->profile->garden->name:'无' }}</p>
    <p class="text-primary text-left lead">
        <a href="{{ url('tasks').'/'.$task->id }}">{{ $task->content }}</a>
    </p>



    <div class="row">
        <div class="stepwizard">
            <div class="stepwizard-row">
                <div class="stepwizard-step">
                    @if($task->isNotReceived() && (Auth::check()?$task->isSendByUser(Auth::user()):0))
                        <button type="button" class="btn btn-primary btn-circle" disabled="disabled">创建</button>
                    @else
                        <button type="button" class="btn btn-default btn-circle" disabled="disabled">创建</button>
                    @endif
                    <p>{{ $task->created_at->diffForHumans() }}由{{ $task->sender->name }}创建</p>
                    @if(Auth::check() && $task->isCanDelete(Auth::user()))
                        <p>{!! Form::open(['method' => 'DELETE','url' => ['tasks',$task->id]]) !!}
                            {!! Form::submit('删除',['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}</p>
                    @endif
                </div>
                <div class="stepwizard-step">
                    @if((Auth::check()?$task->notSendByUser(Auth::user()):1) && $task->isNotConfirmed())
                        <button type="button" class="btn btn-primary btn-circle" disabled="disabled">认领</button>
                    @else
                        <button type="button" class="btn btn-default btn-circle" disabled="disabled">认领</button>
                    @endif
                    @if($task->isProcessing())
                        <p>{{ $task->receiver->name }}认领</p>
                    @endif
                    @if($task->isNotReceived() && (Auth::guest() || $task->notSendByUser(Auth::user())))
                        <p><a class="btn btn-danger" href="{{ url('tasks/take').'/'.$task->id }}">我要帮忙</a></p>
                    @endif
                    @if(Auth::check() && $task->isReceivedByUser(Auth::user()))
                        <p><a class="btn btn-info">手机号码：{{ $task->sender->profile->phone?$task->sender->profile->phone:'没留下电话号码' }}</a></p>
                    @endif
                </div>
                <div class="stepwizard-step">
                    @if($task->isProcessing() && (Auth::check()?$task->isSendByUser(Auth::user()):0))
                        <button type="button" class="btn btn-primary btn-circle" disabled="disabled">确认</button>
                    @else
                        <button type="button" class="btn btn-default btn-circle" disabled="disabled">确认</button>
                    @endif
                    @if(Auth::check() && $task->isCanRemove(Auth::user()))
                        <p><a class="btn btn-danger" href="{{ url('tasks/remove').'/'.$task->id }}">取消{{ $task->receiver->name }}的帮助</a></p>
                    @endif
                    @if(Auth::check() && $task->isCanConfirm(Auth::user()))
                        <p><a class="btn btn-danger" href="{{ url('tasks/confirm').'/'.$task->id }}">确认完成</a></p>
                    @endif


                </div>
                <div class="stepwizard-step">
                    @if($task->isConfirmed())
                        <button type="button" class="btn btn-success btn-circle" disabled="disabled">完成</button>
                    @else
                        <button type="button" class="btn btn-default btn-circle" disabled="disabled">完成</button>
                    @endif
                    @if($task->isConfirmed())
                        <p>{{ $task->receiver->name }} 帮的忙</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>