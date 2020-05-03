<?php

namespace App\Services;
use App\Services\ScoreTotals;
use App\Services\ParTotals;



class AdvancedStats{
    
    public static function storeFinalScore($listOfScorecards)
    {
        foreach($listOfScorecards as $scorecard)
        {
            #Assign a Final Score to each scorecard
            $scorecard->final_score = ScoreTotals::scoreTotal($scorecard) - ParTotals::parTotal($scorecard); 
        }
    }
    
    public static function bestScore9Holes($listOfScorecards)
    {
        #grab all nine hole scorecards
        $nineHoleScorecards = $listOfScorecards->filter(function ($item) {  
            return $item->hole_ten == null;
        });

        #find the lowest score a user got playing nine holes
        $bestNineHoleScore = $nineHoleScorecards->min('final_score');
        
        return $bestNineHoleScore;
    }

    public static function bestScore18Holes($listOfScorecards)
    {
        #grab all eighteen hole scorecards
        $eighteenHoleScorecards = $listOfScorecards->filter(function ($scorecard) {
            return $scorecard->hole_ten != null;
        });

        #find the lowest score a user got playing eighteen holes
        $bestEighteenHoleScore  = $eighteenHoleScorecards->min('final_score');
        
        return $bestEighteenHoleScore;
    }

    public static function favouriteCourse($listOfScorecards)
    {
        $coursesPlayed = [];

        #create a array that lists all of the courses a user plays
        foreach($listOfScorecards as $scorecard){
            array_push($coursesPlayed, $scorecard->course->course_name);
        }

        #find the course that shows up the most often in the array
        $favouritecourse = collect($coursesPlayed)->mode();

        # if the array has multiple values then the user has multiple courses with the same amount of games played
        # should I return all of the courses? If so ill have to change the front end
        return $favouritecourse[0];
    }


    public static function totalNumberOfStrokes($listOfScorecards)
    {
        $numberOfStrokes = 0;

        foreach($listOfScorecards as $scorecard)
        {
            $numberOfStrokes += ScoreTotals::scoreTotal($scorecard); 
        }        
        
        return $numberOfStrokes; 
    }

    public static function NumberOfTimesaPlayerScoredaSpecificScore($listOfScorecards , $value)
    {
        /*  This function determines how many times a golfer scored a specific score
            For Example if you pass the value 0. This means you want the total number of times a golfer scored par.
            If you pass -1 you want all of the birdies etc. 
        */ 
        $count = 0;

        foreach($listOfScorecards as $scorecard)
        {
            # if the score a user got for the given hole equals the passed value add one to the count
            $scorecard->hole_one - $scorecard->course->par_hole_one == $value ? $count++ : 0;
            $scorecard->hole_two - $scorecard->course->par_hole_two == $value ? $count++ : 0;
            $scorecard->hole_three - $scorecard->course->par_hole_three == $value ? $count++ : 0; 
            $scorecard->hole_three - $scorecard->course->par_hole_three == $value ? $count++ : 0;
            $scorecard->hole_four - $scorecard->course->par_hole_four == $value ? $count++ : 0;
            $scorecard->hole_five - $scorecard->course->par_hole_five == $value ? $count++ : 0;
            $scorecard->hole_six - $scorecard->course->par_hole_six == $value ? $count++ : 0;
            $scorecard->hole_seven - $scorecard->course->par_hole_seven == $value ? $count++ : 0;
            $scorecard->hole_eight - $scorecard->course->par_hole_eight == $value ? $count++ : 0;
            $scorecard->hole_nine - $scorecard->course->par_hole_nine == $value ? $count++ : 0;
            $scorecard->hole_ten - $scorecard->course->par_hole_ten == $value ? $count++ : 0;
            $scorecard->hole_eleven - $scorecard->course->par_hole_eleven == $value ? $count++ : 0;
            $scorecard->hole_twelve - $scorecard->course->par_hole_twelve == $value ? $count++ : 0;
            $scorecard->hole_thirteen - $scorecard->course->par_hole_thirteen == $value ? $count++ : 0;
            $scorecard->hole_fourteen - $scorecard->course->par_hole_fourteen == $value ? $count++ : 0;
            $scorecard->hole_fifteen - $scorecard->course->par_hole_fifteen == $value ? $count++ : 0;
            $scorecard->hole_sixteen - $scorecard->course->par_hole_sixteen == $value ? $count++ : 0;
            $scorecard->hole_seventeen - $scorecard->course->par_hole_seventeen == $value ? $count++ : 0;
            $scorecard->hole_eighteen - $scorecard->course->par_hole_eighteen  == $value ? $count++ : 0;
        }

        return $count;
    }


