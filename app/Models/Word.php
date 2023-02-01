<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Word extends Model
{
    use HasFactory;

    const BASE_10 = [
        'hundred' => 100,
        'thousand' => 1000,
        'million' => 1000000,
        'billion' => 1000000000,
        'trillion' => 1000000000000,
        'quadrillion' => 1000000000000000,
        'quintrillion' => 1000000000000000000,
        'sextillion' => 1000000000000000000000,
    ];

    const COMMONS = [
        'four' => 4,
        'five' => 5,
        'six' => 6,
        'seven' => 7,
        'eight' => 8,
        'nine' => 9,
    ];
    
    const NUMBERS = [
        'zero' => 0,
        'one' => 1,
        'two' => 2,
        'three' => 3,
        'five' => 5,
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
    ] + self::BASE_10 + self::COMMONS;
    
    public static function toNumber($input)
    {
        $base_10 = self::BASE_10;
        $number_words = self::NUMBERS;
        $and_space = str_replace(' and ', ' ', strtolower($input));
        $dash_space = str_replace('-', ' ', strtolower($and_space));
        $cleaned = preg_replace('/[^A-Za-z0-9]/', '', $dash_space); 
        $words = self::recognizeFuzzyWords($cleaned);
        $result = [0];
        $digits = 0;
        $digit_size = 0;
        foreach ($words as $word) {
            if (!array_key_exists($word, $number_words)) return null;
            $number = $number_words[$word];
            if (array_key_exists($word, $base_10)) {
                $digits *= $number;
                if (
                    (
                        ($digit_size === 0) || 
                        ($digit_size === $number)
                    ) && 
                    ($number !== 100)
                ) {
                    array_push($result, $digits);
                    $digit_size /= $number > 1000 ? 1000 : 10;
                    $digits = 0;
                }
            } else {
                $digits += $number;
            }
        }
        array_push($result, $digits);
        return array_sum($result);
    }

    public static function recognizeFuzzyWords($string)
    {
        $letters = str_split(strtolower($string));
        $word = '';
        $recognized = [];
        foreach ($letters as $index => $letter) {
            $word .= $letter;
            if (array_key_exists($word, self::NUMBERS)) {
                if (array_key_exists($word, self::COMMONS)) {
                    if ($word === 'eight') {
                        $een = ($letters[$index+1] ?? '') . ($letters[$index+2] ?? '') . ($letters[$index+3] ?? '');
                        $y = ($letters[$index+1] ?? '');
                        if (($een === 'een') || ($y === 'y')) continue;
                    } else {
                        $teen = ($letters[$index+1] ?? '') . ($letters[$index+2] ?? '') . ($letters[$index+3] ?? '') . ($letters[$index+4] ?? '');
                        $ty = ($letters[$index+1] ?? '') . ($letters[$index+2] ?? '');
                        if (($teen === 'teen') || ($ty === 'ty')) continue; 
                    }
                }
                array_push($recognized, $word);
                $word = '';
            } elseif ($word === 'and') $word = '';
        }
        return $recognized;
    }

}
