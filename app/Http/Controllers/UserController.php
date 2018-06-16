<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

use App\Score;
use App\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user-search');
    }

    public function search()
    {
        $username = Input::get('username');
        $user = User::where('name', $username)->first();
        if(!$user){
            return 0;
        }

        return $user->id;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $gameQuery = Score::where('user_id', $id);
        $games = $gameQuery->orderBy('id', 'desc')->take(10)->get();
        $add = true;
        if($id == Auth::user()->id){
            $add = false;
        }
        $count = $gameQuery->count();

        return view('profile_page', array(
            'games' => $games,
            'count' => $count,
            'add' => $add,
            'user_id' => $id
        ));
    }

    public function add()
    {
        $friend_id = Input::post('friend_id');
        $friend = User::FindOrFail($friend_id);
        $user = User::find(Auth::user()->id);
        $user->friends()->attach($friend_id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
