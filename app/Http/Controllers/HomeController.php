<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Transfer;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        $users_list = User::all();
        $planned_transfers = Transfer::where([
                ['from_user_id', $user->id],
                ['dateTime_transfer', '>', Carbon::now()]
            ])->orderBy('dateTime_transfer', 'asc')->get();
        $transfers = Transfer::where([
                ['from_user_id', $user->id],
                ['dateTime_transfer', '<', Carbon::now()]
            ])->orderBy('dateTime_transfer', 'desc')->limit(5)->get();
        return view('layouts.home', compact('transfers', 'users_list', 'planned_transfers'));
    }

}
