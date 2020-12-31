@extends('layout')

@section('content')

<h2>How many holes did you play?</h2>

<div class="holes-width">
    <a href="/scorecards/Select_a_Course/9">
        <div class="holes-box">
            <h1>Nine Holes</h1>
            <img class="holes-img" src="{{URL('/images/golfbag.png')}}"/>
        </div>
    </a>
    <a href="/scorecards/Select_a_Course/18">
        <div class="holes-box right">
            <h1>Eighteen Holes</h1>
            <img class="holes-img" src="{{URL('/images/golfcart.png')}}"/>
        </div>
    </a>
</div>    

@endsection