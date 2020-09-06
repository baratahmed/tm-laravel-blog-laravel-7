@extends('layouts.app')

@section('title')
Posts
@endsection


@section('content')
<div class="text-center">
    
    <h1 >{{$post->title}}</h1>

    <img src="/storage/cover_images/{{$post->cover_image}}" width="50%" alt="">
    <br><br>       
    
    <p class="lead">
        {!!$post->body!!}
    </p>
    <hr>
    <small>Written on {{$post->created_at->format('d/m/Y')}} by {{$post->user->name}}</small>
    <br><br>
    <a href="/posts" class="btn btn-info">Go Back</a>
    @if (!Auth::guest())
        {{-- @if (auth()->user()->id == $post->user->id) --}}
        {{-- @if (auth()->user()->id == $post->user_id) --}}        
        @if (Auth::user()->id == $post->user_id)
        <a href="{{route('posts.edit',['post'=>$post->id])}}" class="btn btn-primary">Edit</a>
        <a href="" class="btn btn-danger" onclick="event.preventDefault();
            document.getElementById('delete-post').submit();">Delete</a>
        <form id="delete-post" action="{{ route('posts.destroy',$post->id)}}" method="POST">
            <input name="_method" type="hidden" value="DELETE">
            {{ csrf_field() }}        
        </form>
        @endif
    @endif
    
</div>
    
@endsection