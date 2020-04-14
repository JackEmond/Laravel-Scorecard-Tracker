<?php
namespace App\Services;
use App\Services\ScoreTotals;


class Handicap{
    
    public static function calculateHandicap($listOfScorecards)
    {
        //Advanced stats are: Best Score 18 holes, Best Score 9 Holes, Han dicap 
        //This code also shows finalscore on the homepage

       //Initialize 
       $nineHoleDifferentials = $eighteenHoleDifferentials = array();
       $totaldifferentials = 0;

       $arraySize = count($listOfScorecards);
       for($i=0; $totaldifferentials<=20 && $i< $arraySize; $i++)
       {
        if($listOfScorecards[$i]->hole_ten == null) //If its a 9 hole score
        {
            $nineHoleDifferentials[] = (113/$listOfScorecards[$i]->tee->slope) * ($listOfScorecards[$i]->final_score - $listOfScorecards[$i]->tee->rating);
        }
        else //its an eighteen hole score
        {
            $eighteenHoleDifferentials[] = (113/$listOfScorecards[$i]->tee->slope) * ($listOfScorecards[$i]->final_score - $listOfScorecards[$i]->tee->rating);
        }
        $totaldifferentials = count($nineHoleDifferentials) / 2 + count($eighteenHoleDifferentials);
       }

        // To calculate your 9 hole handicap you combine two nine hole handicaps and make them a 18 hole handicap
        for($i = 0; $i+1<count($nineHoleDifferentials); $i+=2)
        {
            array_push($eighteenHoleDifferentials, $nineHoleDifferentials[$i] + $nineHoleDifferentials[$i+1]);
        }
        //based on usga handicapping rules calulate your handicap
        $handicap = (new self)->yourHandicap($eighteenHoleDifferentials);
       
       return $handicap;
    }


    private function yourHandicap($yourDifferentials)
    {
        #USGA Rules of Handicapping
        # https://www.usga.org/handicapping/roh/2020-rules-of-handicapping.html
        # Games played determine how many games are taken into account for your handicap and any adjustments needed.
        # 3 games played take the lowest differential and remove 2.
        # 20 games played take your lowest 8 differentials dont remove anything etc
        $countOfDifferentials = count($yourDifferentials);
        if($countOfDifferentials < 3)
        {
            $gamesRemaining = 3 - $countOfDifferentials;
            return 'Play '. strval($gamesRemaining) .' more game(s)';
        }
        elseif($countOfDifferentials == 3 )
        {
            $handicap = min($yourDifferentials) - 2;
        }
        elseif($countOfDifferentials == 4)
        {
            $handicap = min($yourDifferentials) - 1;
        }
        elseif($countOfDifferentials == 5)
        {
            $handicap = min($yourDifferentials);
        }
        elseif($countOfDifferentials  == 6)
        {
            $handicap = $this->determineHandicap($yourDifferentials, 2, -1);
        }
        elseif($countOfDifferentials  == 7 or $countOfDifferentials == 8)
        {
            $handicap = $this->determineHandicap($yourDifferentials, 2);
        }
        elseif($countOfDifferentials  >= 9 && $countOfDifferentials <= 11)
        {
            $handicap = $this->determineHandicap($yourDifferentials, 3);

        }
        elseif($countOfDifferentials  >= 12 && $countOfDifferentials <= 14)
        {
            $handicap = $this->determineHandicap($yourDifferentials, 4);

        }
        elseif($countOfDifferentials  == 15 && $countOfDifferentials == 16)
        {
            $handicap = $this->determineHandicap($yourDifferentials, 5);

        }
        elseif($countOfDifferentials  == 17 && $countOfDifferentials == 18)
        {
            $handicap = $this->determineHandicap($yourDifferentials, 6);

        }
        elseif($countOfDifferentials  == 19)
        {
            $handicap = $this->determineHandicap($yourDifferentials, 7);

        }
        elseif($countOfDifferentials  == 20)
        {
            $handicap = $this->determineHandicap($yourDifferentials, 8);

        }
        elseif($countOfDifferentials  > 20)
        {
            return "error";
        }
        return round($handicap, 1);
    }

    private function determineHandicap($arrayofDifferentials, $numberOfDifferentials, $adjustments = 0)
    {
        // using a unsorted array of differentials determine the users handicap

        // $arrayofDifferentials is all of the golf scores a user has played (up to most recent 20 games)
        // adjusted by course rating and slope
        // $numberOfDifferentials is how many differentials will be taken into account for your handicap (number is determined by the USGA)
        // e.g of the last 20 games you played grab the 3 best games
        // $adjustments is depending on how many games played you have your handicap is dropped by 0, 1 or 2 strokes
        sort($arrayofDifferentials);
        return array_sum(array_slice($arrayofDifferentials, 0, $numberOfDifferentials))/$numberOfDifferentials - $adjustments;
    }
}
?>