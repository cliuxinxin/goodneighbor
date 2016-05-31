@extends('app')


@section('content')

    <h1>高清电影</h1>

    @if(count($gaoqings))

        <table class="table table-striped">
            <thead>
            <tr>
                <th>名字</th>
                <th>下载网址</th>
                <th>更新时间</th>
                <th>是否下载</th>
             </tr>
            </thead>
            <tbody>
            @foreach($gaoqings as $gaoqing)
                <tr>
                    <td><a href="{{ $gaoqing->comment }}">{{ $gaoqing->detail }}</a></td>
                    <td><a href="{{ $gaoqing->url }}">磁力下载</a></td>
                    <td>{{ $gaoqing->created_at }}</td>
                    @if( $gaoqing->isSeenBy(Auth::user()))
                        <td><a href={{ url('topics/unseen').'/'.$gaoqing->id }} class="btn btn-danger">取消标记</a></td>
                    @else
                        <td><a href={{ url('topics/seen').'/'.$gaoqing->id }} class="btn btn-success">标记下载</a></td>
                    @endif
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $gaoqings->links()  }}
    @endif

@endsection