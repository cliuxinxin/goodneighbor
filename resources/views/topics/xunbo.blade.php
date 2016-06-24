@extends('app')

@section('header')
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.10.1/bootstrap-table.min.css">
@endsection


@section('content')

    <h1>迅播美剧</h1>

    @if(count($xunbolists))

        <table class="table table-striped" data-toggle="table" data-search="true" data-pagination="true">
            <thead>
            <tr>
                <th>名字</th>
                <th>是否跟剧</th>
            </tr>
            </thead>
            <tbody>
            @foreach($xunbolists as $xunbolist)
                <tr>
                    <td><a href={{ $xunbolist->url }}>{{ $xunbolist->detail }}</a></td>
                    @if( $xunbolist->isSeenBy(Auth::user()))
                        <td><a href={{ url('topics/unseen').'/'.$xunbolist->id }} class="btn btn-danger">取消标记</a></td>
                    @else
                        <td><a href={{ url('topics/seen').'/'.$xunbolist->id }} class="btn btn-success">标记跟剧</a></td>
                    @endif
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif


@endsection

@section('footer')
        <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.10.1/bootstrap-table.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.10.1/locale/bootstrap-table-zh-CN.min.js"></script>
@endsection