<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class LangController extends Controller
{
    public function change()
	{
		$lang = Input::get('lang');

		if(Auth::check()){
			$user = Auth::user();
			$user->locale = $lang;
			$user->save();

			\App::setLocale($lang);
		}
		else{
			\Session::put('locale',$lang);

			\App::setLocale($lang);
		}

		return back();
	}
}
