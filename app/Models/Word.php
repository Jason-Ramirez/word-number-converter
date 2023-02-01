<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Word extends Model
{
    use HasFactory;

    public static function toNumber($input)
    {
        $base_10 = [
            'hundred' => 100,
            'thousand' => 1000,
            'million' => 1000000,
            'billion' => 1000000000,
            'trillion' => 1000000000000,
            'quadrillion' => 1000000000000000,
            'quintrillion' => 1000000000000000000,
            'sextillion' => 1000000000000000000000
        ];
        
        $numberWords = [
            'zero' => 0,
            'one' => 1,
            'two' => 2,
            'three' => 3,
            'four' => 4,
            'five' => 5,
            'six' => 6,
            'seven' => 7,
            'eight' => 8,
            'nine' => 9,
            'ten' => 10,
            'eleven' => 11,
            'twelve' => 12,
            'thirteen' => 13,
            'fourteen' => 14,
            'fifteen' => 15,
            'sixteen' => 16,
            'seventeen' => 17,
            'eighteen' => 18,
            'nineteen' => 19,
            'twenty' => 20,
            'thirty' => 30,
            'forty' => 40,
            'fifty' => 50,
            'sixty' => 60,
            'seventy' => 70,
            'eighty' => 80,
            'ninety' => 90,
        ] + $base_10;

        



        // @remind clear
        // $dashes_removed = str_replace("-", " ", strtolower($word));
        // $words = explode(" ", strtolower($dashes_removed));
        // $result = 0;
        // $temp = 100;
        // // foreach ($words as $word) {
        // //     if (!array_key_exists($word, $numberWords)) {
        // //         return "Invalid input";
        // //     }
        // //     if ($numberWords[$word] > 99) {
        // //         if ($temp > 0) {
        // //             $result += $temp * $numberWords[$word];
        // //             $temp = 0;
        // //         } else {
        // //             $result = $result * $numberWords[$word];
        // //         }
        // //     } else {
        // //         $temp += $numberWords[$word];
        // //     }
        // // }
        // // return $result + $temp;
        // $digits = 0;
        
        // foreach ($words as $word) {
        //     if (!array_key_exists($word, $numberWords)) return "Invalid input";
        //     $number = $numberWords[$word];
        //     if ($number < $temp) {
        //         $digits += $number;
        //     } else {
        //         // $digits *= $number;
        //         // $result += $digits;

        //         $x = ($digits === 0 ? 1 : $digits) * $number;
        //         if ($x > $result) {
        //             $result = (($result + $digits) * $number);
                    
        //         }
        //         else {
        //             $result += $x;
        //         }
                
        //         $digits = 0;
        //     }
        // }
        // return $result + $digits;


        // $dashes_removed = str_replace("-", " ", strtolower($input));
        // $words = explode(" ", strtolower($dashes_removed));
        // $result = 0;
        // $temp = 100;
        // $digits = 0;
        // $recursion = function ($index = 0) 
        //                 use (
        //                     $numberWords, 
        //                     $words,
        //                     $result,
        //                     $temp,
        //                     $digits
        //                 ) {
            
        //     // foreach ($words as $word) {
        //     //     if (!array_key_exists($word, $numberWords)) return "Invalid input";
        //     //     $number = $numberWords[$word];
        //     //     if ($number < $temp) {
        //     //         $digits += $number;
        //     //     } else {
        //     //         $x = ($digits === 0 ? 1 : $digits) * $number;
        //     //         if ($x > $result) {
        //     //             $result = (($result + $digits) * $number);
        //     //         }
        //     //         else {
        //     //             $result += $x;
        //     //         }
                    
        //     //         $digits = 0;
        //     //     }
        //     // }


        //     if (!array_key_exists($word, $numberWords)) return "Invalid input";
        //     $number = $numberWords[$word];
        //     if ($number < $temp) {
        //         $digits += $number;

        //         return $recursion($index);
        //     } else {
        //         $x = ($digits === 0 ? 1 : $digits) * $number;
        //         if ($x > $result) {
        //             $result = (($result + $digits) * $number);
        //         }
        //         else {
        //             $result += $x;
        //         }
                
        //         $digits = 0;
                
        //         return $recursion($index);
        //     }

        //     return $result + $digits;
        // };

        // return $recursion(4);










        $dashes_removed = str_replace("-", " ", strtolower($input));
        $words = explode(" ", strtolower($dashes_removed));
        $result = [0];
        $temp = 100;
        // foreach ($words as $word) { @remind clear
        //     if (!array_key_exists($word, $numberWords)) {
        //         return "Invalid input";
        //     }
        //     if ($numberWords[$word] > 99) {
        //         if ($temp > 0) {
        //             $result += $temp * $numberWords[$word];
        //             $temp = 0;
        //         } else {
        //             $result = $result * $numberWords[$word];
        //         }
        //     } else {
        //         $temp += $numberWords[$word];
        //     }
        // }
        // return $result + $temp;
        $digits = 0;
        $cur_digit = 0;

        foreach ($words as $word) {
            if (!array_key_exists($word, $numberWords)) return "Bad input";
            $number = $numberWords[$word];
            if (array_key_exists($word, $base_10)) {
                $digits *= $number;
                if ((($cur_digit === 0) || ($cur_digit === $number)) && ($number !== 100)) {
                    array_push($result, $digits);
                    $cur_digit = $number > 1000 ? $number / 1000 : $number / 10;
                    $digits = 0;
                }
            } else {
                $digits += $number;
            }
        }
        array_push($result, $digits);
        return array_sum($result);

    }


}
