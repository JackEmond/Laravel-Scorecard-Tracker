
@extends('layout')

@section('content')

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8">
</script>
    <h1> Advanced Stats </h1>

    <section class="advancedstats">
    <fieldset>
        <legend>Best Score 9 Holes</legend>
        @if($bestscore9holes == null)
            <h4>No 9 Hole Games Played</h4>
        @else
            <h3>{{$bestscore9holes}}</h3>
        @endif
    </fieldset>

    <fieldset>
        <legend>Handicap</legend>
        <h3>{{ $handicap }}</h3>
    </fieldset>

    <fieldset>
        <legend>Best Score 18 Holes</legend>
        @if($bestscore18holes == null)
            <h4>No 9 Hole Games Played</h4>
        @else
            <h3>{{$bestscore18holes}}</h3>
        @endif
    </fieldset>
    
    <fieldset>
        <legend>Favourite Course</legend>
    <h4>{{ $favouritecourse }}</h4>
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
        <fieldset style="height: 250px;">
            <legend>9 Hole Score Progress</legend>
            <div class="chart">
                {!! $nineHoleChart->container() !!}
            </div>
        </fieldset>   
        @endif

        @if ($eighteenHoleChart->container()->chart->labels != [])
        <fieldset style="height: 250px;">
            <legend>18 Hole Score Progress</legend>
            <div class="chart">
                {!! $eighteenHoleChart->container() !!}
            </div>
        </fieldset>   
        @endif

        @if ($handicapChart->container()->chart->labels != [])
        <fieldset style="height: 250px;">
            <legend>Handicap Progress</legend>
            <div class="chart">
                {!! $handicapChart->container() !!}
            </div>
        </fieldset>   
        @endif

        {!! $nineHoleChart->script() !!}
        {!! $handicapChart->script() !!}
        {!! $eighteenHoleChart->script() !!}

    </section>

@endsection
