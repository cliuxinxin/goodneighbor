
{{--<nav class="navbar navbar-default navbar-fixed-top">--}}
    {{--<div class="container">--}}
        {{--<div class="navbar-header">--}}
            {{--<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">--}}
                {{--<span class="sr-only">Toggle navigation</span>--}}
                {{--<span class="icon-bar"></span>--}}
                {{--<span class="icon-bar"></span>--}}
                {{--<span class="icon-bar"></span>--}}
            {{--</button>--}}
            {{--<a class="navbar-brand" href="{{ url('/') }}">好邻居</a>--}}

            {{--@if(Auth::check())--}}
                {{--<ul class="nav navbar-nav">--}}
                    {{--<li><a href="{{ url('/timelines').'/'.Auth::user()->id }}">我的故事</a></li>--}}
                    {{--<li><a href="{{ url('/points/user') }}">我的积分</a></li>--}}
                    {{--<li><a href="{{ url('/usertasks') }}">我的求助</a></li>--}}
                    {{--<li><a href="{{ url('/receivetasks') }}">我的帮忙</a></li>--}}
                    {{--<li><a href="{{ url('/profile'.'/'.Auth::user()->id) }}">我的档案</a></li>--}}
                {{--</ul>--}}
            {{--@endif--}}
        {{--</div>--}}
        {{--<div id="navbar" class="navbar-collapse collapse">--}}
            {{--<ul class="nav navbar-nav">--}}
                {{--<li><a href="#about">About</a></li>--}}
                {{--<li><a href="#contact">Contact</a></li>--}}
                {{--<li class="dropdown">--}}
                    {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>--}}
                    {{--<ul class="dropdown-menu">--}}
                        {{--<li><a href="#">Action</a></li>--}}
                        {{--<li><a href="#">Another action</a></li>--}}
                        {{--<li><a href="#">Something else here</a></li>--}}
                        {{--<li role="separator" class="divider"></li>--}}
                        {{--<li class="dropdown-header">Nav header</li>--}}
                        {{--<li><a href="#">Separated link</a></li>--}}
                        {{--<li><a href="#">One more separated link</a></li>--}}
                    {{--</ul>--}}
                {{--</li>--}}
            {{--</ul>--}}
            {{--<ul class="nav navbar-nav navbar-right">--}}
                {{--<li><a href="../navbar/">Default</a></li>--}}
                {{--<li><a href="../navbar-static-top/">Static top</a></li>--}}
                {{--<li class="active"><a href="./">Fixed top <span class="sr-only">(current)</span></a></li>--}}
            {{--</ul>--}}

            {{--<!-- Right Side Of Navbar -->--}}
            {{--<ul class="nav navbar-nav navbar-right">--}}
                {{--<!-- Authentication Links -->--}}
                {{--@if (Auth::guest())--}}
                    {{--<li><a href="{{ url('/login') }}">登录</a></li>--}}
                    {{--<li><a href="{{ url('/register') }}">注册</a></li>--}}
                {{--@else--}}
                    {{--<li class="dropdown">--}}
                        {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">--}}
                            {{--{{ Auth::user()->name }} <span class="caret"></span>--}}
                        {{--</a>--}}

                        {{--<ul class="dropdown-menu" role="menu">--}}
                            {{--<li><a href="{{ url('/logout') }}">登出</a></li>--}}
                        {{--</ul>--}}
                    {{--</li>--}}
                {{--@endif--}}
            {{--</ul>--}}
        {{--</div><!--/.nav-collapse -->--}}
    {{--</div>--}}
{{--</nav>--}}

<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container-fluid" id="navfluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigationbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ url('/') }}">好邻居</a>
        </div>
        <div class="collapse navbar-collapse" id="navigationbar">
            @if(Auth::check())
            <ul class="nav navbar-nav">
                {{--<li><a href="{{ url('/timelines').'/'.Auth::user()->id }}">我的故事</a></li>--}}
                {{--@if(Auth::user()->profile?(Auth::user()->profile->garden?1:0):0)--}}
                {{--<li><a href="{{ url('/gardentasks') }}">我的小区</a></li>--}}
                {{--@endif--}}
                {{--<li><a href="{{ url('/points/user') }}">我的积分</a></li>--}}
                {{--<li><a href="{{ url('/usertasks') }}">我的求助</a></li>--}}
                {{--<li><a href="{{ url('/receivetasks') }}">我的帮忙</a></li>--}}
                {{--<li><a href="{{ url('/profile'.'/'.Auth::user()->id) }}">我的档案</a></li>--}}
                <li><a href="{{ url('/topics/index') }}">我的关注</a></li>
            </ul>
            @endif

            <ul class="nav navbar-nav navbar-right">
            <!-- Authentication Links -->
            @if (Auth::guest())
                <li><a href="{{ url('/login') }}">登录</a></li>
                <li><a href="{{ url('/register') }}">注册</a></li>
            @else
                <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                    {{ Auth::user()->name }} <span class="caret"></span>
                </a>

                <ul class="dropdown-menu" role="menu">
                    @if(Auth::user()->profile?Auth::user()->isAdmin():0)
                        <li><a href="{{ url('/admin') }}">管理</a></li>
                    @endif
                    <li><a href="{{ url('/logout') }}">登出</a></li>
                </ul>
                 </li>
            @endif
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>