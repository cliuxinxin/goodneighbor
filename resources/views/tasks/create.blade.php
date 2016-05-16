@extends('app')

@section('content')
    <div class="container">
        <h1>发布需求</h1>

        <hr>

        {!! Form::open(['url' => 'tasks']) !!}

        <div class="form-group">
            {!! Form::label('content','需求:') !!}
            {!! Form::textarea('content',null,['class' => 'form-control','placeholder' => '写下你的需求，好邻居会帮助你。']) !!}
        </div>

        <div class="col-md-2 col-md-offset-10">
            <div class="form-group">
                {!! Form::submit('发布需求',['class' => 'btn btn-primary form-control']) !!}
            </div>
        </div>

        {!! Form::close() !!}
    </div>

@endsection
