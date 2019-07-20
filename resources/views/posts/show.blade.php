@extends('layouts.app')

@section('content')
    <a href="/posts" class="btn btn-default"> Go back </a>
    <h1> {{ $post->title }} </h1>
    @guest

    @elseif(Auth::user()->id == $post->user_id)
    <a href="/posts/{{ $post->id }}/edit" class="btn border border-success"> Edit </a>
    {!! Form::open( [ 'action' => ['PostController@destroy' , $post->id ] , 'method' => 'POST' , 'style' => 'float: right' ] ) !!}
        {{ Form::hidden('_method' , 'DELETE') }}
        {!! Form::submit('Delete', ['class'=> 'btn border border-danger']) !!}
    {!! Form::close() !!}

    @endguest
    <br><hr>
    <img style="width: 100%" src="/storage/cover_images/{{ $post->cover_image }}" alt="">
    <div>
        {!! $post->body !!}
    </div>
    <hr>
    <small> Written in  {{ $post->created_at }} {{$post->user->name }}</small>
    <hr>
@endsection
