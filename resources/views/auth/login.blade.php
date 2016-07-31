@extends('layouts/default')

{{-- Page title --}}
@section('title')
    {{config('site.title')}}
    @parent
@stop

{{-- page level styles --}}
@section('header_styles')
@stop

@section('top')
@stop

{{-- content --}}
@section('content')
    <div class="container">
        <form method="POST" action="/auth/login">
            {!! csrf_field() !!}
            <div>
                Email
                <input type="email" name="email" value="{{ old('email') }}">
            </div>
            <div>
                Password
                <input type="password" name="password" id="password">
            </div>
            <div>
                <input type="checkbox" name="remember"> Remember Me
            </div>
            <div>
                <button type="submit">Login</button>
            </div>
        </form>
    </div>
    <!-- //Container End -->
@stop

{{-- footer scripts --}}
@section('footer_scripts')
@stop












