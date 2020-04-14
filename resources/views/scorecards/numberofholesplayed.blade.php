@extends('layout')

@section('content')

<h2>How many holes did you play?</h2>
<div class="holes-width">
    <div class="holes-box">
    <br>
        <h1>Nine Holes</h1>
        <a href="/scorecards/Select_a_Course/9">
        <img class="holes-img" src="{{URL('/images/golfbag.png')}}"/>
        </a>
    </div>
    <div class="holes-box right">
        <br>
        <h1>Eighteen Holes</h1>
        <a href="/scorecards/Select_a_Course/18">
            <img class="holes-img" src="{{URL('/images/golfcart.png')}}"/>
        </a>

    </div>
</div>    


@endsection