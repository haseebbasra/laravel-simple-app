@extends('layout')

{{--can also be done this way--}}
{{--@section('title')--}}
{{--    Home--}}
{{--@endsection--}}


@section('title','Skills')


@section('content')

    <h1> This is my skills page </h1>

    <h3> These are some of the works that {{$name}} who is an {{$degree}} do daily at {{$location}}</h3>

    <h4> Lets print the variables passed from routes in traditional php way</h4>
    <?php
    foreach($tasks as $task) : ?>
    <li> <?= $task ?></li>

    <?php endforeach; ?>


    <h4> Lets print the variables in the blade syntax</h4>

    <ul>
        @foreach($tasks as $task)
            <li> <?= $task ?> </li>
            <li> {{$task }}</li>
        @endforeach
    </ul>
@endsection