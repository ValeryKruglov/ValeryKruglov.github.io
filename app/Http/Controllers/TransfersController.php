<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Carbon\Carbon;
use App\Transfer;
use App\User;

class TransfersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {

    }

    private function users_list() {
        $users_list = User::whereNotIn('id', [Auth::user()->id])->orderBy('name', 'asc')->get();

        return $users_list;
    }

    private function planned_and_available() {
        $planned = Transfer::where([
            ['from_user_id', Auth::user()->id],
            ['dateTime_transfer', '>', Carbon::now()]
        ])->sum('invoice_amount');
        $available = Auth::user()->balance - $planned;
        $available = round($available, 2);

        return compact('planned', 'available');
    }

    public function users() {
        $users_list = User::select('users.name as username','us_to.name as user_to_name','transfers.dateTime_transfer','transfers.invoice_amount','transfers.comment')
                            ->leftJoin(DB::raw('(SELECT MAX(dateTime_transfer) as max_date, from_user_id
                                                 FROM transfers
                                                    WHERE completed = 1
                                                    AND type = "another"
                                                    GROUP BY from_user_id) LastTr'),
                            function($join){
                                $join->on('LastTr.from_user_id', '=', 'users.id');
                            })
                            ->leftJoin('transfers', 'transfers.dateTime_transfer', '=', 'max_date')
                            ->leftJoin('users as us_to', 'us_to.id', '=', 'transfers.to_user_id')
                            ->orderBy('username', 'asc')
                            ->get();
                            // dd($users_list);
        return view('transfers.users', compact('users_list'));
    }
    
    public function plan() {
        $users_list = $this->users_list();
        $planned_and_available = $this->planned_and_available();
        
        $planned = $planned_and_available['planned'];
        $available = $planned_and_available['available'];

        return view('transfers.plan', compact('users_list','available','planned'));
    }

    public function plan_store(Request $request) {
        $planned_and_available = $this->planned_and_available();
        $available = $planned_and_available['available'];
        $users_id = $this->users_list()->pluck('id');

        $messages = [
            'username.required' => 'You must select the user who you want to transfer.',
            'username.integer' => 'Invalid user data.',
            'username.in' => 'Undefined user.',
            'date_pay.required' => 'You must select date transfer.',
            'summ.required' => 'The amount field is required.',
            'summ.between' => 'The minimum value of the amount field is 10 €, maximum payment amount '.$available.' €.',
        ];
        $this->validate($request,[
            'username' => [ 'required', 'integer', Rule::in($users_id) ],
            'date_pay' => [ 'required' ],
            'summ'     => [ 'required', 'numeric', 'between:10,'.$available ]
        ], $messages);

        $user = Auth::user();

        $transfer = new Transfer;
        $transfer->from_user_id = $user->id;
        $transfer->to_user_id = $request->get('username');
        $transfer->invoice_amount = $request->get('summ');
        $transfer->dateTime_transfer = $request->get('date_pay');
        $transfer->comment = $request->get('comment');
        $transfer->type = "another";
        $transfer->save();

        return redirect()->route('home');
    }

    public function send_transfer($id) {
        $planned_and_available = $this->planned_and_available();
        $available = $planned_and_available['available'];

        $transfer = Transfer::find($id);
        $transfer->dateTime_transfer = Carbon::now();
        $transfer->completed = true;
        $transfer->save();

        $user = Auth::user();
        $user->balance = $user->balance - $transfer->invoice_amount;
        $user->save();

        return redirect()->route('home');
    }

    public function balance() {
        return view('transfers.balance');
    }

    public function balance_store(Request $request) {
        $messages = [
            'summ.required' => 'The amount field is required.',
            'summ.min' => 'The minimum value of the amount field is 10€',
        ];
        $this->validate($request,[
            'summ' => [ 'required', 'numeric', 'min:10' ]
        ], $messages);

        $user = Auth::user();
        $user->balance = $user->balance + $request->get('summ');
        $user->save();

        $transfer = new Transfer;
        $transfer->from_user_id = $user->id;
        $transfer->to_user_id = $user->id;
        $transfer->invoice_amount = $request->get('summ');
        $transfer->dateTime_transfer = Carbon::now();
        $transfer->comment = "Top up amount";
        $transfer->type = "myself";
        $transfer->completed = true;
        $transfer->save();
        
        return redirect()->route('home');
    }
}
