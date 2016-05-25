@if(count($points)>0)
    <div class="panel panel-default">
        <!-- Default panel contents -->
        <div class="panel-heading">{{ $titile }}</div>
        <!-- Table -->
        <table class="table">
            <thead>
            <th>来源</th>
            <th>积分</th>
            </thead>
            <tbody>
            @foreach($points as $point)
                <tr>
                    <td>
                        @if( $point->details )
                            {{ $point->details }}
                        @else
                            任务：<a href="{{ url('tasks').'/'.$point->task->id }}">{{ $point->task->content }}</a>
                        @endif
                    </td>
                    <td>{{ $point->points }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div>{{ $points->links() }}</div>
@endif