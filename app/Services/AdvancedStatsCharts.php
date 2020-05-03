<?php

namespace App\Services;
use App\Charts\AdvancedStatsChart; // Laravel Charts https://dev.to/arielmejiadev/use-laravel-charts-in-laravel-5bbm
use App\Services\Handicap;


class AdvancedStatsCharts{
    
    public static function ScoreProgress($listOfScorecards, $chartscores) 
    {
        # Create the dataset and labels
        $dataset = $labels = [];
        $gamesplayed = 0;

        for($x = 0; $x < count($listOfScorecards) && $gamesplayed<= 20; $x++)
        {
            if($chartscores == 9 && $listOfScorecards[$x]->hole_ten == null)
            {
                array_unshift($dataset, $listOfScorecards[$x]->final_score);
                array_push($labels, $gamesplayed+1);
                $gamesplayed ++;
            }
            else if($chartscores == 18 && $listOfScorecards[$x]->hole_ten != null)
            {
                array_unshift($dataset, $listOfScorecards[$x]->final_score);
                array_push($labels, $gamesplayed+1);
                $gamesplayed  ++;
            }
        }


        # Create the Chart using Laravel Charts
        $ScoreProgressChart = new AdvancedStatsChart;
        $ScoreProgressChart ->labels($labels)
                    ->dataset('', 'line', $dataset)
                    ->fill(false)
                    ->color("#000");
        $ScoreProgressChart->displaylegend(false);

        return $ScoreProgressChart;
    }



    public static function handicapChart($listOfScorecards) 
    {

        #Calculate the differentials. Once you get the differentials calculate
        $differentials = Handicap::calculateDifferentials($listOfScorecards, 40);
        
        $handicap = $b = [];

        for($x = 0; $x < $differentials && $x <= 10; $x++)
        {
            $thishandicap = Handicap::yourHandicap($differentials);

            if(!is_string($thishandicap))
            {
                $handicap[$x] = $thishandicap;
                $b[$x] = $x+1;
                array_shift($differentials);
            } 
            else
            {
                break;
            }
        }

        array_reverse($handicap);

         # Create the Chart using Laravel Charts
         $ScoreProgressChart = new AdvancedStatsChart;
         $ScoreProgressChart ->labels($b)
                     ->dataset('', 'line', array_reverse($handicap))
                     ->fill(false)
                     ->color("#000");
         $ScoreProgressChart->displaylegend(false);
 
         return $ScoreProgressChart;
    }


}
?>