    public static function HoleinOnes($listOfScorecards)
    {
         $numberofholeinones = 0;

         foreach($listOfScorecards as $scorecard)
         {
            $strokesTakenOnEachHole[] = (new self)->ScorecardArray($scorecard); 

            foreach($strokesTakenOnEachHole as $numberOfStrokes)
            {
                if($numberOfStrokes == 1) 
                {
                    $numberofholeinones++;
                }
            }
        }
        return $numberofholeinones;
    }


    public static function averageScore($listOfScorecards)
    {
        $numberofpar3s = $numberofpar4s = $numberofpar5s = 0;
        $par3scores = $par4scores = $par5scores = [];
        
        foreach($listOfScorecards as $scorecard)
        {
            $courseArray = (new self)->courseArray($scorecard);
            $scorecardArray = (new self)->ScorecardArray($scorecard);

            $x = 0;
            foreach($courseArray as $par)
            {
                if($par == 3) 
                {
                    $numberofpar3s++;
                    array_push($par3scores,$scorecardArray[$x]);
                }
                elseif($par == 4)
                {
                    $numberofpar4s++;
                    array_push($par4scores,$scorecardArray[$x]);
                }
                elseif($par == 5)
                {
                    $numberofpar5s++;
                    array_push($par5scores, $scorecardArray[$x]);
                }
                $x++;
            }
        }

        $par3avg = empty($par3scores) ? 0 : round(array_sum($par3scores)/count($par3scores),2);
        $par4avg = empty($par4scores) ? 0 : round(array_sum($par4scores)/count($par4scores),2);
        $par5avg = empty($par5scores) ? 0 : round(array_sum($par5scores)/count($par5scores),2);

        return [$par3avg, $par4avg, $par5avg];
    }

    
    private function courseArray($scorecard){
        $course = $scorecard->course;
        return [ 
            $course->par_hole_one, $course->par_hole_two, $course->par_hole_three,
            $course->par_hole_four, $course->par_hole_five, $course->par_hole_six, 
            $course->par_hole_seven, $course->par_hole_eight, $course->par_hole_nine,
            $course->par_hole_ten, $course->par_hole_eleven, $course->par_hole_twelve,
             $course->par_hole_thirteen, $course->par_hole_fourteen, $course->par_hole_fifteen,
            $course->par_hole_sixteen, $course->par_hole_seventeen, $course->par_hole_eighteen
        ];
    }

    private static function ScorecardArray($scorecard){
        return [
            $scorecard->hole_one, $scorecard->hole_two, $scorecard->hole_three,
            $scorecard->hole_four, $scorecard->hole_five, $scorecard->hole_six, 
            $scorecard->hole_seven, $scorecard->hole_eight, $scorecard->hole_nine,
            $scorecard->hole_ten, $scorecard->hole_eleven, $scorecard->hole_twelve,
            $scorecard->hole_thirteen, $scorecard->hole_fourteen, $scorecard->hole_fifteen,
            $scorecard->hole_sixteen, $scorecard->hole_seventeen, $scorecard->hole_eighteen
        ];
    }


   
    
}
?>