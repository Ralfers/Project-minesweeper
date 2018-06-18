<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class GameController extends Controller
{
    public function randomGame(){
    	$seed = rand();
		$seed = base_convert($seed, 10, 26);

	    return view('welcome', array('seed' => $seed, 'daily' => false, 'store' => true));
    }

    public function seededGame() {
    	$seed = Input::get('seed');
    	if($seed){
    		return view('welcome', array('seed' => $seed, 'daily' => false, 'store' => false));
    	}
    	return view('enter_seed');
    }

    public function dailyGame(){
        $seed = '';
        return view('welcome', array('seed' => $seed, 'daily' => true, 'store' => true));
    }
}
