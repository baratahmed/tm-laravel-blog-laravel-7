@extends('layouts.app')

@section('title')
Home
@endsection

@section('content')
    <div class="jumbotron {{$textCenter}}" style="background: #dff8e1">
        <h1>{{$title}}</h1>
        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Sapiente provident ullam veniam! Cumque dolorum laudantium officia architecto tenetur nobis necessitatibus?</p>
        <p><a href="/login" class="btn btn-primary btn-lg" role="button">Login</a> <a href="/register" class="btn btn-success btn-lg" role="button">Register</a></p>
    </div>




@endsection