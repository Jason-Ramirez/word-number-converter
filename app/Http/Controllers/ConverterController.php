<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Word;
use App\Models\Number;

class ConverterController extends Controller
{

    public function convert(Request $request) {
        $data = $request->data ?? '';
        $converted_data = null;
        $php_currency = null;
        $usd_currency = null;
        $int_cleaned = str_replace(',', '', $data);
        $int_cleaned = str_replace(' ', '', $int_cleaned);
        if (is_numeric($int_cleaned)) {
            $converted_data = Number::toWords(intval($int_cleaned));
            $php_currency = $int_cleaned;
        }
        else {
            $converted_data = Word::toNumber($data);
            $php_currency = $converted_data;

        }
        if (!empty($converted_data)) {
            try {
                $url = env("CURRECY_EXCHANGE_API");
                $header = [
                    'apikey: ' . env('CURRECY_EXCHANGE_API_KEY'),
                ];
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
                curl_setopt($ch, CURLOPT_TIMEOUT, 30);
                $err_description = curl_error($ch);
                $result = curl_exec($ch);
                curl_close($ch);
                if (empty($err_description)) {
                    $currencies = json_decode($result);
                    $usd_php = $currencies->data->PHP ?? 1;
                    $usd_currency = floatval($php_currency) / floatval($usd_php);
                }
                else throw new \Exception($err_description);
            } catch (\Throwable $th) {
                $converted_data = $th->getMessage();
            }
        } else $converted_data = 'Error: Invalid input.';

        return view('home', compact('data', 'converted_data', 'php_currency', 'usd_currency'));
    }

}
