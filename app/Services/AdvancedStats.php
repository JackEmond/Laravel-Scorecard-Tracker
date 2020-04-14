<?php

namespace App\Services;
use App\Services\ScoreTotals;
use App\Services\ParTotals;


class AdvancedStats{
    
    protected $scorecard;

    public static function calculateHandicap($listOfScorecards)
    {
       //Initialize Differentials
        $nineHoleDifferentials = $eighteenHoleDifferentials = array();
    }
    
    
    public static function storeFinalScore($listOfScorecards)
    {
        foreach($listOfScorecards as $scorecard)
        {
            $numberOfStrokes = ScoreTotals::scoreTotal($scorecard); 

            # show the finalscore on the homepage
            $finalscore = $numberOfStrokes - ParTotals::parTotal($scorecard); 
            $scorecard->final_score = $finalscore;
        }
    }
    
    public static function bestScore9Holes($listOfScorecards)
    {
       $bestNineHoleScore = 300;

       foreach($listOfScorecards as $scorecard)
       {
            if($scorecard->final_score < $bestNineHoleScore && $scorecard->hole_ten == null)
            {
                $bestNineHoleScore = $scorecard->final_score;
            }
       }
       return $bestNineHoleScore;
    }

    public static function bestScore18Holes($listOfScorecards)
    {
       $bestEighteenHoleScore = 300;

       foreach($listOfScorecards as $scorecard)
       {
            if($scorecard->final_score < $bestEighteenHoleScore && $scorecard->hole_ten != null)
            {
                $bestEighteenHoleScore = $scorecard->final_score;
            }
       }

       return $bestEighteenHoleScore;

    }

    public static function favouriteCourse($listOfScorecards)
    {

        #this can definitely be optimized. Fix it 
        $array= [];

       foreach($listOfScorecards as $scorecard)
        {
            array_push($array, $scorecard->course_id);
        }     
        #https://stackoverflow.com/questions/30626785/php-most-frequent-value-in-array   
        $values = array_count_values($array);
        arsort($values);
        $popular = array_slice(array_keys($values), 0, 5, true);
        
       return $listOfScorecards[0]->course->course_name;
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

    public static function ParsBirdiesEaglesHoleInOnes($listOfScorecards)
    {
      $array = [];

      foreach($listOfScorecards as $scorecard)
        {
            #instead of pusing to array create a new function
            $pars = $birdies = $holeinones = $eagles = $albatrosses = 0;

            array_push($array, $scorecard->hole_one - $scorecard->course->par_hole_one);
            array_push($array, $scorecard->hole_two - $scorecard->course->par_hole_two);
            array_push($array, $scorecard->hole_three - $scorecard->course->par_hole_three);
            array_push($array, $scorecard->hole_four - $scorecard->course->par_hole_four);
            array_push($array, $scorecard->hole_five - $scorecard->course->par_hole_five);
            array_push($array, $scorecard->hole_six - $scorecard->course->par_hole_six);
            array_push($array, $scorecard->hole_seven - $scorecard->course->par_hole_seven);
            array_push($array, $scorecard->hole_eight - $scorecard->course->par_hole_eight);
            array_push($array, $scorecard->hole_nine - $scorecard->course->par_hole_nine);
            if($scorecard->hole_ten != null)
            {
                array_push($array, $scorecard->hole_ten - $scorecard->course->par_hole_ten);
                array_push($array, $scorecard->hole_eleven - $scorecard->course->par_hole_eleven);
                array_push($array, $scorecard->hole_twelve - $scorecard->course->par_hole_twelve);
                array_push($array, $scorecard->hole_thirteen - $scorecard->course->par_hole_thirteen);
                array_push($array, $scorecard->hole_fourteen - $scorecard->course->par_hole_fourteen);
                array_push($array, $scorecard->hole_fifteen - $scorecard->course->par_hole_fifteen);
                array_push($array, $scorecard->hole_sixteen - $scorecard->course->par_hole_sixteen);
                array_push($array, $scorecard->hole_seventeen - $scorecard->course->par_hole_seventeen);
                array_push($array, $scorecard->hole_eighteen - $scorecard->course->par_hole_eighteen);
            }
        
        }
        foreach($array as $a)
        {
            if($a == 0)
            {
                $pars ++;
            }
            else if($a == -1)
            {
                $birdies ++;
            }
            else if($a == -2)
            {
                $eagles ++;
            }
        }
        return [$pars,$birdies,$eagles]; 
    }


    public static function averageScore($listOfScorecards)
    {
        $numberofpar3s = $numberofpar4s = $numberofpar5s = $numberofholeinones = 0;
        $par3scores = $par4scores = $par5scores = [];
        

        foreach($listOfScorecards as $scorecard)
        {
            $courseArray = [ 
                $scorecard->course->par_hole_one, $scorecard->course->par_hole_two, $scorecard->course->par_hole_three,
                $scorecard->course->par_hole_four, $scorecard->course->par_hole_five, $scorecard->course->par_hole_six, 
                $scorecard->course->par_hole_seven, $scorecard->course->par_hole_eight, $scorecard->course->par_hole_nine,
                $scorecard->course->par_hole_ten, $scorecard->course->par_hole_eleven, $scorecard->course->par_hole_twelve,
                $scorecard->course->par_hole_thirteen, $scorecard->course->par_hole_fourteen, $scorecard->course->par_hole_fifteen,
                $scorecard->course->par_hole_sixteen, $scorecard->course->par_hole_seventeen, $scorecard->course->par_hole_eighteen
                ];

            $scorecardArray =[
                $scorecard->hole_one, $scorecard->hole_two, $scorecard->hole_three,
                $scorecard->hole_four, $scorecard->hole_five, $scorecard->hole_six, 
                $scorecard->hole_seven, $scorecard->hole_eight, $scorecard->hole_nine,
                $scorecard->hole_ten, $scorecard->hole_eleven, $scorecard->hole_twelve,
                $scorecard->hole_thirteen, $scorecard->hole_fourteen, $scorecard->hole_fifteen,
                $scorecard->hole_sixteen, $scorecard->hole_seventeen, $scorecard->hole_eighteen
            ];

            ###################################
            # You Still need to bo back nine
            ##################################
            
            ####### How to get Hole in Ones #############
            # Option 1) make another foreach for scorecards?
            # Option 2) create a function that stores the coursefront9array etc
            # then create a function for hole in ones (likely this option)
            $x = 0;
            foreach($courseArray as $hole)
            {
                #instead of pusing to array create a new function
                if($hole == 3) #if par is 3
                {
                    $numberofpar3s++;
                    array_push($par3scores,$scorecardArray[$x]);
                }
                elseif($hole == 4)
                {
                    $numberofpar4s++;
                    array_push($par4scores,$scorecardArray[$x]);
                }
                elseif($hole == 5)
                {
                    $numberofpar5s++;
                    array_push($par5scores, $scorecardArray[$x]);
                }
                $x++;
            }
            foreach($scorecardArray as $scorecard)
            {
                #instead of pusing to array create a new function
                if($scorecard == 1) #if par is 3
                {
                    $numberofholeinones++;
                }
            }
        }

        $par3avg = empty($par3scores) ? 0 : round(array_sum($par3scores)/count($par3scores),2);
        $par4avg = empty($par4scores) ? 0 : round(array_sum($par4scores)/count($par4scores),2);
        $par5avg = empty($par5scores) ? 0 : round(array_sum($par5scores)/count($par5scores),2);
        return [$par3avg, $par4avg, $par5avg, $numberofholeinones];
    }
    
    public static function holeInOnes($listOfScorecards)
    {

    }
}
?>