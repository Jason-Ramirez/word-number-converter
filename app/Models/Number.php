<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Number extends Model
{
    use HasFactory;

    public static function convertNumToWords($number) {

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
        
        // elseif ($number < 1000) { // @remind clear
        //     $data = self::convertNumToWords($number % 100);
        //     if ($data === 'zero') $data = null;
        //     if (!empty($data)) $data = ' and ' . $data;
        //     return $words[floor($number / 100)] . ' hundred' . $data;
        // } 
        // elseif ($number < 1000000) {
        //     $data = self::convertNumToWords($number % 1000);
        //     if ($data === 'zero') $data = null;
        //     if (!empty($data)) $data = ' and ' . $data;
        //     return self::convertNumToWords(floor($number / 1000)) . ' thousand' . $data;
        // } 
        // elseif ($number < 1000000000) {
        //     $data = self::convertNumToWords($number % 1000000);
        //     if ($data === 'zero') $data = null;
        //     if (!empty($data)) $data = ' and ' . $data;
        //     return self::convertNumToWords(floor($number / 1000000)) . ' million' . $data;
        // } elseif ($number < 1000000000000) {
        //     $data = self::convertNumToWords($number % 1000000000);
        //     if ($data === 'zero') $data = null;
        //     if (!empty($data)) $data = ' and ' . $data;
        //     return self::convertNumToWords(floor($number / 1000000000)) . ' billion' . $data;
        // } elseif ($number < 1000000000000000) {
        //     $data = self::convertNumToWords($number % 1000000000000);
        //     if ($data === 'zero') $data = null;
        //     if (!empty($data)) $data = ' and ' . $data;
        //     return self::convertNumToWords(floor($number / 1000000000000)) . ' trillion' . $data;
        // } elseif ($number < 1000000000000000000) {
        //     $data = self::convertNumToWords($number % 1000000000000000);
        //     if ($data === 'zero') $data = null;
        //     if (!empty($data)) $data = ' and ' . $data;
        //     return self::convertNumToWords(floor($number / 1000000000000000)) . ' quadrillion' . $data;
        // }

        elseif ($number < $thousand) return $concat_words();
        elseif ($number < $million) return $concat_words($million, 'thousand');
        elseif ($number < $billion) return $concat_words($billion, 'million');
        elseif ($number < $trillion) return $concat_words($trillion, 'billion');
        elseif ($number < $quadrillion) return $concat_words($quadrillion, 'trillion');
        elseif ($number < $quintrillion) return $concat_words($quintrillion, 'quadrillion');
        else 'Invalid Input.';


















        // $words = array(
        //     '0' => 'zero',
        //     '1' => 'one',
        //     '2' => 'two',
        //     '3' => 'three',
        //     '4' => 'four',
        //     '5' => 'five',
        //     '6' => 'six',
        //     '7' => 'seven',
        //     '8' => 'eight',
        //     '9' => 'nine',
        //     '10' => 'ten',
        //     '11' => 'eleven',
        //     '12' => 'twelve',
        //     '13' => 'thirteen',
        //     '14' => 'fourteen',
        //     '15' => 'fifteen',
        //     '16' => 'sixteen',
        //     '17' => 'seventeen',
        //     '18' => 'eighteen',
        //     '19' => 'nineteen',
        //     '20' => 'twenty',
        //     '30' => 'thirty',
        //     '40' => 'forty',
        //     '50' => 'fifty',
        //     '60' => 'sixty',
        //     '70' => 'seventy',
        //     '80' => 'eighty',
        //     '90' => 'ninety'
        // );
        
        // if (array_key_exists(strval($number), $words)) {
        //     return $words[strval($number)];
        // }
        
        // $output = '';
        
        // if ($number < 100) {
        //     $tens = floor($number / 10) * 10;
        //     $units = $number % 10;
        //     $output = $words[strval($tens)];
        //     if ($units) {
        //         $output .= ' ' . $words[strval($units)];
        //     }
        // } else {
        //     $hundred = floor($number / 100);
        //     $remainder = $number % 100;
        //     $output = $words[strval($hundred)] . ' hundred';
        //     if ($remainder) {
        //         $output .= ' and ' . numberToWords($remainder);
        //     }
        // }
        
        // return $output;
    }

    public static function toWords($number)
    {
        // $base_10 = [
        //     'hundred' => 100,
        //     'thousand' => 1000,
        //     'million' => 1000000,
        //     'billion' => 1000000000,
        //     'trillion' => 1000000000000,
        //     'quadrillion' => 1000000000000000,
        //     'quintrillion' => 1000000000000000000,
        //     'sextillion' => 1000000000000000000000
        // ];
        // $number_words = [
        //     0 => 'zero',
        //     1 => 'one',
        //     2 => 'two',
        //     3 => 'three',
        //     4 => 'four',
        //     5 => 'five',
        //     6 => 'six',
        //     7 => 'seven',
        //     8 => 'eight',
        //     9 => 'nine',
        //     10 => 'ten',
        //     11 => 'eleven',
        //     12 => 'twelve',
        //     13 => 'thirteen',
        //     14 => 'fourteen',
        //     15 => 'fifteen',
        //     16 => 'sixteen',
        //     17 => 'seventeen',
        //     18 => 'eighteen',
        //     19 => 'nineteen',
        //     20 => 'twenty',
        //     30 => 'thirty',
        //     40 => 'forty',
        //     50 => 'fifty',
        //     60 => 'sixty',
        //     70 => 'seventy',
        //     80 => 'eighty',
        //     90 => 'ninety',
        // ] + $base_10;

        // $str_num = strval($number);


        
            // $hyphen      = '-';
            // $conjunction = ' and ';
            // $separator   = ', ';
            // $negative    = 'negative ';
            // $decimal     = ' point ';
            // $dictionary  = array(
            //     0                   => 'zero',
            //     1                   => 'one',
            //     2                   => 'two',
            //     3                   => 'three',
            //     4                   => 'four',
            //     5                   => 'five',
            //     6                   => 'six',
            //     7                   => 'seven',
            //     8                   => 'eight',
            //     9                   => 'nine',
            //     10                  => 'ten',
            //     11                  => 'eleven',
            //     12                  => 'twelve',
            //     13                  => 'thirteen',
            //     14                  => 'fourteen',
            //     15                  => 'fifteen',
            //     16                  => 'sixteen',
            //     17                  => 'seventeen',
            //     18                  => 'eighteen',
            //     19                  => 'nineteen',
            //     20                  => 'twenty',
            //     30                  => 'thirty',
            //     40                  => 'fourty',
            //     50                  => 'fifty',
            //     60                  => 'sixty',
            //     70                  => 'seventy',
            //     80                  => 'eighty',
            //     90                  => 'ninety',
            //     100                 => 'hundred',
            //     1000                => 'thousand',
            //     1000000             => 'million',
            //     1000000000          => 'billion',
            //     1000000000000       => 'trillion',
            //     1000000000000000    => 'quadrillion',
            //     1000000000000000000 => 'quintillion'
            // );
            
            $words = self::convertNumToWords($number);
            // if ($words !== 'zero') $words = str_replace('zero', '', $words);
            return $words;
    }
    
}
