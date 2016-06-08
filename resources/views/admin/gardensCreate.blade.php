@extends('app')


@section('content')

    <h1>创建小区</h1>

    {!! Form::open(['url' => 'admin/gardens/create']) !!}

    <div class="form-group">
        {!! Form::label('city','城市:') !!}
        {!! Form::text('city',null,['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('name','小区名字:') !!}
        {!! Form::text('name',null,['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('price','价格:') !!}
        {!! Form::text('price',null,['class' => 'form-control']) !!}
    </div>

    <div class="row">
        <div class="col-md-2 col-md-offset-10">
            <div class="form-group">
                {!! Form::submit('添加小区',['class' => 'btn btn-primary form-control']) !!}
            </div>
        </div>
    </div>


    {!! Form::close() !!}
    @include('partial.error')




@endsection
