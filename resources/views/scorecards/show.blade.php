@extends('layout')

@section('content')


    <div class="scorecard-top">
        <div class="viewScorecard-Right">{{$scorecard->tee->colour}} Tees</div>
        <h2>{{$scorecard->course->course_name}}</h2>
        <div class="left">{{$scorecard->date_played}}</div>
        <div class="rightText">Score:{{$scoreVsPar > 0 ? "+":""}}{{$scoreVsPar}}</div>
    </div>    

    <div class="flex-container-scorecard">
        <div class="items-info hole">Hole #</div>  
        <div class="items-scorecard hole">1</div>  
        <div class="items-scorecard hole">2</div>  
        <div class="items-scorecard hole">3</div>  
        <div class="items-scorecard hole">4</div>  
        <div class="items-scorecard hole">5</div>  
        <div class="items-scorecard hole">6</div>  
        <div class="items-scorecard hole">7</div>  
        <div class="items-scorecard hole">8</div>  
        <div class="items-scorecard hole">9</div>  
        <div class="items-scorecard hole">OUT</div>  
    </div> 

    <!-- What is your score for holes 1 - 9 -->
    <div class="flex-container-scorecard">
        <div class="items-info"> Score</div>  
        <div class="items-scorecard">{{$scorecard->hole_one}}</div>  
        <div class="items-scorecard">{{$scorecard->hole_two}}</div>  
        <div class="items-scorecard">{{$scorecard->hole_three}}</div>  
        <div class="items-scorecard">{{$scorecard->hole_four}}</div>  
        <div class="items-scorecard">{{$scorecard->hole_five}}</div>  
        <div class="items-scorecard">{{$scorecard->hole_six}}</div>  
        <div class="items-scorecard">{{$scorecard->hole_seven}}</div>  
        <div class="items-scorecard">{{$scorecard->hole_eight}}</div>  
        <div class="items-scorecard">{{$scorecard->hole_nine}}</div>  
        <div class="items-scorecard">{{$scoreFrontNine}}</div>  
    </div> 

        <!-- What is par for holes 1 - 9 -->
        <div class="flex-container-scorecard">
        <div class="items-info par"> Par </div>  
        <div class="items-scorecard par">{{$scorecard->course->par_hole_one}}</div>  
        <div class="items-scorecard par">{{$scorecard->course->par_hole_two}}</div>  
        <div class="items-scorecard par">{{$scorecard->course->par_hole_three}}</div>  
        <div class="items-scorecard par">{{$scorecard->course->par_hole_four}}</div>  
        <div class="items-scorecard par">{{$scorecard->course->par_hole_five}}</div>  
        <div class="items-scorecard par">{{$scorecard->course->par_hole_six}}</div>  
        <div class="items-scorecard par">{{$scorecard->course->par_hole_seven}}</div>  
        <div class="items-scorecard par">{{$scorecard->course->par_hole_eight}}</div>  
        <div class="items-scorecard par">{{$scorecard->course->par_hole_nine}}</div>
        <div class="items-scorecard par">{{$parFrontNine}}</div>  
    </div> 
    
    @if ($scorecard->hole_ten != null)
        <br>
        <br>
        <!-- Holes 10 - 18 -->
        <div class="flex-container-scorecard">
            <div class="items-info hole">Hole #</div>  
            <div class="items-scorecard hole">10</div>  
            <div class="items-scorecard hole">11</div>  
            <div class="items-scorecard hole">12</div>  
            <div class="items-scorecard hole">13</div>  
            <div class="items-scorecard hole">14</div>  
            <div class="items-scorecard hole">15</div>  
            <div class="items-scorecard hole">16</div>  
            <div class="items-scorecard hole">17</div>  
            <div class="items-scorecard hole">18</div>  
            <div class="items-scorecard hole">IN</div>  
        </div> 
        <!-- What is your score for holes 10 - 18 -->

        <div class="flex-container-scorecard">
            <div class="items-info">Score</div>  
            <div class="items-scorecard">{{$scorecard->hole_ten}}</div>  
            <div class="items-scorecard">{{$scorecard->hole_eleven}}</div>  
            <div class="items-scorecard">{{$scorecard->hole_twelve}}</div>  
            <div class="items-scorecard">{{$scorecard->hole_thirteen}}</div>  
            <div class="items-scorecard">{{$scorecard->hole_fourteen}}</div> 
            <div class="items-scorecard">{{$scorecard->hole_fifteen}}</div>  
            <div class="items-scorecard">{{$scorecard->hole_sixteen}}</div>  
            <div class="items-scorecard">{{$scorecard->hole_seventeen}}</div>  
            <div class="items-scorecard">{{$scorecard->hole_eighteen}}</div>  
            <div class="items-scorecard">{{$scoreBackNine}}</div>
        </div> 
            <!-- What is par for holes 10 - 18 -->
            <div class="flex-container-scorecard">
            <div class="items-info par"> Par</div>  
            <div class="items-scorecard par">{{$scorecard->course->par_hole_ten}}</div>  
            <div class="items-scorecard par">{{$scorecard->course->par_hole_eleven}}</div>  
            <div class="items-scorecard par">{{$scorecard->course->par_hole_twelve}}</div>  
            <div class="items-scorecard par">{{$scorecard->course->par_hole_thirteen}}</div>
            <div class="items-scorecard par">{{$scorecard->course->par_hole_fourteen}}</div>  
            <div class="items-scorecard par">{{$scorecard->course->par_hole_fifteen}}</div>  
            <div class="items-scorecard par">{{$scorecard->course->par_hole_sixteen}}</div>  
            <div class="items-scorecard par">{{$scorecard->course->par_hole_seventeen}}</div>  
            <div class="items-scorecard par">{{$scorecard->course->par_hole_eighteen}}</div>  
                <div class="items-scorecard par">{{$parBackNine}}</div>
            </div> 
    @endif
    
  

    <form  class="lol" method="POST"  onsubmit="return confirm('Please confirm you want to delete!');"  action="/scorecards/{{$scorecard->id}}">
        {{ method_field('DELETE') }}
        {{ csrf_field() }}
        <button class="delete" type="submit" data-confirm="Are you sure to delete this item?">Delete Item </button>
    </form>

@endsection
