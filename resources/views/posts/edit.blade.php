@extends('layouts.app')

@section('title')
Edit Post
@endsection


@section('content')
<h1 class="text-center">Edit Post</h1>

<form action="{{route('posts.update',['post'=>$post->id])}}"  method="POST" enctype="multipart/form-data">
  @method('patch')
  @csrf
  <div class="form-group">
    <label for="title">Post Title</label>
    <input type="text" class="form-control" name="title" id="title" value="{{$post->title}}">
  </div>
  <div class="form-group">
    <label for="body">Description</label>
    <textarea class="form-control" id="editor1" name="body" rows="5" placeholder="Body Text">{{$post->body}}</textarea>
  </div>
  <div class="form-group">
    <input type="file" name="cover_image">
  </div>
  <button type="submit" class="btn btn-primary mt-2">Update</button>
</form>

{{-- {!!Form::open(['action'=>'PostController@store','method'=>'post'])!!}
<div class="form-group">
  {{Form::label('title','Title')}}
  {{Form::text('title','$post->title',['class'=>'form-control','placeholder'=>'Enter Post Title Here...'])}}
</div>

<div class="form-group">
  {{Form::label('body','Body')}}
  {{Form::textarea('body','$post->body',['id'=>'editor1','class'=>'form-control','placeholder'=>'Body text Here...'])}}
</div>

{{Form::submit('Submit',['class'=>'btn btn-primary mt-2'])}}

{!!Form::close()!!} --}}




@endsection