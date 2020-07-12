
@extends('layout')

@section('title')
These are some of the projects that i have done
@endsection

@section('content')

    <a href="/projects/create">Create a new project</a>
    @foreach($projects as $project)
        <li> <a href="/projects/{{$project->id}}">{{$project->title}}</a>
    @endforeach
    @endsection
