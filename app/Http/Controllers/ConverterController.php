<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Word;
use App\Models\Number;

class ConverterController extends Controller
{

    public function convert(Request $request) {

        $data = $request->data ?? '';

        // $converted_data = Word::toNumber($data);
        $converted_data = Number::toWords($data);

        return view('home', compact('data', 'converted_data'));

    }

}
