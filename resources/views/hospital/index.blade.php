@extends('app')

@section('content')
    @if(count($topics))
        <h1>招标信息</h1>

        <table class="table table-striped">
            <thead>
            <tr>
                <th>内容</th>
                <th>招标来源</th>
                <th>标记</th>
            </tr>
            </thead>
            <tbody>
            @foreach($topics as $topic)
                <tr>
                    <td><a href="{{ $topic->url }}">{{ $topic->detail }}</a></td>
                    <td>{{ $topic->type }}.{{ $topic->comment }}</td>
                    @if( $topic->isSeenBy(Auth::user()))
                        <td><a href={{ url('topics/unseen').'/'.$topic->id }} class="btn btn-danger">取消标记</a></td>
                    @else
                        <td><a href={{ url('topics/seen').'/'.$topic->id }} class="btn btn-success">标记已读</a></td>
                    @endif
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $topics->links()  }}
    @endif
@endsection



