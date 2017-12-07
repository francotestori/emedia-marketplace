<?php

namespace App\Http\Controllers;

use App\Event;
use App\EventThreads;
use App\User;
use Carbon\Carbon;
use Cmgmyr\Messenger\Models\Message;
use Cmgmyr\Messenger\Models\Participant;
use Cmgmyr\Messenger\Models\Thread;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;

class MessagesController extends Controller
{
    /**
     * Show all of the message threads to the user.
     *
     * @return mixed
     */
    public function index()
    {
        // All threads, ignore deleted/archived participants
        // $threads = Thread::getAllLatest()->get();

        // All threads that user is participating in
        $threads = Thread::forUser(Auth::id())->latest('updated_at')->get();

        // All threads that user is participating in, with new messages
        // $threads = Thread::forUserWithNewMessages(Auth::id())->latest('updated_at')->get();

        return view('messaging.messenger.index', compact('threads'));
    }

    /**
     * Shows a message thread.
     *
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        try {
            $thread = Thread::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            Session::flash('error_message', 'The thread with ID: ' . $id . ' was not found.');

            return redirect()->route('messages');
        }

        // show current user in list if not a current participant
        // $users = User::whereNotIn('id', $thread->participantsUserIds())->get();

        // don't show the current user in list
        $userId = Auth::id();
        
        $allowed = $thread->participants()->pluck('user_id')->toArray();
        if(in_array($userId, $allowed)){
            $event = EventThreads::where('thread_id', $id)->first()->getEvent();
            $thread->markAsRead($userId);
            return view('messaging.messenger.show', compact('thread', 'users', 'event'));
        }

        Session::flash('error_message', 'FORBIDDEN');
        return redirect()->route('messages');
    }

    /**
     * Creates a new message thread.
     *
     * @return mixed
     */
    public function create()
    {
        // $users = User::where('id', '!=', Auth::id())->get();

        // return view('messaging.messenger.create', compact('users'));
    }

    /**
     * Stores a new message thread.
     *
     * @return mixed
     */
    public function store()
    {
        //TODO incluir charge al anunciante y luego flujo de validacion del mismo
        //TODO opcion de un mensaje generico de validacion que invoque MessagesController@validate
        //TODO opcion de rollback que le envía un email al manager del sitio MessagesController@rollbackCharge

        $event = Event::create([
            'addspace_id' => Input::get('reference'),
            'state' => 'PENDING'
        ]);

        $thread = Thread::create([
            'subject' => Input::get('subject'),
        ]);

        EventThreads::create([
            'event_id' => $event->id,
            'thread_id' => $thread->id
        ]);

        // Message
        Message::create([
            'thread_id' => $thread->id,
            'user_id' => Auth::id(),
            'body' => Input::get('message'),
        ]);

        // Sender
        Participant::create([
            'thread_id' => $thread->id,
            'user_id' => Auth::id(),
            'last_read' => new Carbon,
        ]);

        // Addspace Editor
        if (Input::has('recipient')) {
            $thread->addParticipant(Input::get('recipient'));
        }

        return redirect()->route('messages');
    }

    /**
     * Adds a new message to a current thread.
     *
     * @param $id
     * @return mixed
     */
    public function update($id)
    {
        try {
            $thread = Thread::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            Session::flash('error_message', 'The thread with ID: ' . $id . ' was not found.');

            return redirect()->route('messages');
        }

        // don't show the current user in list
        $userId = Auth::id();

        $allowed = $thread->participants()->pluck('user_id')->toArray();
        if(in_array($userId, $allowed)){
            $thread->activateAllParticipants();

            // Message
            Message::create([
                'thread_id' => $thread->id,
                'user_id' => Auth::id(),
                'body' => Input::get('message'),
            ]);

            return redirect()->route('messages.show', $id);
        }

        Session::flash('error_message', 'FORBIDDEN');
        return redirect()->route('messages');
    }
}
