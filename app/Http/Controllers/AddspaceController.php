<?php

namespace App\Http\Controllers;

use App\Addspace;
use App\Category;
use App\Event;
use App\EventThreads;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\DataTables;

class AddspaceController extends Controller
{

    private $categories;

    public function __construct()
    {
        $this->categories = Category::all();
        View::share('categories', $this->categories);
    }

    public function index(Request $request)
    {
        $user = Auth::user();

        $filter = $request->query('category');

        $addspaces = $user->isEditor() ? $user->addspaces()->whereHas('categories', function($query) use ($filter) {
                                            is_null($filter) ? $query : $query->where('name', $filter);
                                         })->get()

                                       : Addspace::whereHas('categories', function($query) use ($filter) {
                                            is_null($filter) ? $query : $query->where('name', $filter);
                                         })->get();
       
        return view('addspace.index', compact('addspaces'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('addspace.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = array(
            'url' => 'required|url',
            'description' => 'required|string',
            'visits' => 'required|numeric',
            'cost' => 'required|numeric'
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return redirect('addspaces/create')
                ->withErrors($validator)
                ->withInput(Input::all());
        }
        else {
            $addspace = Addspace::create([
                'url' => Input::get('url'),
                'description' => Input::get('description'),
                'visits' => Input::get('visits'),
                'cost' => Input::get('cost'),
                'editor_id' => Auth::user()->id,
            ]);

            foreach(Input::get('categories') as $category_id){
                $category = Category::find($category_id);
                if($category != null)
                    $addspace->categories()->attach($category);
            }

            // redirect
            Session::flash('message', Lang::get('messages.created', ['item' =>'Addspace']));
            return redirect('addspaces');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if("create" == $id)
            return $this->create();

        $user = Auth::user();

        $addspace = Addspace::find($id);

        $threads = $addspace->getUserThreads($user);

        $events = array();
        foreach($threads as $thread){
            $et = EventThreads::where('thread_id', $thread->id)->first();
            $event = Event::find($et->id);
            array_push($events, $event);
        }

        $events = array_filter($events, function($single_event){
            return $single_event->pending();
        });

        return view('addspace.show', compact('addspace', 'threads', 'events'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $addspace = Addspace::find($id);

        if(Auth::user()->isManager() || Auth::id() == $addspace->editor_id)
            return view('addspace.edit', compact('addspace', 'categories'));

        Session::flash('message', Lang::get('messages.forbidden'));
        return redirect('addspaces');
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
        $addspace = Addspace::find($id);

        if(Auth::user()->isManager() || Auth::id() == $addspace->editor_id)
        {
            $rules = array(
                'url' => 'required|url',
                'description' => 'required|string',
                'visits' => 'required|numeric',
                'cost' => 'required|numeric'
            );

            $validator = Validator::make(Input::all(), $rules);

            if ($validator->fails()) {
                return redirect('addspaces'.$id.'/edit')
                    ->withErrors($validator)
                    ->withInput(Input::all());
            }

            $addspace->url = Input::get('url');
            $addspace->description = Input::get('description');
            $addspace->visits = Input::get('visits');
            $addspace->cost = Input::get('cost');
            $addspace->save();

            Session::flash('message', Lang::get('messages.edited', ['item' =>'Addspace']));
            return redirect('addspaces');
        }

        Session::flash('message', Lang::get('messages.forbidden'));
        return redirect('addspaces');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $addspace = Addspace::find($id);

        if(Auth::user()->isManager() || Auth::id() == $addspace->editor_id)
        {
            $addspace->delete();

            Session::flash('message', Lang::get('messages.deleted', ['item' =>'Addspace']));
            return redirect('addspaces');
        }

        Session::flash('message', Lang::get('messages.forbidden'));
        return redirect('addspaces');
    }

    public function activate($id)
    {
        $addspace = Addspace::find($id);

        if(Auth::user()->isManager() || Auth::id() == $addspace->editor_id)
        {
            $addspace->status = 'ACTIVE';
            $addspace->save();

            Session::flash('status', Lang::get('messages.activated', ['item' =>'Addspace']));
            return redirect()->route('addspaces.show', $id);
        }

        Session::flash('errors', Lang::get('messages.forbidden'));
        return redirect()->route('addspaces.show', $id);
    }

    public function pause($id)
    {
        $addspace = Addspace::find($id);

        if(Auth::user()->isManager() || Auth::id() == $addspace->editor_id)
        {
            $addspace->status = 'PAUSED';
            $addspace->save();

            Session::flash('status', Lang::get('messages.paused', ['item' =>'Addspace']));
            return redirect()->route('addspaces.show', $id);
        }

        Session::flash('errors', Lang::get('messages.forbidden'));
        return redirect()->route('addspaces.show', $id);
    }

    public function close($id)
    {
        $addspace = Addspace::find($id);

        if(Auth::user()->isManager() || Auth::id() == $addspace->editor_id)
        {
            $addspace->status = 'CLOSED';
            $addspace->save();

            Session::flash('status', Lang::get('messages.closed', ['item' =>'Addspace']));
            return redirect()->route('addspaces.show', $id);
        }

        Session::flash('errors', Lang::get('messages.forbidden'));
        return redirect()->route('addspaces.show', $id);
    }
}
