@extends('layout')

@section('title')
    Edit Project
@endsection

@section('content')

    <form method="POST" action="/projects">


        <h1> Create Project </h1>
        {{csrf_field()}}
        <div>
            <input type="text" name="title" placeholder="project title"  required value="{{old('title')}}">
        </div>

        <div>
            <textarea name="description" placeholder="project description" required >{{old('description')}} </textarea>
        </div>

        <div>
            <button type="submit">Save</button>
        </div>


        @if( $errors->any())

            <div style="'background-color:red">
               @foreach($errors->all() as $error)
                   {{$error}}
                   @endforeach
            </div>

            @endif

    </form>


@endsection