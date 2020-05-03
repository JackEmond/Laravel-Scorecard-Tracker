<?php

namespace App\Services;
use DB;

class ScoreTotals{
    
    public static function scoreTotal($scorecard)
    {
        #calculate score total for the player
        $scoreFrontNine = (new self)->scoreFrontNine($scorecard);
        $scoreBackNine = (new self)->scoreBackNine($scorecard);
        return $scoreFrontNine + $scoreBackNine;
    }

    public static function scoreFrontNine($scorecard)
    {
        return $scorecard->hole_one + $scorecard->hole_two + $scorecard->hole_three 
        + $scorecard->hole_four + $scorecard->hole_five + $scorecard->hole_six 
        + $scorecard->hole_seven + $scorecard->hole_eight + $scorecard->hole_nine;
    }
    
    public static function scoreBackNine($scorecard)
    {
        return  $scorecard->hole_ten + $scorecard->hole_eleven + $scorecard->hole_twelve
        + $scorecard->hole_thirteen + $scorecard->hole_fourteen + $scorecard->hole_fifteen 
        + $scorecard->hole_sixteen + $scorecard->hole_seventeen + $scorecard->hole_eighteen;;
    }

}
?>