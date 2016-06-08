@extends('app')


@section('content')

    <h1>管理界面</h1>



    <div class="alert alert-success">
        用户人数：<strong>{{ $users_count }}</strong>
    </div>

    <a class="btn btn-lg btn-default" href="{{ url('admin/gardens') }}">小区浏览</a>

    @if(count($event_records))
    <h2>登录情况</h2>

    <table class="table table-striped">
        <thead>
        <tr>
            <th>用户</th>
            <th>登录时间</th>
        </tr>
        </thead>
        <tbody>
        @foreach($event_records as $event_record)
        <tr>
            <td>{{ $event_record->user->name }}</td>
            <td>{{ $event_record->created_at }}</td>
        </tr>
        @endforeach
        </tbody>
    </table>
    {{ $event_records->links()  }}
    @endif

@endsection