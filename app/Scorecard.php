<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Scorecard extends Model
{
    protected $guarded = [];
    
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function tee()
    {
        return $this->belongsTo(Tee::class);
    }
    /*
    public function parFrontNine()
    {
        $course = $this->course;
        return $course->par_hole_one + $course->par_hole_two + $course->par_hole_three  
        + $course->par_hole_four + $course->par_hole_five+ $course->par_hole_six  
        + $course->par_hole_seven + $course->par_hole_eight + $course->par_hole_nine;
    }
    */
    public function parBackNine()
    {
        $course = $this->course;
        return $course->par_hole_ten + $course->par_hole_eleven + $course->par_hole_twelve +
         $course->par_hole_thirteen + $course->par_hole_fourteen + $course->par_hole_fifteen
        + $course->par_hole_sixteen + $course->par_hole_seventeen + $course->par_hole_eighteen;
    }

    public function parTotal()
    {
        $parTotal = $this->parFrontNine() +  $this->parBackNine();
        return $parTotal;
    }
    
}
