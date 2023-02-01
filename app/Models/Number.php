<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Number extends Model
{
    use HasFactory;

    public static function convertNumToWords($number) 
    {

        $tys = [
            20 => 'twenty',
            30 => 'thirty',
            40 => 'forty',
            50 => 'fifty',
            60 => 'sixty',
            70 => 'seventy',
            80 => 'eighty',
            90 => 'ninety'
        ];

        $words = [
            0 => 'zero',
            1 => 'one',
            2 => 'two',
            3 => 'three',
            4 => 'four',
            5 => 'five',
            6 => 'six',
            7 => 'seven',
            8 => 'eight',
            9 => 'nine',
            10 => 'ten',
            11 => 'eleven',
            12 => 'twelve',
            13 => 'thirteen',
            14 => 'fourteen',
            15 => 'fifteen',
            16 => 'sixteen',
            17 => 'seventeen',
            18 => 'eighteen',
            19 => 'nineteen',
        ] + $tys;

        $thousand = 1000;
        $million = pow($thousand, 2);
        $billion = $million * 1000;
        $trillion = $billion * 1000;
        $quadrillion = $trillion * 1000;
        $quintrillion = $quadrillion * 1000;

        $concat_words = function ($digit = null, $place = 'hundred') use ($number, $words) {
            $_digit = 100;
            if (!empty($digit)) $_digit = $digit / 1000;
            $data = self::convertNumToWords($number % $_digit);
            if ($data === 'zero') $data = null;
            if (!empty($data)) $data = ' and ' . $data;
            return (
                    empty($digit) 
                        ? $words[floor($number / 100)] 
                        : self::convertNumToWords(floor($number / $_digit))
                ) . " $place" . $data;
        };

        if ($number < 21) {
            return $words[$number] ?? null;
        } elseif ($number < 100) {
            $data = $words[$number % 10];
            if ($data === 'zero') $data = null;
            if (!empty($data)) $data = '-' . $data;
            return $words[10 * floor($number / 10)] . $data ;
        } 
       
        elseif ($number < $thousand) return $concat_words();
        elseif ($number < $million) return $concat_words($million, 'thousand');
        elseif ($number < $billion) return $concat_words($billion, 'million');
        elseif ($number < $trillion) return $concat_words($trillion, 'billion');
        elseif ($number < $quadrillion) return $concat_words($quadrillion, 'trillion');
        elseif ($number < $quintrillion) return $concat_words($quintrillion, 'quadrillion');
        else return 'Invalid Input.';

    }

    public static function toWords($number)
    {
        $tys = [
            20 => 'twenty',
            30 => 'thirty',
            40 => 'forty',
            50 => 'fifty',
            60 => 'sixty',
            70 => 'seventy',
            80 => 'eighty',
            90 => 'ninety'
        ];

        $words = [
            0 => 'zero',
            1 => 'one',
            2 => 'two',
            3 => 'three',
            4 => 'four',
            5 => 'five',
            6 => 'six',
            7 => 'seven',
            8 => 'eight',
            9 => 'nine',
            10 => 'ten',
            11 => 'eleven',
            12 => 'twelve',
            13 => 'thirteen',
            14 => 'fourteen',
            15 => 'fifteen',
            16 => 'sixteen',
            17 => 'seventeen',
            18 => 'eighteen',
            19 => 'nineteen',
        ] + $tys;

        $thousand = 1000;
        $million = pow($thousand, 2);
        $billion = $million * 1000;
        $trillion = $billion * 1000;
        $quadrillion = $trillion * 1000;
        $quintrillion = $quadrillion * 1000;

        $concat_words = function ($digit = null, $place = 'hundred') use ($number, $words) {
            $_digit = 100;
            if (!empty($digit)) $_digit = $digit / 1000;
            $data = self::convertNumToWords($number % $_digit);
            if ($data === 'zero') $data = null;
            if (!empty($data)) $data = ' and ' . $data;
            return (
                    empty($digit) 
                        ? $words[floor($number / 100)] 
                        : self::convertNumToWords(floor($number / $_digit))
                ) . " $place" . $data;
        };

        if ($number < 21) {
            return $words[$number] ?? null;
        } elseif ($number < 100) {
            $data = $words[$number % 10];
            if ($data === 'zero') $data = null;
            if (!empty($data)) $data = '-' . $data;
            return $words[10 * floor($number / 10)] . $data ;
        } 
       
        elseif ($number < $thousand) return $concat_words();
        elseif ($number < $million) return $concat_words($million, 'thousand');
        elseif ($number < $billion) return $concat_words($billion, 'million');
        elseif ($number < $trillion) return $concat_words($trillion, 'billion');
        elseif ($number < $quadrillion) return $concat_words($quadrillion, 'trillion');
        elseif ($number < $quintrillion) return $concat_words($quintrillion, 'quadrillion');
        else return 'Invalid Input.';
    }
    
}
