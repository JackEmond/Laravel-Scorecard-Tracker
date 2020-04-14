<?php

namespace App\Services;

class ParTotals{
    
    public static function parFrontNine($scorecard)
    {
        $course = $scorecard->course;
        return $course->par_hole_one + $course->par_hole_two + $course->par_hole_three  
        + $course->par_hole_four + $course->par_hole_five+ $course->par_hole_six  
        + $course->par_hole_seven + $course->par_hole_eight + $course->par_hole_nine;
    }

    public static function parBackNine($scorecard)
    {
        $course = $scorecard->course;
        return $course->par_hole_ten + $course->par_hole_eleven + $course->par_hole_twelve +
         $course->par_hole_thirteen + $course->par_hole_fourteen + $course->par_hole_fifteen
        + $course->par_hole_sixteen + $course->par_hole_seventeen + $course->par_hole_eighteen;
    }

    public static function parTotal($scorecard)
    {
        $parTotal = (new self)->parFrontNine($scorecard) +  (new self)->parBackNine($scorecard);
        return $parTotal;
    }
}
?>