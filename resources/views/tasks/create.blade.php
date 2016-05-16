@extends('app')

@section('content')
    <div class="container">
        <h1>发布需求</h1>

        <hr>

        {!! Form::open(['url' => 'tasks']) !!}

        <div class="form-group">
            {!! Form::label('content','需求:') !!}
            {!! Form::textarea('content',null,['class' => 'form-control','placeholder' => '为方便人家帮助，请在70个字以内。']) !!}
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
    </div>

@endsection


