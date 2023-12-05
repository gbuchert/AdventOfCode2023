<?php

namespace App\Service;

class DayTwoService
{
    public function dayTwoCalcuationsPartOne()
    {
        $contents = file_get_contents("../src/inputFiles/dayTwoInputFile.txt");
        $contentsArray = explode(PHP_EOL, $contents);

        $sum = 0;

        foreach ($contentsArray as $game) {
            if (!empty($game)) {
                $explodedGameArray = explode(":", $game);
                preg_match("([0-9]+)", $explodedGameArray[0], $matches);
                $gameNumber = $matches[0];

                $pulls = explode(";", $explodedGameArray[1]);
                $possible = true;
                foreach ($pulls as $pull) {
                    $presents = explode(",", $pull);
                    foreach ($presents as $present) {
                        preg_match("([0-9]+)", $present, $matches);
                        $numberOfPresents = $matches[0];

                        preg_match("([a-zA-Z]+)", $present, $matches);
                        $color = $matches[0];
                        if ($color == 'blue' && $numberOfPresents > 14) {
                            $possible = false;
                            break;
                        } elseif ($color == 'red' && $numberOfPresents > 12) {
                            $possible = false;
                            break;
                        } elseif ($color == 'green' && $numberOfPresents > 13) {
                            $possible = false;
                            break;
                        }
                    }
                }
                if ($possible == true) {
                    $sum += $gameNumber;
                }
            }
        }

        return $sum;
    }

    public function dayTwoCalculationsPartTwo()
    {
        $contents = file_get_contents("../src/inputFiles/dayTwoInputFile.txt");
        $contentsArray = explode(PHP_EOL, $contents);

        $sum = 0;

        foreach ($contentsArray as $game) {
            if (!empty($game)) {
                $redPresents = 0;
                $bluePresents = 0;
                $greenPresents = 0;

                $explodedGameArray = explode(":", $game);

                $pulls = explode(";", $explodedGameArray[1]);
                foreach ($pulls as $pull) {
                    $presents = explode(",", $pull);
                    foreach ($presents as $present) {
                        preg_match("([0-9]+)", $present, $matches);
                        $numberOfPresents = $matches[0];

                        preg_match("([a-zA-Z]+)", $present, $matches);
                        $color = $matches[0];

                        if ($color == 'blue' && $numberOfPresents > $bluePresents) {
                            $bluePresents = $numberOfPresents;
                        } elseif ($color == 'red' && $numberOfPresents > $redPresents) {
                            $redPresents = $numberOfPresents;
                        } elseif ($color == 'green' && $numberOfPresents > $greenPresents) {
                            $greenPresents = $numberOfPresents;
                        }
                    }
                }

                $powerOfCubes = $redPresents * $bluePresents * $greenPresents;
                $sum += $powerOfCubes;
            }
        }

        return $sum;
    }
}
