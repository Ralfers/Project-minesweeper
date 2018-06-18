<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Score;
use App\User;

class ScoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userId = Auth::user()->id;
        $userRole = Auth::user()->role;

        $ownScores = Score::where('user_id', $userId)->orderBy('id', 'desc')->take(10)->get();

        if($userRole != 1){
            $userIds = User::FindOrFail($userId)->friends()->pluck('friend_id')->toArray();
            $userScores = Score::whereIn('user_id', $userIds)->orderBy('id', 'desc')->take(10)->get();
        }
        else{
            $userScores = Score::orderBy('id', 'desc')->get();
        }

        return view('show_scores', array('scores' => $ownScores, 'userScores' => $userScores));
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

        $score = new Score();
        $score->user_id = Auth::user()->id;
        $score->score = $request->input('score');
        $score->is_daily = $request->input('daily');

        $score->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
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
        Score::FindOrFail($id)->delete();
    }
}
