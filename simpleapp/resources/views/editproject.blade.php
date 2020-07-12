@extends('layout')

@section('title')
    Edit Project
@endsection

@section('content')

    <form method="POST" action="/projects/{{$project->id}}"  style="margin-bottom:1em">

        @method("PATCH")
        @csrf

        <h1> Edit Project  {{$project->title}} </h1>

        <div>
            <input type="text" name="title" placeholder="project title"  value="{{$project->title}}">
        </div>

        <div>
            <textarea name="description" placeholder="project description" ">{{$project->description}} </textarea>
        </div>

        <div>
            <button type="submit">Save</button>


        </div>




    </form>
    <div>
        <form method="POST" action="/projects/{{$project->id}}">
{{--            {{ method_field('DELETE')}}--}}
{{--            {{csrf_field()}}--}}

            @method('DELETE')
            @csrf
            <button type="submit">Delete</button>
        </form>
    </div>


@endsection