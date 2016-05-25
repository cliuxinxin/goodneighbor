@extends('app')

@section('content')
    <div class="container">
        <h1>{{ Auth::user()->name }}的积分</h1>

        <div class="alert alert-success lead" role="alert">您现有积分：<strong>{{ Auth::user()->havePoints() }}</strong></div>

        @include('points.pointTable',['points'=>$get_points,'titile'=>'积分收入'])

        @include('points.pointTable',['points'=>$spend_points,'titile'=>'积分消费'])

        @include('points.pointTable',['points'=>$unconfirm_get_points,'titile'=>'未确认收入'])

        @include('points.pointTable',['points'=>$unconfirm_spend_points,'titile'=>'未确认消费'])

    </div>

@endsection


