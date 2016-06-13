@extends('app')


@section('content')

    <h1>迅播美剧</h1>

    @if(count($xunbolists))

        <table class="table table-striped">
            <thead>
            <tr>
                <th>名字</th>
                <th>是否跟剧</th>
            </tr>
            </thead>
            <tbody>
            @foreach($xunbolists as $xunbolist)
                <tr>
                    <td>{{ $xunbolist->detail }}</td>
                    @if( $xunbolist->isSeenBy(Auth::user()))
                        <td><a href={{ url('topics/unseen').'/'.$xunbolist->id }} class="btn btn-danger">取消标记</a></td>
                    @else
                        <td><a href={{ url('topics/seen').'/'.$xunbolist->id }} class="btn btn-success">标记跟剧</a></td>
                    @endif
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $xunbolists->links()  }}
    @endif


@endsection