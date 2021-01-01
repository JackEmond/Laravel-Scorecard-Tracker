@extends('layout')

@section('content')

<!-- Stats -->
<div class="index-left">
    <div class="index-stats-box">
        <h3>Stats</h3>
        <div class="hcp">
            <p>{{ $handicap }}</p>
            <small>Handicap</small>
        </div>
        <div class="hcp">
            <p>{{$bestEighteenHoleScore  > 0 ? "+":""}}{{$bestEighteenHoleScore == null ? "No 9 Hole Games Played" : $bestEighteenHoleScore}}</p>
            <small>Best Score 18 Holes</small>
        </div>
        <div class="hcp">
            <p>{{$bestNineHoleScore > 0 ? "+":""}}{{$bestNineHoleScore == null ? "No 9 Hole Games Played" : $bestNineHoleScore}}</p>
            <small>Best Score 9 Holes</small>
        </div>
        <a class="link" href="advancedstats">More stats ... </a>
    </div>
</div>

<!-- Scores -->
<div class="index-right">
    <a class="link" href="holesplayed">Add a Scorecard . . .</a>
    <div class="flex-container test none">
        <div class="items">View</div>
        <div class="courseName">Course Name</div>
        <div class="items tees">Tees</div>
        <div class="items holes"># Holes</div>
        <div class="items">Score</div>  
    </div> 
    @foreach ($listOfScorecards as $scorecard)
        <div class="flex-container">
            <div class="items"><a href="/scorecards/{{$scorecard->id}}"><img class="icon" src="{{URL('/images/view.png')}}"></a></div>
            <div class="courseName">{{$scorecard->course->course_name}}</div>
            <div class="items tees">{{$scorecard->tee->colour}}</div>
            <div class="items holes"><img class="icon" src="{{URL('/images//'.$scorecard->course->number_of_holes.'holeflag.jpg')}}"></div>
            <div class="items">{{$scorecard->final_score > 0 ? "+":""}}{{ $scorecard->final_score}}</div>  
        </div>  
    @endforeach
    <!-- Pagination -->
    {{$listOfScorecards->links()}}
</div>

@endsection
