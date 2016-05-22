<div class="row">
    <div class="col-sm-13">
        <div class="panel panel-white post panel-shadow">
            <div class="post-heading">
                @if ($task->sender->id == $comment->user->id)
                    <div class="lead">{{ $comment->user->name }}<span class="badge">求助人</span></div>
                @else
                    <div class="lead">{{ $comment->user->name }}</div>
                @endif
                <div>
                    <h6 class="text-muted time"> {{$comment->created_at->diffForHumans()}} </h6>
                </div>
            </div>
            <div class="post-description">
                <p>{{$comment->content}}</p>
                {{--<div class="stats">--}}
                {{--<a href="#" class="btn btn-default stat-item">--}}
                {{--<i class="fa fa-thumbs-up icon"></i>2--}}
                {{--</a>--}}
                {{--<a href="#" class="btn btn-default stat-item">--}}
                {{--<i class="fa fa-thumbs-down icon"></i>12--}}
                {{--</a>--}}
                {{--</div>--}}
            </div>
        </div>
    </div>
</div>