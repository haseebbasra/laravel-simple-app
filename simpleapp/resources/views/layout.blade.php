<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<style type="text/css">

    .is-complete
    {
      text-decoration: line-through;
    }
</style>
    <title>@yield('title', 'My first site') </title>
</head>
<body>



<ul>
    <li> <a href="/home"> Home </a></li>
    <li> <a href="/contact"> Contact </a></li>
    <li> <a href="/about"> About </a></li>
    <li> <a href="/skills"> Skills</a></li>

    <li> <a href="/projects">Projects</a></li>
</ul>

@yield('content')

</body>
</html>
