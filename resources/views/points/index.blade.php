@extends('app')

@section('content')
    <div class="container">
        <h1>{{ Auth::user()->name }}的积分</h1>

        <div class="alert alert-success lead" role="alert">您现有积分：<strong>{{ Auth::user()->havePoints() }}</strong></div>
        {{--<div class="panel panel-default well well-lg col-md-12 lead">--}}
            {{--您的积分有：{{ Auth::user()->havePoints() }}--}}
        {{--</div>--}}

        {{--<div class="panel panel-default">--}}
            {{--<!-- Default panel contents -->--}}
            {{--<div class="panel-heading">拥有积分</div>--}}
            {{--<!-- Table -->--}}
            {{--<table class="table">--}}
                {{--<thead>--}}
                {{--<th>积分</th>--}}
                {{--</thead>--}}
                {{--<tbody>--}}
                    {{--<tr>--}}
                        {{--<td>{{ Auth::user()->havePoints() }}</td>--}}
                    {{--</tr>--}}
                {{--</tbody>--}}
            {{--</table>--}}
        {{--</div>--}}

        <div class="panel panel-default">
            <!-- Default panel contents -->
            <div class="panel-heading">积分收入</div>
            <!-- Table -->
            <table class="table">
                <thead>
                    <th>积分收入</th>
                    <th>积分</th>
                </thead>
                <tbody>
                    @foreach($get_points as $get_point)
                        <tr>
                            <td>
                                @if( $get_point->details )
                                    {{ $get_point->details }}
                                    @else
                                    任务：<a href="{{ url('tasks').'/'.$get_point->task->id }}">{{ $get_point->task->content }}</a>
                                @endif
                                </td>
                            <td>{{ $get_point->points }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @if(count($spend_points)>0)
        <div class="panel panel-default">
            <!-- Default panel contents -->
            <div class="panel-heading">积分消费</div>
            <!-- Table -->
            <table class="table">
                <thead>
                <th>积分任务</th>
                <th>积分</th>
                </thead>
                <tbody>
                @foreach($spend_points as $spend_point)
                    <tr>
                        <td><a href="{{ url('tasks').'/'.$spend_point->task->id }}">{{ $spend_point->task->content }}</a></td>
                        <td>{{ $spend_point->points }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        @endif

        @if(count($unconfirm_get_points)>0)
            <div class="panel panel-default">
                <!-- Default panel contents -->
                <div class="panel-heading">未确认收入</div>
                <!-- Table -->
                <table class="table">
                    <thead>
                    <th>任务</th>
                    <th>积分</th>
                    </thead>
                    <tbody>
                    @foreach($unconfirm_get_points as $unconfirm_get_point)
                        <tr>
                            <td><a href="{{ url('tasks').'/'.$unconfirm_get_point->task->id }}">{{ $unconfirm_get_point->task->content }}</a></td>
                            <td>{{ $unconfirm_get_point->points }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endif

        @if(count($unconfirm_spend_points)>0)
            <div class="panel panel-default">
                <!-- Default panel contents -->
                <div class="panel-heading">未确认消费</div>
                <!-- Table -->
                <table class="table">
                    <thead>
                    <th>任务</th>
                    <th>积分</th>
                    </thead>
                    <tbody>
                    @foreach($unconfirm_spend_points as $unconfirm_spend_point)
                        <tr>
                            <td><a href="{{ url('tasks').'/'.$unconfirm_spend_point->task->id }}">{{ $unconfirm_spend_point->task->content }}</a></td>
                            <td>{{ $unconfirm_spend_point->points }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endif




    </div>

@endsection


