@extends('adminlte::master')

@section('title')Panel Administración @stop

@section('adminlte_css')
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/plugins/iCheck/square/blue.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/css/auth.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/login_style.css') }}">        
    @yield('css')
@stop

@section('body_class', 'login-page')

@section('body')
    <div class="login-box"> 
        <div class="login-box-body">
              <div class="login-logo">
    <a href="{{ url(config('adminlte.dashboard_url', 'home')) }}">{!! config('adminlte.logo', '<b>Admin</b>LTE') !!}</a>
              </div>
             <hr>   
            <p class="login-box-msg">{{ trans('adminlte::adminlte.login_message') }}</p>
            <form action="{{ url(config('adminlte.login_url', 'login')) }}" method="post">
                {!! csrf_field() !!}

                <div class="form-group has-feedback {{ $errors->has('username') ? 'has-error' : '' }}">
                    <input type="text" name="username" class="form-control" value="{{ old('username') }}"
                           placeholder="{{ trans('adminlte::adminlte.username') }}" autocomplete="off">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    @if ($errors->has('username'))
                        <span class="help-block">
                            <strong>{{ $errors->first('username') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group has-feedback {{ $errors->has('password') ? 'has-error' : '' }}">
                    <input type="password" name="password" class="form-control"
                           placeholder="{{ trans('adminlte::adminlte.password') }}">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="row">
                    {{-- <div class="col-xs-7">
                        <div class="checkbox icheck">
                            <label>
                                <input type="checkbox" name="remember"> {{ trans('adminlte::adminlte.remember_me') }}
                            </label>
                        </div>
                    </div> --}}
                    
                    <div class="col-xs-5 col-xs-offset-3 text-center">
                        <button type="submit"
                                class="btn btn-primary btn-block btn-flat">Ingresar</button>
                    </div>
                  
                </div>
            </form>
            <hr>
            <div class="auth-links text-center">
                Copyright. Derechos reservados 2018
            </div>
            {{-- <div class="auth-links">
                <a href="{{ url(config('adminlte.password_reset_url', 'password/reset')) }}"
                   class="text-center"
                >{{ trans('adminlte::adminlte.i_forgot_my_password') }}</a>
                <br>
                @if (config('adminlte.register_url', 'register'))
                    <a href="{{ url(config('adminlte.register_url', 'register')) }}"
                       class="text-center"
                    >{{ trans('adminlte::adminlte.register_a_new_membership') }}</a>
                @endif
            </div> --}}
        </div>
       
    </div>
@stop

@section('adminlte_js')
    <script src="{{ asset('vendor/adminlte/plugins/iCheck/icheck.min.js') }}"></script>
    <script>
        $(function () {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' // optional
            });
        });
    </script>
    @yield('js')
@stop
