<?php

namespace App\Http\Controllers;

use App\Addspace;
use App\Event;
use App\Profit;
use App\User;
use Carbon\Carbon;
use Cmgmyr\Messenger\Models\Thread;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        View::share('advertisers', User::where('role_id', 2)->get());
        View::share('editors', User::where('role_id', 1)->get());
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $threads = Thread::forUser($user->id)->latest('updated_at')->get()->take(5);
        $transactions = $this->getHomeTransactions($user)->take(5);
        return view('home', compact('user', 'threads', 'transactions'));
    }

    private function getHomeTransactions($user){
        if($user->isEditor()){
            $transactions = $user->getWallet()->getCredits()
                ->filter(function($transaction){
                    return $transaction->getEvent() != null;
                })
                ->map(function($transaction){
                $event = $transaction->getEvent();
                return [
                    'id' =>$transaction->id,
                    'url' => $event->getAddspace()->url,
                    'date' => Carbon::parse($transaction->created_at),
                    'amount' => $transaction->amount,
                    'user' => $transaction->getSender()->getUser()->name,
                    'state' => $event->state,
                    'thread_id' => $event->getThread()->id,
                ];
            });
        }
        else{
            $transactions = $user->getWallet()->getDebits()
                ->filter(function($transaction){return $transaction->getEvent() != null;})
                ->groupBy('event_id')
                ->map(function ($group) use ($user){
                    $data = $group[0];
                    $event_id = $data['event_id'];
                    $event = Event::find($event_id);
                    $amount = collect($group)->reduce(function($sum, $transaction){return $sum + $transaction['amount'];});
                    return [
                        'id' =>$data['id'],
                        'url' => $event->getAddspace()->url,
                        'date' => Carbon::parse($data->created_at),
                        'amount' => $amount,
                        'user' => $event->getAddspace()->getEditor()->name,
                        'state' => $event->state,
                        'thread_id' => $event->getThread()->id,
                    ];
                });

        }

        return $transactions;

    }

    public function profits()
    {
        $profits = Profit::all();

        $clusters = array_chunk(Addspace::all()->toArray(), 3);

        return view('profits.index', compact('profits', 'clusters'));

    }
}
