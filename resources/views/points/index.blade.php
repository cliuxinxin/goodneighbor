@extends('app')

@section('content')
    <div class="container">
        <h1>{{ Auth::user()->name }}的积分</h1>

        <div class="well well-lg col-md-12">
            您的积分有：{{ Auth::user()->havePoints() }}
        </div>

        <div class="panel panel-default">
            <!-- Default panel contents -->
            <div class="panel-heading">积分来源</div>
            <!-- Table -->
            <table class="table">
                <thead>
                    <th>积分来源</th>
                    <th>积分</th>
                </thead>
                <tbody>
                    @foreach($get_points as $get_point)
                        <tr>
                            <td>
                                @if( $get_point->details )
                                    {{ $get_point->details }}
                                    @else
                                    任务：{{ $get_point->task->content }}
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
            <div class="panel-heading">积分花费</div>
            <!-- Table -->
            <table class="table">
                <thead>
                <th>积分任务</th>
                <th>积分</th>
                </thead>
                <tbody>
                @foreach($spend_points as $spend_point)
                    <tr>
                        <td>{{ $spend_point->task->content }}</td>
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
                <div class="panel-heading">未确认积分</div>
                <!-- Table -->
                <table class="table">
                    <thead>
                    <th>积分任务</th>
                    <th>积分</th>
                    </thead>
                    <tbody>
                    @foreach($unconfirm_get_points as $unconfirm_get_point)
                        <tr>
                            <td>{{ $unconfirm_get_point->task->content }}</td>
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
                <div class="panel-heading">未确认花费积分</div>
                <!-- Table -->
                <table class="table">
                    <thead>
                    <th>积分任务</th>
                    <th>积分</th>
                    </thead>
                    <tbody>
                    @foreach($unconfirm_spend_points as $unconfirm_spend_point)
                        <tr>
                            <td>{{ $unconfirm_spend_point->task->content }}</td>
                            <td>{{ $unconfirm_spend_point->points }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endif




    </div>

@endsection


