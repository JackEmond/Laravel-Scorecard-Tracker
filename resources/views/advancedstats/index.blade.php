
@extends('layout')

@section('content')


    <h1> Advanced Stats </h1>
<section class="advancedstats">
    <fieldset>
        <legend>Best Score 9 Holes</legend>
        <h3>{{ $bestscore9holes}}</h3>
    </fieldset>

    <fieldset>
        <legend>Handicap</legend>
        <h3>{{ $handicap }}</h3>
    </fieldset>

    <fieldset>
        <legend>Best Score 18 Holes</legend>
        <h3>{{ $bestscore18holes }}</h3>
    </fieldset>
    
    <fieldset>
        <legend>Favourite Course</legend>
    <h3>{{ $favouritecourse }}</h3>
    </fieldset>

    <fieldset>
        <legend>Total # of Strokes</legend>
        <h3>{{ $totalnumberofstrokes }}</h3>
    </fieldset>

    <fieldset>
        <legend>Total # of Pars</legend>
        <h3>{{ $parsbirdieseagles[0] }}</h3>
    </fieldset>

    <fieldset>
            <legend>Total # of Birdies</legend>
            <h3>{{ $parsbirdieseagles[1] }}</h3>
        </fieldset>
    
        <fieldset>
            <legend>Total # of Eagles</legend>
            <h3>{{ $parsbirdieseagles[2] }}</h3>
        </fieldset>
    
        <fieldset>
            <legend>Total # of Hole in Ones</legend>
            <h3>{{ $avgscore[3] }}</h3>
        </fieldset>
        
        <fieldset>
            <legend>Average Par 3 Score</legend>
            <h3>{{ $avgscore[0] }}</h3>
        </fieldset>

        <fieldset>
            <legend>Average Par 4 Score</legend>
            <h3>{{ $avgscore[1] }}</h3>
        </fieldset>

        <fieldset>
            <legend>Average Par 3 Score</legend>
            <h3>{{ $avgscore[2] }}</h3>
        </fieldset>
        
</section>


@endsection
