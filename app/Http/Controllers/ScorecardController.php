<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Scorecard;
use App\Course;
use App\Tee;
use App\Services\AdvancedStats;
use App\Services\Handicap;
use App\Services\scoreTotals;
use App\Services\parTotals;


#use DB;


class ScorecardController extends Controller
{
    public function index()
    {
        $listOfScorecards = Scorecard::latest('date_played')->paginate(10);
        
        AdvancedStats::storeFinalScore($listOfScorecards);

        $bestNineHoleScore = AdvancedStats::bestScore9Holes($listOfScorecards);
        $bestEighteenHoleScore = AdvancedStats::bestScore18Holes($listOfScorecards);
        $handicap = Handicap::calculateHandicap($listOfScorecards);
        return view('scorecards.index', compact('listOfScorecards','bestNineHoleScore','bestEighteenHoleScore', 'handicap' ));
    }

    public function numberofHolesPlayed()
    {
        return view('scorecards.numberofholesplayed');
    }

    public function selectaCourse($numholes)
    {
        $listOfCourses = Course::where('number_of_holes', $numholes)->paginate(12);
       
        return view('scorecards.whichcourse',[
            'listOfCourses' => $listOfCourses,
            'numholes' => $numholes,
            'error' => "",
            'search' => ''
        ]); 
    }

    public function search(Request $request) #search bar on what course did you play page
    {
        $search = $request->get('search');
        $numholes =  $request->get('numholes');

        $listOfCourses = Course::where('course_name', 'like', '%'.$search.'%')->where('number_of_holes', '=', $numholes)->paginate(12);//and holes numholes

        return view('scorecards.whichcourse',[   
            'listOfCourses' => $listOfCourses, 
            'numholes' => $numholes, 
            'error' => count($listOfCourses) == 0 ? "Error! No golf course contains the text: " . $search :"", 
            'search' => $search
        ]);
    }


    // When creating a new scorecard show the form to create the scorecard
    public function showScorecard($courseid, $numholes)
    {
        if($courseid != "newCourse")
        {
            $teeid = Tee::where('course_id',$courseid)->get();
            $courseid = Course::whereId($courseid)->first();
        }

        return view('scorecards.createscorecard',[
            'courseid' => $courseid,
            'numholes' => $numholes,
            'teeid' => $teeid ?? true
        ]);
        
    }

   
    // View Selected Scorecard
    public function show(Scorecard $scorecard)
    {

        #calculate par totals for the course
        $parFrontNine =  parTotals::parFrontNine($scorecard);
        $parBackNine =  parTotals::parBackNine($scorecard);

        $parCourse = $parFrontNine + $parBackNine;
        #calculate score total for the player
        $scoreFrontNine = scoreTotals::scoreFrontNine($scorecard);
        $scoreBackNine = scoreTotals::scoreBackNine($scorecard);
        $finalScore = $scoreFrontNine + $scoreBackNine;
        
        //Determine Score compared to par 
        $scoreVsPar = $finalScore - $parCourse;

        return view('scorecards.show')
        ->with(compact('scorecard','parFrontNine', 'parBackNine', 'parCourse',
            'scoreFrontNine', 'scoreBackNine', 'finalScore', 'scoreVsPar'));
    }


    public function store()
    {
        # if the course id isnt null than the user is playing a course that has not been added to the database
        # therefore add the new course to the database
        if(request('par_hole_one') != null)
        {
            $courseValidated = request()->validate([
                'course_name' => ['required'],
                'number_of_holes' => ['required'],
                'par_hole_one' => ['required', 'max:30', 'numeric'],
                'par_hole_two' => ['required', 'max:30', 'numeric'],
                'par_hole_three' => ['required', 'max:30', 'numeric'],
                'par_hole_four' => ['required', 'max:30', 'numeric'],
                'par_hole_five' => ['required', 'max:30', 'numeric'],
                'par_hole_six' => ['required', 'max:30', 'numeric'],
                'par_hole_seven' => ['required', 'max:30', 'numeric'],
                'par_hole_eight' => ['required', 'max:30', 'numeric'],
                'par_hole_nine' => ['required', 'max:30', 'numeric'],
                'par_hole_ten' => ['max:30', 'numeric'],
                'par_hole_eleven' => ['max:30', 'numeric'],
                'par_hole_twelve' => ['max:30', 'numeric'],
                'par_hole_thirteen' => ['max:30', 'numeric'],
                'par_hole_fourteen' => ['max:30', 'numeric'],
                'par_hole_fifteen' => ['max:30', 'numeric'],
                'par_hole_sixteen' => ['max:30', 'numeric'],
                'par_hole_seventeen' => ['max:30', 'numeric'],
                'par_hole_eighteen' => ['max:30', 'numeric'],
            ]);
            $course = Course::create($courseValidated);
            
            $teesValidated = request()->validate([
                'colour' => ['required'],
                'rating' => ['required'],
                'slope' => ['required'],
            ]);
            $teesValidated['course_id'] = $course->id;

            $tees = Tee::create($teesValidated);

        }
        

        $scorecardValidated = request()->validate([
            'hole_one' => ['required', 'max:30', 'numeric'],
            'hole_two' => ['required', 'max:30', 'numeric'],
            'hole_three' => ['required', 'max:30', 'numeric'],
            'hole_four' => ['required', 'max:30', 'numeric'],
            'hole_five' => ['required', 'max:30', 'numeric'],
            'hole_six' => ['required', 'max:30', 'numeric'],
            'hole_seven' => ['required', 'max:30', 'numeric'],
            'hole_eight' => ['required', 'max:30', 'numeric'],
            'hole_nine' => ['required', 'max:30', 'numeric'],
            'hole_ten' => ['max:30', 'numeric'],
            'hole_eleven' => ['max:30', 'numeric'],
            'hole_twelve' => ['max:30', 'numeric'],
            'hole_thirteen' => ['max:30', 'numeric'],
            'hole_fourteen' => ['max:30', 'numeric'],
            'hole_fifteen' => ['max:30', 'numeric'],
            'hole_sixteen' => ['max:30', 'numeric'],
            'hole_seventeen' => ['max:30', 'numeric'],
            'hole_eighteen' => ['max:30', 'numeric'],
            'date_played' => ['required'],
        ]);

        if(request('par_hole_one') == null){ //old course

            $scorecardValidated['course_id'] = request('course_id');

            if(request('tee') == 'new')
            {
                $teesValidated = request()->validate([
                    'rating' => ['required'],
                    'slope' => ['required'],
                    'colour' =>['required'],
                    'course_id' => ['required']
                ]);
                $tees = Tee::create($teesValidated);

                $scorecardValidated['tee_id'] = $tees->id;
            }
            else{
                $scorecardValidated['tee_id'] = request('tee');

            }
            
        }
        else // new course
        {
            $scorecardValidated['course_id'] = $course->id;
            $scorecardValidated['tee_id'] = $tees->id;
        }
        
        Scorecard::create($scorecardValidated);

        return redirect('/scorecards');
    }


    public function destroy(Scorecard $scorecard){ #give the user the option to delete the course and the tees if the scorecard is the only one relying on the data
        $scorecard->delete();
        return redirect('/scorecards');
    }

}


