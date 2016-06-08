@extends('app')


@section('content')

    <div class="alert alert-success">比特币价:<strong>{{ $bit_coin_price['buy']}}</strong></div>
    <div class="alert alert-info">上证指数:<strong>{{ $stock_price }}</strong></div>

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

    @if(count($meijus))

        <h1>迅播美剧</h1>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>名字</th>
                <th>说明</th>
                <th>更新时间</th>
                <th>是否处理</th>
            </tr>
            </thead>
            <tbody>
            @foreach($meijus as $meiju)
                <tr>
                    <td><a href="{{ $meiju->url }}">{{ $meiju->detail }}</a></td>
                    <td>{{ $meiju->comment }}</td>
                    <td>{{ $meiju->created_at }}</td>
                    @if( $meiju->isSeenBy(Auth::user()))
                        <td><a href={{ url('topics/unseen').'/'.$meiju->id }} class="btn btn-danger">取消标记</a></td>
                    @else
                        <td><a href={{ url('topics/seen').'/'.$meiju->id }} class="btn btn-success">标记处理</a></td>
                    @endif
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $meijus->links()  }}
    @endif

    @if(count($bangumis))

        <h1>动画番剧</h1>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>番剧</th>
                <th>剧集</th>
                <th>更新时间</th>
                <th>是否处理</th>
            </tr>
            </thead>
            <tbody>
            @foreach($bangumis as $bangumi)
                <tr>
                    <td>{{ $bangumi->comment }}</td>
                    <td>{{ $bangumi->detail }}</td>
                    <td>{{ $meiju->created_at }}</td>
                    @if( $meiju->isSeenBy(Auth::user()))
                        <td><a href={{ url('topics/unseen').'/'.$bangumi->id }} class="btn btn-danger">取消标记</a></td>
                    @else
                        <td><a href={{ url('topics/seen').'/'.$bangumi->id }} class="btn btn-success">标记处理</a></td>
                    @endif
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $bangumis->links()  }}
    @endif

@endsection