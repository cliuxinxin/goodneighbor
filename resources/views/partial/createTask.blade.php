    <div class="row">


        {!! Form::open(['url' => 'tasks']) !!}

        <div class="form-group">
            {!! Form::textarea('content',null,['class' => 'form-control','placeholder' => '为方便人家帮助，请在70个字以内。']) !!}
        </div>

        <div class="form-group">
            @if(Auth::check())
            {!! Form::label('points',"可用积分:".Auth::user()->havePoints()) !!}
            {!! Form::number('points',null,['class' => 'form-control']) !!}
                @endif
        </div>

        <div class="row">
            <div class="col-md-2 col-md-offset-10">
                <div class="form-group">
                    {!! Form::submit('发布需求',['class' => 'btn btn-primary form-control']) !!}
                </div>
            </div>
        </div>


        {!! Form::close() !!}
        @include('partial.error')
        <hr>
    </div>


