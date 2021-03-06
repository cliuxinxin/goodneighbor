@extends('app')

@section('content')
    <div class="container">

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

                                <tr>
                                    <td>邀请码：</td>
                                    <td>
                                        @if($profile->invite_code)
                                        {{ $profile->invite_code }}
                                        @else
                                            <a href={{ url('profile/invitecode').'/'.$profile->id }} class="btn btn-primary">获取验证码</a>
                                            @endif
                                    </td>
                                </tr>

                                <tr>
                                    <td>邀请人：</td>
                                    <td>
                                        @if(!$profile->notMyInviteCode($profile->bonus_code))
                                            请不要输入自己的邀请码
                                        @elseif($profile->bonus_code)
                                            {{ $profile->inviter($profile->bonus_code)->name }}
                                        @else
                                            还没有输入邀请码
                                        @endif
                                    </td>
                                </tr>

                                </tbody>
                            </table>

                            <a href={{ url('profile/edit').'/'.Auth::user()->id  }} class="btn btn-primary pull-right">修改</a>
                            {{--<a href="#" class="btn btn-primary">Team Sales Performance</a>--}}
                        </div>
                    </div>
                </div>


            </div>
    </div>

@endsection


