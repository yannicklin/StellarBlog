@extends('layouts.default')

{{-- Page title --}}
@section('title')
    {{config('site.title')}}
    @parent
@stop

{{-- page level styles --}}
@section('header_styles')
    <link href="{{ asset('assets/css/bootstrap-switch.min.css') }}" rel="stylesheet">
@stop

@section('top')
@stop

{{-- content --}}
@section('content')
    <div class="container">

        <h1>{{$post->title}}</h1>
        <h5>Author : {{$post->author->name}}</h5>
        <h5>Published : {{$post->published_at->format('M js Y g:ia')}}</h5>
        @if(\Auth::check())
            <h5>Active :　<input type="checkbox" name="checkbox-postactive" data-size="mini" readonly
                @if($post->active)
                    checked
                @endif
                ></h5>
        @endif
        <hr>
        {!! nl2br(e($post->body)) !!}
        <hr>
        <a class="btn btn-primary" href="/"><< Back</a>
        @if(\Auth::check())
            <a class="btn btn-info" href="/post/{{$post->id}}/edit">Edit</a>
            <a class="btn btn-danger" href="/post/{{$post->id}}/delete">Erase</a>
        @endif
    </div>
<!-- //Container End -->
@stop

{{-- footer scripts --}}
@section('footer_scripts')
    <script src="{{ asset('assets/js/bootstrap-switch.min.js') }}"></script>
    <script>
        $("[name='checkbox-postactive']").bootstrapSwitch();
    </script>
@stop
