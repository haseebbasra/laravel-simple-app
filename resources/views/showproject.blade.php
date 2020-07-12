@extends('layout')

@section('title')
Here is the project
@endsection

@section('content')

<!-- policy code -->




<h1> {{$project->title}}</h1>

<h2>Description:  </h2>{{$project->description}}
<br>
<a href="/projects/{{$project->id}}/edit">Update</a></li>
<br><br>

@if($project->tasks->count())
    <h2> Tasks for this project</h2>
    <div>
        @foreach ($project->tasks as $task)

                <form method="POST" action="/tasks/{{$task->id}}">
                @method('PATCH')
                    @csrf
                    <label class='checkbox {{ $task->completed ? 'is-complete' : '' }}' for="checkbox">
                        <input type="checkbox" name="completed" onchange="this.form.submit()" {{ $task->completed ? 'checked' : '' }}>
                        {{$task->description}}
                    </label>

                </form>


        @endforeach
    </div>
@endif

    {{-- add new tasks --}}

    <form method="post"  action="/projects/{{$project->id}}/tasks">
        @csrf
        <br> <br>
        <label class="label" for="description"> Create New Task</label>
        <div class="control">
            <input type="text" name="description" placeholder="taskname" >

               <input type="submit" value="Add task">
        </div>
    </form>
@if( $errors->any())

    <div style="'background-color:red">
        @foreach($errors->all() as $error)
            {{$error}}
        @endforeach
    </div>

@endif


@endsection




