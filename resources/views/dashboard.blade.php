@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <a class="p-2 text-light btn btn-primary" href="/posts/create">Create Post</a>
                    <hr>
                    <table class="table table-condensed">
                            <tr>
                                <th>Title</th>
                                <th></th>
                                <th></th>
                            </tr>
                        @if (count($posts) > 0)
                            @foreach ($posts as $item)
                            <tr>
                            <td>{{ $item->title }}</td>
                            <td><a href="/posts/{{ $item->id }}/edit" class="btn border border-info">Edit</a></td>
                            <td>    {!! Form::open( [ 'action' => ['PostController@destroy' , $item->id ] , 'method' => 'POST' , 'style' => 'float: right' ] ) !!}
                                    {{ Form::hidden('_method' , 'DELETE') }}
                                    {!! Form::submit('Delete', ['class'=> 'btn border border-danger']) !!}
                                {!! Form::close() !!}</td>
                            </tr>
                        @endforeach
                     @endif
                        </table>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>
@endsection
