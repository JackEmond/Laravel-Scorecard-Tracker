
@extends('layout')

@section('content')

<br>
<br>
<main>
        
<form method="POST" action="/scorecards" >
    {{ csrf_field() }}
    <script src="{{ asset('js/toggle.js') }}"></script>

    <!-- Course Name and Information -->
    @if ($courseid == "newCourse")
        <div class="alignCenter courseInfoName">Course Name:<input type="text" name="course_name" value="{{old('course_name')}}" /><br></div>

        <div class="alignCenter">
            <label for="date_played">Date Played:</label><input type="date" name="date_played" value="{{old('date_played')}}"><br>
            <label for="colour">Course Tees:</label><input type="text" name="colour"  value="{{old('colour')}}" /><br>
        </div>
        
        <div class="alignCenter">
            <label for="rating">Tee Rating:</label><input type="number" step=".01" name="rating" value="{{old('rating')}}" /><br>
            <label for="slope"> Slope:</label><input type="number"  step=".01" name="slope" value="{{old('slope')}}" /><br>
        </div>
    <br>
    <br>
   
    @endif

    @if ($courseid != "newCourse")
        <div class="alignCenter courseInfoName">{{ $courseid->course_name }}</div>

        Date Played: <input type="date" name="date_played" value="{{old('date_played')}}"/><br>
        <input type="hidden" name="course_id" value="{{$courseid->id}}" /><br>

        @foreach ($teeid as $tee)
            <input type="radio"  name="tee" value="{{$tee->id}}" onclick="toggleTees('none')">
            <label for="{{$tee->colour}}">{{$tee->colour}}</label><br>
        @endforeach
        
        <input type="radio" id="new" name="tee" value="new" onclick="toggleTees('block')">
        <label for="new">Other</label>

        <div id="toggleTees">
            Tee Colour: <input type="text" id="{{$tee->colour}}" name="colour" value="{{old('rating')}}" /><br>
            Tee Rating: <input type="number" name="rating" value="{{old('rating')}}" /><br>
            Tee Slope: <input type="number" name="slope" value="{{old('slope')}}" /><br>
        </div>

    @endif

    <input name="number_of_holes" type="hidden" value="{{$numholes}}">
        

    <!--=-------------------
        Scorecard 
    ----------------------->

    <!-- Holes 1-9 -->
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
        <div class="items-info">Score</div>
        <div class="items-scorecard">
        <input type="number" name="hole_one" value="{{old('hole_one')}}"/>
        </div>
        <div class="items-scorecard">
            <input type="number" name="hole_two" value="{{old('hole_two')}}"/>
        </div>
        <div class="items-scorecard">
            <input type="number" name="hole_three" value="{{old('hole_three')}}" />
        </div>
        <div class="items-scorecard">
            <input type="number" name="hole_four" value="{{old('hole_four')}}" />
        </div>
        <div class="items-scorecard">
            <input type="number" name="hole_five" value="{{old('hole_five')}}" />
        </div>
        <div class="items-scorecard">
            <input type="number" name="hole_six" value="{{old('hole_six')}}" />
        </div>
        <div class="items-scorecard">
            <input type="number" name="hole_seven" value="{{old('hole_seven')}}" />
        </div>
        <div class="items-scorecard">
            <input type="number" name="hole_eight" value="{{old('hole_eight')}}" />
        </div>
        <div class="items-scorecard">
            <input type="number" name="hole_nine" value="{{old('hole_nine')}}" />
        </div>
        <div class="items-scorecard">
            TOT
        </div>
    </div>

    <!-- What is Par for holes 1 - 9 -->
    @if ($courseid == "newCourse")
        <div class="flex-container-scorecard">
            <div class="items-info par"> Par </div>  
            <div class="items-scorecard">
                <input type="number" name="par_hole_one"  value="{{old('par_hole_one')}}">
            </div>  
            <div class="items-scorecard">
                <input type="number" name="par_hole_two" value="{{old('par_hole_two')}}">
            </div>  
            <div class="items-scorecard">
            <input type="number" name="par_hole_three" value="{{old('par_hole_three')}}">
            </div>  
            <div class="items-scorecard">
                <input type="number" name="par_hole_four" value="{{old('par_hole_four')}}">
            </div>  
            <div class="items-scorecard">
                <input type="number" name="par_hole_five" value="{{old('par_hole_five')}}">
            </div>  
            <div class="items-scorecard">
                <input type="number" name="par_hole_six" value="{{old('par_hole_six')}}">
            </div>  
            <div class="items-scorecard">
                <input type="number" name="par_hole_seven" value="{{old('par_hole_seven')}}">
            </div>  
            <div class="items-scorecard">
                <input type="number" name="par_hole_eight" value="{{old('par_hole_eight')}}">
            </div>  
            <div class="items-scorecard">
                <input type="number" name="par_hole_nine" value="{{old('par_hole_nine')}}">
            </div> 
            <div class="items-scorecard par">Final</div>  
        </div> 
    @endif

    <!-- Show Par for holes 1 - 9 -->
    @if ($courseid != "newCourse")
        <div class="flex-container-scorecard">
            <div class="items-info par"> Par </div>  
            <div class="items-scorecard">{{$courseid->par_hole_one}}</div>  
            <div class="items-scorecard">{{$courseid->par_hole_two}}</div>  
            <div class="items-scorecard">{{$courseid->par_hole_three}}</div>  
            <div class="items-scorecard">{{$courseid->par_hole_four}}</div>  
            <div class="items-scorecard">{{$courseid->par_hole_five}}</div>  
            <div class="items-scorecard">{{$courseid->par_hole_six}}</div>  
            <div class="items-scorecard">{{$courseid->par_hole_seven}}</div>  
            <div class="items-scorecard">{{$courseid->par_hole_eight}}</div>  
            <div class="items-scorecard">{{$courseid->par_hole_nine}}</div> 
            <div class="items-scorecard par">Final</div>  
        </div> 
    @endif

    <br />
    <br />
    @if ($numholes == 18)
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
            <div class="items-scorecard">
                <input type="number" name="hole_ten" value="{{old('hole_ten')}}" />
            </div>
            <div class="items-scorecard">
                <input type="number" name="hole_eleven" value="{{old('hole_eleven')}}" />
            </div>
            <div class="items-scorecard">
                <input type="number" name="hole_twelve" value="{{old('hole_twelve')}}" />
            </div>
            <div class="items-scorecard">
                <input type="number" name="hole_thirteen" value="{{old('hole_thirteen')}}" />
            </div>
            <div class="items-scorecard">
                <input type="number" name="hole_fourteen" value="{{old('hole_fourteen')}}" />
            </div>
            <div class="items-scorecard">
                <input type="number" name="hole_fifteen" value="{{old('hole_fifteen')}}" />
            </div>
            <div class="items-scorecard">
                <input type="number" name="hole_sixteen" value="{{old('hole_sixteen')}}" />
            </div>
            <div class="items-scorecard">
                <input type="number" name="hole_seventeen" value="{{old('hole_seventeen')}}" />
            </div>
            <div class="items-scorecard">
                <input type="number" name="hole_eighteen" value="{{old('hole_eighteen')}}" />
            </div>
            <div class="items-scorecard">
                TOT
            </div>
        </div>

        @if ($courseid == "newCourse")
        <div class="flex-container-scorecard">
            <div class="items-info par"> Par </div>  
            <div class="items-scorecard">
                <input type="number" name="par_hole_ten" value="{{old('par_hole_ten')}}">
            </div>  
            <div class="items-scorecard">
                <input type="number" name="par_hole_eleven" value="{{old('par_hole_eleven')}}">
            </div>  
            <div class="items-scorecard">
            <input type="number" name="par_hole_twelve" value="{{old('par_hole_twelve')}}">
            </div>  
            <div class="items-scorecard">
                <input type="number" name="par_hole_thirteen" value="{{old('par_hole_thirteen')}}">
            </div>  
            <div class="items-scorecard">
                <input type="number" name="par_hole_fourteen" value="{{old('par_hole_fourteen')}}">
            </div>  
            <div class="items-scorecard">
                <input type="number" name="par_hole_fifteen" value="{{old('par_hole_fifteen')}}">
            </div>  
            <div class="items-scorecard">
                <input type="number" name="par_hole_sixteen" value="{{old('par_hole_sixteen')}}">
            </div>  
            <div class="items-scorecard">
                <input type="number" name="par_hole_seventeen" value="{{old('par_hole_seventeen')}}">
            </div>  
            <div class="items-scorecard">
                <input type="number" name="par_hole_eighteen" value="{{old('par_hole_eighteen')}}">
            </div> 
            <div class="items-scorecard par">Final</div>  
        </div> 
    @endif

    @if ($courseid != "newCourse")
    <div class="flex-container-scorecard">
        <div class="items-info par"> Par </div>  
        <div class="items-scorecard">{{$courseid->par_hole_ten}}</div>  
        <div class="items-scorecard">{{$courseid->par_hole_eleven}}</div>  
        <div class="items-scorecard">{{$courseid->par_hole_twelve}}</div>  
        <div class="items-scorecard">{{$courseid->par_hole_thirteen}}</div>  
        <div class="items-scorecard">{{$courseid->par_hole_fourteen}}</div>  
        <div class="items-scorecard">{{$courseid->par_hole_fifteen}}</div>  
        <div class="items-scorecard">{{$courseid->par_hole_sixteen}}</div>  
        <div class="items-scorecard">{{$courseid->par_hole_seventeen}}</div>  
        <div class="items-scorecard">{{$courseid->par_hole_eighteen}}</div> 
        <div class="items-scorecard par">Final</div>  
    </div> 
    @endif

    @endif
    <br />
    <button class="submit" type="submit" name="Submit">Submit</button>
</form>

@if ($errors->any())
    <ul>
        @foreach($errors->all() as $error)
            <li>{{ $error }} </li>
        @endforeach
    </ul>
@endif
</main>

@endsection
