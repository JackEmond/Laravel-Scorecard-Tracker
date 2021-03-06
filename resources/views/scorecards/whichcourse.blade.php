
@extends('layout')

@section('content')


<h2>Which Course did you play?</h2>
<a  class="link" href="/scorecards/Create_Scorecard/newCourse/{{ $numholes }}">New Course ... </a>

<!-- Search Bar -->
<div id="searchform">
    <form action="search" method="get" id="search">
        <label for="search">Search Courses:</label><input type="search" name="search" value="{{$search}}">
        <input type="hidden" name="numholes" value="{{$numholes}}">
        <button type="submit">Search</button>
    </form>
</div>

<p class="centerederror">{{$error}}</p>


<!-- List of Courses -->
@foreach ($listOfCourses as $course)
    <div class="flex-container whichcourse">
        <div class="view">
            <a href="/scorecards/Create_Scorecard/{{ $course ->id}}/{{ $numholes}}">
                <img class="icon" src="{{URL('/images/view.png')}}">
            </a>
        </div>
        <div class="courseName">{{$course->course_name}}</div>
    </div> 
@endforeach
<br>
<div class="clearfloat"></div>
{{$listOfCourses->links()}}

@endsection
