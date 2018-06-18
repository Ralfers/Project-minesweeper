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
        return view('user_search');
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
        $currentUser = User::FindOrFail($id);

        $gameQuery = Score::where('user_id', $id);
        $games = $gameQuery->orderBy('id', 'desc')->take(10)->get();
        $add = true;
        $editable = false;
        if($id == Auth::user()->id){
            $add = false;
            $editable = true;
        }

        $friendIds = User::FindOrFail(Auth::user()->id)->friends()->pluck('friend_id')->toArray();
        if(in_array($id, $friendIds)){
            $add = false;
        }        

        $link = $currentUser->avatar;
        if(!$link){
            $link = 'https://thesocietypages.org/socimages/files/2009/05/nopic_192.gif';
        }

        $count = $gameQuery->count();

        $friendIds = $currentUser->friends()->where('friend_id', '!=', $id)->pluck('friend_id')->toArray();
        $friends = User::whereIn('id', $friendIds)->get();

        return view('profile_page', array(
            'games' => $games,
            'count' => $count,
            'add' => $add,
            'editable' => $editable,
            'user_id' => $id,
            'friends' => $friends,
            'link' => $link
        ));
    }

    public function add()
    {
        $friend_id = Input::post('friend_id');
        $friend = User::FindOrFail($friend_id);
        $user = User::find(Auth::user()->id);
        $user->friends()->attach($friend_id);
    }

    public function changeAvatar()
    {
        $link = Input::post('link');
        $user = Auth::user();
        $user->avatar = $link;
        $user->save();
    }

    public function changeHome()
    {
        $home = Input::post('home');
        $user = Auth::user();
        $user->homepage = $home;
        $user->save();
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
