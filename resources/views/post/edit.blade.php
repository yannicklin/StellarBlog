@extends('layouts.default')

{{-- Web site Title --}}
@section('title')
    {{config('site.title')}}
@parent
@stop

{{-- page level styles --}}
@section('header_styles')
    <link href="{{ asset('assets/css/bootstrap-switch.min.css') }}" rel="stylesheet">
@stop

{{-- Content --}}
@section('content')<!-- Main content -->
<section class="container content">
    @if (Session::has('message'))
        <div class="alert alert-info">
            {{ Session::get('message') }}
        </div>
    @endif
    <form method="POST">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="id" value="{{ $post->id }}{{ old('id') }}">
        <div class="form-group">
            <label>ID: </label>
            <div style="display: inline-block;">{{ $post->id }}</div>
        </div>
        <div class="form-group">
            <label>Author: </label>
            <div style="display: inline-block;">{{ $post->author->name }}</div>
            <div class="form-group">
                <label>Active: </label>
                <input type="checkbox" name="checkbox-postactive" data-size="mini" style="display: inline-block;" readonly
                    @if($post->active)
                        checked
                    @endif
                >
            </div>
        </div>
        <div class="form-group">
            <label>Title: </label>
            <input required="required" placeholder="Enter title here" type="text" name = "title" class="form-control" value="@if(!old('title')){{$post->title}}@endif{{ old('title') }}"/>
        </div>
        <div class="form-group">
            <label>Body: </label>
            <textarea name='body'class="form-control">@if(!old('body')){!! $post->body !!}@endif{!! old('body') !!}
            </textarea>
        </div>

        <a class="btn btn-primary" href="/"><< Return</a>
        @if($post->active)
            <input type="submit" name='publish' class="btn btn-success" value = "Update"/>
        @else
            <input type="submit" name='publish' class="btn btn-success" value = "Publish"/>
        @endif
        <input type="submit" name='draftsaving' class="btn btn-default" value = "Save As Draft" />
        <a href="{{  url('post/'.$post->id.'/delete') }}" class="btn btn-danger">Delete</a>
    </form>
    </section>
@stop

{{-- footer scripts --}}
@section('footer_scripts')
    <script src="{{ asset('assets/js/bootstrap-switch.min.js') }}"></script>
    <script>
        $("[name='checkbox-postactive']").bootstrapSwitch();
    </script>
@stop