@extends('app')

@section('content')
<div class="container">
    <div class="page-header">
        <h1 id="timeline">我的故事</h1>
    </div>
    <ul class="timeline">
        @foreach($timelines as $key=>$timeline)

            @if($key%2 == 0)
                <li class="timeline-inverted">
            @else
                <li>
            @endif
            @if($timeline->type == '注册获得积分')
                    <div class="timeline-badge danger"><i class="glyphicon glyphicon-credit-card"></i></div>
                    <div class="timeline-panel">
                        <div class="timeline-heading">
                            <h4 class="timeline-title">注册获得积分</h4>
                            <p><small class="text-muted"><i class="glyphicon glyphicon-time"></i>{{ $timeline->time->diffForHumans() }}</small></p>
                        </div>
                        <div class="timeline-body">
                            <p>注册获得了积分：{{ $timeline->action }}</a></p></p>
                        </div>
                    </div>
            @endif

            @if($timeline->type == '注册')
                    <div class="timeline-badge"><i class="glyphicon glyphicon-credit-card"></i></div>
                    <div class="timeline-panel">
                        <div class="timeline-heading">
                            <h4 class="timeline-title">注册</h4>
                            <p><small class="text-muted"><i class="glyphicon glyphicon-time"></i>{{ $timeline->time->diffForHumans() }}</small></p>
                        </div>
                        <div class="timeline-body">
                            <p>您注册了账号。</p>
                        </div>
                    </div>
            @endif

            @if($timeline->type == '发布求助')
                    <div class="timeline-badge info"><i class="glyphicon glyphicon-floppy-disk"></i></div>
                    <div class="timeline-panel">
                        <div class="timeline-heading">
                            <h4 class="timeline-title">发布求助</h4>
                            <p><small class="text-muted"><i class="glyphicon glyphicon-time"></i>{{ $timeline->time->diffForHumans() }}</small></p>
                        </div>
                        <div class="timeline-body">
                            <p>发布了求助：<a href="{{ url('tasks').'/'.$timeline->task->id }}">{{ $timeline->task->content }}</a></p>
                        </div>
                    </div>
            @endif

            @if($timeline->type == '提供帮助')
                    <div class="timeline-badge success"><i class="glyphicon glyphicon-thumbs-up"></i></div>
                    <div class="timeline-panel">
                        <div class="timeline-heading">
                            <h4 class="timeline-title">提供帮助</h4>
                            <p><small class="text-muted"><i class="glyphicon glyphicon-time"></i>{{ $timeline->time->diffForHumans() }}</small></p>
                        </div>
                        <div class="timeline-body">
                            <p>提供了帮助：<a href="{{ url('tasks').'/'.$timeline->task->id }}">{{ $timeline->task->content }}</a></p>
                        </div>
                    </div>
            @endif

            @if($timeline->type == '评论')
                    <div class="timeline-badge warning"><i class="glyphicon glyphicon-credit-card"></i></div>
                    <div class="timeline-panel">
                        <div class="timeline-heading">
                            <h4 class="timeline-title">评论</h4>
                            <p><small class="text-muted"><i class="glyphicon glyphicon-time"></i>{{ $timeline->time->diffForHumans() }}</small></p>
                        </div>
                        <div class="timeline-body">
                            <p>评论了：<a href="{{ url('tasks').'/'.$timeline->task->id }}">{{ $timeline->task->content }}</a></p>
                            <p>评论内容：{{ $timeline->action }}</a></p>
                        </div>
                    </div>
            @endif

            @if($timeline->type == '其他人评论')
                    <div class="timeline-badge warning"><i class="glyphicon glyphicon-credit-card"></i></div>
                    <div class="timeline-panel">
                        <div class="timeline-heading">
                            <h4 class="timeline-title">有人评论</h4>
                            <p><small class="text-muted"><i class="glyphicon glyphicon-time"></i>{{ $timeline->time->diffForHumans() }}</small></p>
                        </div>
                        <div class="timeline-body">
                            <p>有人评论了：<a href="{{ url('tasks').'/'.$timeline->task->id }}">{{ $timeline->task->content }}</a></p>
                            <p>评论内容：{{ $timeline->action }}</p>
                        </div>
                    </div>
            @endif

            @if($timeline->type == '帮助获得积分')
                    <div class="timeline-badge danger"><i class="glyphicon glyphicon-credit-card"></i></div>
                    <div class="timeline-panel">
                        <div class="timeline-heading">
                            <h4 class="timeline-title">获得积分</h4>
                            <p><small class="text-muted"><i class="glyphicon glyphicon-time"></i>{{ $timeline->time->diffForHumans() }}</small></p>
                        </div>
                        <div class="timeline-body">
                            <p>多亏您的帮助：<a href="{{ url('tasks').'/'.$timeline->task->id }}">{{ $timeline->task->content }}</a></p>
                            <p>获得积分：{{ $timeline->action }}</p>
                        </div>
                    </div>
            @endif

            @if($timeline->type == '求助花费积分')
                    <div class="timeline-badge danger"><i class="glyphicon glyphicon-credit-card"></i></div>
                    <div class="timeline-panel">
                        <div class="timeline-heading">
                            <h4 class="timeline-title">花费积分</h4>
                            <p><small class="text-muted"><i class="glyphicon glyphicon-time"></i>{{ $timeline->time->diffForHumans() }}</small></p>
                        </div>
                        <div class="timeline-body">
                            <p>您的需求：<a href="{{ url('tasks').'/'.$timeline->task->id }}">{{ $timeline->task->content }}</a></p>
                            <p>花费积分：{{ $timeline->action }}</p>
                        </div>
                    </div>
            @endif
            </li>


        @endforeach

@endsection