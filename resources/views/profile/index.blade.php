@extends('app')

@section('content')
    <div class="container">
            {{--<div class="col-md-5 pull-right" >--}}
                {{--<a href="#">Edit Profile</A>--}}
            {{--</div>--}}

            <div class="panel panel-info">

                <div class="panel-heading">
                    <h3 class="panel-title">{{ Auth::user()->name }}</h3>
                </div>

                <div class="panel-body">
                    <div class="row">
                        {{--<div class="col-md-3 col-lg-3 " align="center"> <img alt="User Pic" src="http://babyinfoforyou.com/wp-content/uploads/2014/10/avatar-300x300.png" class="img-circle img-responsive"> </div>--}}

                        <div class=" col-md-9 col-lg-9 ">
                            <table class="table table-user-information">
                                <tbody>
                                <tr>
                                    <td>小区:</td>
                                    <td>
                                        @if($profile->garden)
                                        {{ $profile->garden->name }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>房号：</td>
                                    <td>{{ $profile->room }}</td>
                                </tr>
                                <tr>
                                    <td>手机：</td>
                                    <td>{{ $profile->phone }}</td>
                                </tr>

                                </tbody>
                            </table>

                            <a href={{ url('profile/edit').'/'.Auth::user()->id  }} class="btn btn-primary pull-right">修改</a>
                            {{--<a href="#" class="btn btn-primary">Team Sales Performance</a>--}}
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    {{--<a data-original-title="Broadcast Message" data-toggle="tooltip" type="button" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-envelope"></i></a>--}}
                    {{--<span class="pull-right">--}}
                        {{--<a href="edit.html" data-original-title="Edit this user" data-toggle="tooltip" type="button" class="btn btn-sm btn-warning"><i class="glyphicon glyphicon-edit"></i></a>--}}
                        {{--<a data-original-title="Remove this user" data-toggle="tooltip" type="button" class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-remove"></i></a>--}}
                    {{--</span>--}}
                </div>

            </div>
    </div>

@endsection


