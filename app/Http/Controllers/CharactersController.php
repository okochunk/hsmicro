<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CharactersController extends Controller
{

	public function index(Request $request)
    {
        	$input1 = strtolower('ABBCD');
        	$input2 = strtolower('Gallant Duck');

        	$input1_arr = str_split($input1);
        	$input2_arr = str_split($input2);

        	$input1_uniq = array_unique($input1_arr);
        	$input2_uniq = array_unique($input2_arr);

        	$count = 0;
        	foreach($input1_uniq as $char) {
        		if (in_array($char, $input2_uniq)) {
        			$count++;
        			$alphabets[] = $char;
        		}
        	}

        	$percentage = ($count / count($input1_arr)) * 100;

        return view('admin/characters/index', compact('input1', 'input2', 'percentage', 'alphabets'));
    }

}