<?php

namespace App\Service;

class DayOneService
{
    public function dayOneCalcuationsPartOne()
    {
        $contents = file_get_contents("../src/inputFiles/dayOneInputFile.txt");
        $contentsArray = explode(PHP_EOL, $contents);

        $outputArray = array();

        foreach ($contentsArray as $string) {
            $foundValue = '';
            $foundValue .= substr($string, strcspn($string, '0123456789'), 1);

            $reverseString = strrev($string);
            $foundValue .= substr($reverseString, strcspn($reverseString, '0123456789'), 1);
            if (is_numeric($foundValue)) {
                $outputArray[] = $foundValue;
            }
        }

        return array_sum($outputArray);
    }

    public function dayOneCalculationsPartTwo()
    {
        $contents = file_get_contents("../src/inputFiles/dayOneInputFile.txt");
        $contentsArray = explode(PHP_EOL, $contents);

        $outputArray = array();

        foreach ($contentsArray as $string) {
            if (!empty($string)) {
                $foundValue = $this->determineFirstInstanceOfSpelledOrNumericValue($string);
                $outputArray[] = $foundValue;
            }
        }

        return array_sum($outputArray);
    }

    private function determineFirstInstanceOfSpelledOrNumericValue($inputValue)
    {
        $foundSpelledValues = [];
        $spelledValuesKey = [
            1 => 'one',
            2 => 'two',
            3 => 'three',
            4 => 'four',
            5 => 'five',
            6 => 'six',
            7 => 'seven',
            8 => 'eight',
            9 => 'nine'
        ];

        $formattedString = strtolower($inputValue);

        foreach ($spelledValuesKey as $number => $value) {
            $offset = 0;
            while (strpos($formattedString, $number, $offset) !== false) {
                $foundSpelledValues[strpos($formattedString, $number, $offset)] = $number;
                $offset = strpos($formattedString, $number, $offset) + strlen($number);
            }

            $offset = 0;
            while (strpos($formattedString, $value, $offset) !== false) {
                $foundSpelledValues[strpos($formattedString, $value, $offset)] = $number;
                $offset = strpos($formattedString, $value, $offset) + strlen($value);
            }
        }

        ksort($foundSpelledValues);
        $value = $foundSpelledValues[array_key_first($foundSpelledValues)];
        krsort($foundSpelledValues);
        $value .= $foundSpelledValues[array_key_first($foundSpelledValues)];

        return $value;
    }
}
