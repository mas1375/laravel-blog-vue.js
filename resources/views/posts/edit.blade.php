@extends('layouts.app')

@section('content')
    <h1> Edit Post</h1>
     {!! Form::open(['action' => ['PostController@update' , $post->id] , 'method' => 'POST' ,  'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {!! Form::label('title', 'title') !!}
            {!! Form::text('title', $post->title , ['class' => 'form-control' , 'placeholder' => 'title']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('body' , 'body' ) !!}
            {!! Form::textarea('body' , $post->body ,  ['id'=> 'article-ckeditor' ,'class' => 'form-control' , 'placeholder' => 'body']) !!}
        </div>
        {{ Form::hidden('_method' , 'PUT') }}
        <div class="form-group">
                {{ Form::file('cover_image') }}
            </div>
        {!! Form::submit('Submit', ['class'=> 'btn border border-primary']) !!}
    {!! Form::close() !!}
@endsection
