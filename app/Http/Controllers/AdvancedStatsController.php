<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Handicap;
use App\Scorecard;
use App\Services\AdvancedStats;



class AdvancedStatsController extends Controller
{
    public function index()
    {

        $listOfScorecards = Scorecard::latest('date_played')->paginate(10);
        
        AdvancedStats::storeFinalScore($listOfScorecards);
        
        
        $avgscore = AdvancedStats::averageScore($listOfScorecards);
        $parsbirdieseagles =  AdvancedStats::ParsBirdiesEaglesHoleInOnes($listOfScorecards);
        
        return view('advancedstats.index', compact('parsbirdieseagles','avgscore'), [
            'handicap' => Handicap::calculateHandicap($listOfScorecards),
            'bestscore9holes' => AdvancedStats::bestScore9Holes($listOfScorecards),
            'bestscore18holes'=> AdvancedStats::bestScore18Holes($listOfScorecards),
            'favouritecourse' =>  AdvancedStats::favouriteCourse($listOfScorecards),
            'totalnumberofstrokes'=>AdvancedStats::TotalNumberOfStrokes($listOfScorecards)
        ], $parsbirdieseagles);
    }
}
