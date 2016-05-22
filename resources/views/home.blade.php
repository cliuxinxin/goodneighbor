@extends('app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    You are logged in!
                </div>

                <div id="SOHUCS"></div>
                <script charset="utf-8" type="text/javascript" src="http://changyan.sohu.com/upload/changyan.js" ></script>
                <script type="text/javascript">
                    window.changyan.api.config({
                        appid: 'cysp41fVv',
                        conf: 'prod_520375b8dd087f472ba42fad245e98b2'
                    });
                </script>
            </div>
        </div>
    </div>
</div>
@endsection
