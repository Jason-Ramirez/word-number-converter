<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Word;

class ConverterController extends Controller
{

    public function convert(Request $request) {

        $word = $request->data ?? '';

        $converted_data = Word::toNumber($word);

        return view('home', compact('converted_data'));

    }

    // @remind clear
    // public static function wordsToNumber($word) {
    //     $numberWords = [
    //         'zero' => 0,
    //         'one' => 1,
    //         'two' => 2,
    //         'three' => 3,
    //         'four' => 4,
    //         'five' => 5,
    //         'six' => 6,
    //         'seven' => 7,
    //         'eight' => 8,
    //         'nine' => 9,
    //         'ten' => 10,
    //         'eleven' => 11,
    //         'twelve' => 12,
    //         'thirteen' => 13,
    //         'fourteen' => 14,
    //         'fifteen' => 15,
    //         'sixteen' => 16,
    //         'seventeen' => 17,
    //         'eighteen' => 18,
    //         'nineteen' => 19,
    //         'twenty' => 20,
    //         'thirty' => 30,
    //         'forty' => 40,
    //         'fifty' => 50,
    //         'sixty' => 60,
    //         'seventy' => 70,
    //         'eighty' => 80,
    //         'ninety' => 90,
    //         'hundred' => 100,
    //         'thousand' => 1000,
    //         'million' => 1000000,
    //         'billion' => 1000000000,
    //         'trillion' => 1000000000000
    //     ];
    //     $words = explode(" ", strtolower($word));
    //     $result = 0;
    //     $temp = 0;
    //     foreach ($words as $word) {
    //         if (!array_key_exists($word, $numberWords)) {
    //             return "Invalid input";
    //         }
    //         if ($numberWords[$word] > 99) {
    //             if ($temp > 0) {
    //                 $result += $temp * $numberWords[$word];
    //                 $temp = 0;
    //             } else {
    //                 $result = $numberWords[$word];
    //             }
    //         } else {
    //             $temp += $numberWords[$word];
    //         }
    //     }
    //     return $result + $temp;
    // }
      

    // function wordsToNumber($input) {
    //     $input = strtolower($input);
    //     $words = array(
    //         "zero",
    //         "one",
    //         "two",
    //         "three",
    //         "four",
    //         "five",
    //         "six",
    //         "seven",
    //         "eight",
    //         "nine",
    //         "ten",
    //         "eleven",
    //         "twelve",
    //         "thirteen",
    //         "fourteen",
    //         "fifteen",
    //         "sixteen",
    //         "seventeen",
    //         "eighteen",
    //         "nineteen",
    //         "twenty",
    //         "thirty",
    //         "forty",
    //         "fifty",
    //         "sixty",
    //         "seventy",
    //         "eighty",
    //         "ninety",
    //         "hundred",
    //         "thousand",
    //         "million",
    //         "billion",
    //         "trillion"
    //     );
    //     $numbers = array(
    //         0,
    //         1,
    //         2,
    //         3,
    //         4,
    //         5,
    //         6,
    //         7,
    //         8,
    //         9,
    //         10,
    //         11,
    //         12,
    //         13,
    //         14,
    //         15,
    //         16,
    //         17,
    //         18,
    //         19,
    //         20,
    //         30,
    //         40,
    //         50,
    //         60,
    //         70,
    //         80,
    //         90,
    //         100,
    //         1000,
    //         1000000,
    //         1000000000,
    //         1000000000000
    //     );
    
    //     $parts = explode(" ", $input);
    //     $result = 0;
    //     $current = null;
    //     $last = null;
    //     foreach ($parts as $part) {
    //         $index = array_search($part, $words);
    //         if ($index === false) {
    //             return "Invalid input";
    //         }
    //         if ($numbers[$index] >= 100) {
    //             if ($current != null) {
    //                 $result += $current;
    //                 $current = null;
    //             }
    //             if ($numbers[$index] == 100) {
    //                 if ($last == null) {
    //                     return "Invalid input";
    //                 }
    //                 $current = $last * 100;
    //                 $last = null;
    //             } else {
    //                 $result *= $numbers[$index];
    //                 if ($last != null) {
    //                     $result += $last;
    //                     $last = null;
    //                 }
    //             }
    //         } else {
    //             $last = $numbers[$index];
    //         }
    //     }
    //     if ($current != null) {
    //         $result += $current;
    //     }
    //     if ($last != null) {
    //         $result += $last;
    //     }
    //     return $result;
    // }
    

}
