@extends('layouts.app')

@section('content')
    <h1> Create new Post</h1>
     {!! Form::open(['action' => 'PostController@store' , 'method' => 'POST' , 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {!! Form::label('title', 'title') !!}
            {!! Form::text('title', '' , ['class' => 'form-control' , 'placeholder' => 'title']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('body' , 'body' ) !!}
            {!! Form::textarea('body' , '' ,  ['id'=> 'article-ckeditor' ,'class' => 'form-control' , 'placeholder' => 'body']) !!}
        </div>
        <div class="form-group">
            {{ Form::file('cover_image') }}
        </div>
        {!! Form::submit('Submit', ['class'=> 'btn border border-primary']) !!}
    {!! Form::close() !!}
@endsection
