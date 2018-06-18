<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class HomeController extends Controller
{
    public function index()
    {
    	$user = Auth::user();
    	if(!$user){
    		$request = Request::create('/game', 'GET');
        	return \Route::dispatch($request)->getContent();
    	}

    	switch ($user->homepage) {
    		case 0:
				$request = Request::create('/game', 'GET');
    			break;
    		case 1:
    			$request = Request::create('/daily', 'GET');
    			break;
    		case 2:
    			$request = Request::create('/scores', 'GET');
    			break;
    		case 3:
    			$request = Request::create('/users/'.$user->id, 'GET');
    			break;
    		default:
    			$request = Request::create('/game', 'GET');
    			break;
    	}
    	return \Route::dispatch($request)->getContent();
    }
}
