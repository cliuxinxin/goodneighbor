@extends('app')

@section('content')

    <div class="row">
        <div class="col-lg-6">
            <div id="zouni" class="input-group">
                <input v-model="thing" type="text" class="form-control">
              <span class="input-group-btn">
                    <button v-on:click="newThing" class="btn btn-default" type="button">走你</button>
              </span>
            </div><!-- /input-group -->
        </div><!-- /.col-lg-6 -->
    </div><!-- /.row -->

@endsection

@section('footer')
    <script src="//cdn.bootcss.com/vue/2.0.0-rc.7/vue.js"></script>
    <script src="https://cdn.jsdelivr.net/vue.resource/1.0.3/vue-resource.min.js"></script>
    <script src={{ url('js/vue/app.js') }}></script>
@endsection

