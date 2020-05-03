<?php
namespace App\Services;
use App\Services\ScoreTotals;
use DB; 

class Handicap{
    
    public static function calculateHandicap($listOfScorecards)
    {

        $differentials = (new self)->calculateDifferentials($listOfScorecards);
        $handicap = (new self)->yourHandicap($differentials);
       return $handicap;
    }

    public static function calculateDifferentials($listOfScorecards, $numberOfDiff = 20)
    {
        //Initialize 
        $nineHoleDifferentials = $eighteenHoleDifferentials = array();
        $arraySize = count($listOfScorecards);
        
        for($i=0; count($eighteenHoleDifferentials)<=$numberOfDiff && $i< $arraySize; $i++)
        {

            if($listOfScorecards[$i]->hole_ten == null) //If its a 9 hole score
            {
                $nineHoleDifferentials[] = (113/$listOfScorecards[$i]->tee->slope) * (ScoreTotals::scoreTotal($listOfScorecards[$i]) - $listOfScorecards[$i]->tee->rating);
                
                if(count($nineHoleDifferentials) == 2)
                {
                    array_push($eighteenHoleDifferentials, $nineHoleDifferentials[0] + $nineHoleDifferentials[1]);
                }
            }
            else //its an eighteen hole score
            {
                #$eighteenHoleDifferentials[] = (113/$listOfScorecards[$i]->tee->slope) * (ScoreTotals::scoreTotal($listOfScorecards[$i]) - $listOfScorecards[$i]->tee->rating);

                $b = ScoreTotals::scoreTotal($listOfScorecards[$i]); 
                
                $c = $listOfScorecards[$i]->tee->rating;
                #dd(DB::getQueryLog()); #I think the issue is your not inner joining the tee table
                

                $a = (113/$listOfScorecards[$i]->tee->slope); 

            }
           
        }

        return $eighteenHoleDifferentials;
    }

    public static function yourHandicap($yourDifferentials)
    {
        #USGA Rules of Handicapping
        # https://www.usga.org/handicapping/roh/2020-rules-of-handicapping.html
        # Games played determine how many games are taken into account for your handicap and any adjustments needed.
        # 3 games played take the lowest differential and remove 2.
        # 20 games played take your lowest 8 differentials dont remove anything etc
        $countOfDifferentials = count($yourDifferentials);

        #change to switch statement
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
            $handicap = (new self)->determineHandicap($yourDifferentials, 2, -1);
        }
        elseif($countOfDifferentials  == 7 or $countOfDifferentials == 8)
        {
            $handicap = (new self)->determineHandicap($yourDifferentials, 2);
        }
        elseif($countOfDifferentials  >= 9 && $countOfDifferentials <= 11)
        {
            $handicap = (new self)->determineHandicap($yourDifferentials, 3);

        }
        elseif($countOfDifferentials  >= 12 && $countOfDifferentials <= 14)
        {
            $handicap = (new self)->determineHandicap($yourDifferentials, 4);

        }
        elseif($countOfDifferentials  == 15 && $countOfDifferentials == 16)
        {
            $handicap = (new self)->determineHandicap($yourDifferentials, 5);

        }
        elseif($countOfDifferentials  == 17 && $countOfDifferentials == 18)
        {
            $handicap = (new self)->determineHandicap($yourDifferentials, 6);

        }
        elseif($countOfDifferentials  == 19)
        {
            $handicap = (new self)->determineHandicap($yourDifferentials, 7);

        }
        elseif($countOfDifferentials  == 20)
        {
            $handicap = (new self)->determineHandicap($yourDifferentials, 8);

        }
        else
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
        array_slice($arrayofDifferentials, 0, $numberOfDifferentials);
        return array_sum(array_slice($arrayofDifferentials, 0, $numberOfDifferentials))/$numberOfDifferentials - $adjustments;
    }


    
}
?>