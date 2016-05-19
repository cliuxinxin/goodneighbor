@extends('app')

@section('content')
    <div class="container">
        <h1>{{ Auth::user()->name }}的档案</h1>

        {!! Form::model('profile') !!}

        <div class="form-group">
            {!! Form::label('garden','小区'!!}
            {!! Form::text('garden',,null,['class' => 'form-control']!!}
        </div>

        <div class="form-group">
            {!! Form::label('room','房号'!!}
            {!! Form::text('room',null,['class' => 'form-control']!!}
        </div>

        <div class="form-group">
            {!! Form::label('phone','手机'!!}
            {!! Form::text('phone',null,['class' => 'form-control']!!}
        </div>


        {!! Form::close !!}}


    </div>

@endsection


