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
                
                if(count($nineHoleDifferentials) == 2) // combine 2 ninehole differentials to make a eighteen hole differential
                {
                    array_push($eighteenHoleDifferentials, $nineHoleDifferentials[0] + $nineHoleDifferentials[1]);
                }
            }
            else if($listOfScorecards[$i]->hole_ten != null)//its an eighteen hole score
            {
                $eighteenHoleDifferentials[] = (113/$listOfScorecards[$i]->tee->slope) * (ScoreTotals::scoreTotal($listOfScorecards[$i]) - $listOfScorecards[$i]->tee->rating);
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

        switch($countOfDifferentials)
        {
            case 1:
            case 2:
                $gamesRemaining = 3 - $countOfDifferentials;
                return 'Play more games';
            break;
            case 3:
                $handicap = min($yourDifferentials) - 2;
                break;
            case 4:
                $handicap = min($yourDifferentials) - 1;
                break;
            case 5:
                $handicap = min($yourDifferentials);
                break;
            case 6:
                $handicap = (new self)->determineHandicap($yourDifferentials, 2, -1);
                break;
            case 7:
            case 8:
                $handicap = (new self)->determineHandicap($yourDifferentials, 2);
                break;
            case 9:
            case 10:
            case 11:
                $handicap = (new self)->determineHandicap($yourDifferentials, 3);
                break;
            case 12:
            case 13:
            case 14:
                $handicap = (new self)->determineHandicap($yourDifferentials, 4);
                break;
            case 15:
            case 16:
                $handicap = (new self)->determineHandicap($yourDifferentials, 5);
                break;
            case 17:
            case 18:
                $handicap = (new self)->determineHandicap($yourDifferentials, 6);
                break;
            case 19:
                $handicap = (new self)->determineHandicap($yourDifferentials, 7);
                break;
            case 20:
                $handicap = (new self)->determineHandicap($yourDifferentials, 8);
                break;
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