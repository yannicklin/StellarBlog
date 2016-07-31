@extends('layouts.default')

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
        @if (Session::has('message'))
            <div class="alert alert-info">
                {{ Session::get('message') }}
            </div>
        @endif
        
        @if ( !$posts->count() )
            <h4 class="alert alert-danger">There is no post in this blog. Login and write a new post now!!!</h4>
        @else
        <h4> This is Page {{$posts->currentPage()}} of {{$posts->lastPage()}}</h4>
        <hr>
        <ul>
            @foreach($posts as $post)
                <li>
                    <a href="post/{{$post->slug}}"> {{$post->title}} </a>
                    <em> {{$post->author->name}} @ {{$post->published_at->format('M d Y g:ia')}} </em>
                    @if($post->active)
                        <span class="label label-success">Active</span>
                    @else
                        <span class="label label-default">Not Active</span>
                    @endif
                    <p>
                        {{$post->excerpt}}
                    </p>
                </li>
            @endforeach
        </ul>
        {!! $posts->render() !!}
        @endif
    </div>
    <!-- //Container End -->
@stop

{{-- footer scripts --}}
@section('footer_scripts')
@stop
