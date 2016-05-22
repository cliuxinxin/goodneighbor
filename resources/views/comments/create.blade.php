<div class="row">
    <div class="col-sm-13">
        <div class="panel panel-white post panel-shadow">
            {!! Form::open(['url' => ['/comments',$task->id]]) !!}
            <div class="form-group">
                {!! Form::textarea('content',null,['class' => 'form-control','rows' => 3 ,'placeholder' => '评论内容']) !!}
            </div>

            <div class="row">
                <div class="col-md-2 col-md-offset-10">
                    <div class="form-group">
                        {!! Form::submit('评论',['class' => 'btn btn-primary form-control']) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>