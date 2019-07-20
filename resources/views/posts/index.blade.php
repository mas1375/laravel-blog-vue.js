@extends('layouts.app')

@section('content')
    <h1> Posts </h1>

    @if (count($posts) > 0)
        @foreach ($posts as $item)
                <div class="card card-body bg-light">
                    <div class="row">
                        <div class="col-md-4 col-sm-4">
                        <img style="width: 100%" src="/storage/cover_images/{{ $item->cover_image }}" alt="">
                        </div>
                        <div class="col-md-8 col-sm-4">
                                <h3> <a href="/posts/{{$item->id}}"> {{ $item->title }} </a> </h3>
                                <small>
                                    Written on {{ $item->created_at }} by {{$item->user->name }}
                                </small>
                        </div>
                    </div>
                </div>
        @endforeach
                    {{ $posts->links() }}
        @else
        <p>oops!!! no Posts found !!</p>
    @endif
@endsection
