
@extends('layout')

@section('content')

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8">
</script>
    <h1> Advanced Stats </h1>

    <section class="advancedstats">
    <fieldset>
        <legend>Best Score 9 Holes</legend>
        <h3>{{$bestscore9holes == null ? "No 9 Hole Games Played" : $bestscore9holes}}</h3>
    </fieldset>

    <fieldset>
        <legend>Handicap</legend>
        <h3>{{ $handicap }}</h3>
    </fieldset>

    <fieldset>
        <legend>Best Score 18 Holes</legend>
        <h3>{{$bestscore18holes == null ? "No 18 Hole Games Played" : $bestscore18holes}}</h3>
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
        <h3>{{ $totalnumberofpars }}</h3>
    </fieldset>

    <fieldset>
            <legend>Total # of Birdies</legend>
            <h3>{{ $totalnumberofbirdies }}</h3>
        </fieldset>
    
        <fieldset>
            <legend>Total # of Eagles</legend>
            <h3>{{ $totalnumberofeagles }}</h3>
        </fieldset>
    
        <fieldset>
            <legend>Total # of Hole in Ones</legend>
            <h3>{{ $numberofHoleinOnes }}</h3>
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
            <legend>Average Par 5 Score</legend>
            <h3>{{ $avgscore[2] }}</h3>
        </fieldset>
        
        @if ($nineHoleChart->container()->chart->labels != [])
            <div style=" height: 250px;" >
                {!! $nineHoleChart->container() !!}
                <h3>9 Hole Score Progress</h3>
            </div>
        @endif

        @if ($eighteenHoleChart->container()->chart->labels != [])
            <div style="height: 250px;" >
                {!! $eighteenHoleChart->container() !!}
                <h3>18 Hole Score Progress</h3>
            </div>
        @endif

        @if ($handicapChart->container()->chart->labels != [])
        <div style="height: 250px;" >
            {!! $handicapChart->container() !!}
            <h3>Handicap Progress</h3>
        </div>
        @endif

        {!! $nineHoleChart->script() !!}
        {!! $handicapChart->script() !!}
        {!! $eighteenHoleChart->script() !!}

        </section>

@endsection
