<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Handicap;
use App\Scorecard;
use App\Services\AdvancedStats;
use App\Services\AdvancedStatsCharts;
use DB;


class AdvancedStatsController extends Controller
{
    public function index()
    {  

        $listOfScorecards = Scorecard::latest('date_played')->paginate(10);
        
        count($listOfScorecards) == 0 ? abort(404) : "";

        AdvancedStats::storeFinalScore($listOfScorecards);

        return view('advancedstats.index', [

            'handicap' =>               Handicap::calculateHandicap($listOfScorecards),
            
            'bestscore9holes' =>        AdvancedStats::bestScore9Holes($listOfScorecards),
            'bestscore18holes'=>        AdvancedStats::bestScore18Holes($listOfScorecards),
            'favouritecourse' =>        AdvancedStats::favouriteCourse($listOfScorecards),
            'totalnumberofstrokes'=>    AdvancedStats::TotalNumberOfStrokes($listOfScorecards),
            'totalnumberofpars' =>      AdvancedStats::NumberOfTimesaPlayerScoredaSpecificScore($listOfScorecards, 0),
            'totalnumberofbirdies' =>   AdvancedStats::NumberOfTimesaPlayerScoredaSpecificScore($listOfScorecards, -1),
            'totalnumberofeagles' =>    AdvancedStats::NumberOfTimesaPlayerScoredaSpecificScore($listOfScorecards, -2),
            'numberofHoleinOnes' =>     AdvancedStats::HoleinOnes($listOfScorecards),
            'avgscore'=>                AdvancedStats::averageScore($listOfScorecards),

            'eighteenHoleChart' =>      AdvancedStatsCharts::ScoreProgress($listOfScorecards, 18),
            'nineHoleChart' =>          AdvancedStatsCharts::ScoreProgress($listOfScorecards, 9),
            'handicapChart'   =>        AdvancedStatsCharts::handicapChart($listOfScorecards)  
        ]);

    }
}
