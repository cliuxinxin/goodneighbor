    <div class="row">


        {!! Form::open(['url' => 'tasks']) !!}

        {{--<div :wordnum="wordnum">还可以输入字数：@{{wordnum}}</div>--}}
        <div class="form-group">
            {!! Form::textarea('content',null,['class' => 'form-control','placeholder' => '']) !!}
        </div>

        <div class="form-group">
            @if(Auth::check())
            {!! Form::label('points',"可用积分:".Auth::user()->havePoints()) !!}
            {!! Form::number('points',null,['class' => 'form-control']) !!}
            @endif
        </div>

        <div class="row">
            <div class="col-md-2 col-md-offset-10">
                <div class="form-group">
                    {!! Form::submit('发布需求',['class' => 'btn btn-primary form-control']) !!}
                </div>
            </div>
        </div>


        {!! Form::close() !!}
        @include('partial.error')
        <hr>
    </div>

    {{--@section('footer')--}}
        {{--<script src="{{ url('js/libs/vue.min.js') }}"></script>--}}

        {{--<script>--}}
            {{--new Vue({--}}
                {{--el:'body',--}}

                {{--data:{--}}
                    {{--'content':'',--}}
                    {{--'wordnum':0--}}
                {{--},--}}

                {{--computed:{--}}
                    {{--wordnum: function () {--}}
                        {{--return 70-this.content.length;--}}
                    {{--}--}}
                {{--}--}}

            {{--});--}}
        {{--</script>--}}
    {{--@endsection--}}


