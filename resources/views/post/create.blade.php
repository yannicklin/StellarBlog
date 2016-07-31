@extends('layouts.default')

{{-- Web site Title --}}
@section('title')
{{config('site.title')}}
@parent
@stop

{{-- Content --}}
@section('content')<!-- Main content -->
<section class="container content">
    @if (Session::has('message'))
        <div class="alert alert-info">
            {{ Session::get('message') }}
        </div>
    @endif
    <form method="post" action='/post'>
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="form-group">
            <label>Title: </label>
            <input required="required" placeholder="Enter title here" type="text" name = "title" class="form-control" value=""/>
        </div>
        <div class="form-group">
            <label>Body: </label>
            <textarea required="required" name='body'class="form-control" placeholder="Enter Post Body here"></textarea>
        </div>

        <input type="submit" name='publish' class="btn btn-success" value = "Publish"/>
        <input type="submit" name='save' class="btn btn-default" value = "Save As Draft" />
        <a class="btn btn-primary" href="/">Waive</a>
    </form>
</section>
@stop