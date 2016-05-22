@extends('app')

@section('header')
    <link rel="stylesheet" href=" {{ url('css/libs/select2.min.css') }}">
{{--    <link rel="stylesheet" href=" {{ url('css/libs/select2.min.css') }}">--}}
@endsection

@section('content')
    <div class="container">

            <div class="panel panel-info">

                <div class="panel-heading">
                    <h3 class="panel-title">{{ Auth::user()->name }}</h3>
                </div>

                <div class="panel-body">
                    <div class="row">
                        {{--<div class="col-md-3 col-lg-3 " align="center"> <img alt="User Pic" src="http://babyinfoforyou.com/wp-content/uploads/2014/10/avatar-300x300.png" class="img-circle img-responsive"> </div>--}}
{{--                        {!! Form::open(['method' => 'PATCH','action' => ['ProfilesContorller@update',$$profile->id]]) !!}--}}
                        {!! Form::open(['method'=>'PATCH','url'=>['/profile',$profile->id]]) !!}


                        <div class="form-group">
                            {!!  Form::label('garden','小区：') !!}
                            {!!  Form::select('garden_id',$gardens,$profile->garden_id?$profile->garden->id:'',['id' => 'garden_id','class' => 'form-control']) !!}
                        </div>

                        <div class="form-group">
                            {!!  Form::label('room','房号：') !!}
                            {!!  Form::text('room',$profile->room,['class' => 'form-control']) !!}
                        </div>

                        <div class="form-group">
                            {!!  Form::label('phone','手机：') !!}
                            {!!  Form::text('phone',$profile->phone,['class' => 'form-control']) !!}
                        </div>

                        @if($profile->isGetBonus())
                        <div class="form-group">
                            {!!  Form::label('bonus_code','邀请码：') !!}
                            {!!  Form::text('bonus_code','',['class' => 'form-control']) !!}
                        </div>
                        @endif


                        <div class="col-md-2 pull-right">
                            {!! Form::submit('完成',['class' => 'btn btn-primary form-control']) !!}
                        </div>


                        {!! Form::close() !!}


                        {{--<a href="#" class="btn btn-primary">Team Sales Performance</a>--}}
                    </div>
                </div>

                <div class="panel-footer">
                    {{--<a data-original-title="Broadcast Message" data-toggle="tooltip" type="button" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-envelope"></i></a>--}}
                    {{--<span class="pull-right">--}}
                        {{--<a href="edit.html" data-original-title="Edit this user" data-toggle="tooltip" type="button" class="btn btn-sm btn-warning"><i class="glyphicon glyphicon-edit"></i></a>--}}
                        {{--<a data-original-title="Remove this user" data-toggle="tooltip" type="button" class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-remove"></i></a>--}}
                    {{--</span>--}}
                </div>

            </div>
    </div>

@endsection


@section('footer')
    <script src="{{ url('js/libs/select2.min.js') }}"></script>
    <script>
        $('#garden_id').select2();
    </script>

@endsection

