<?php

namespace App\Http\Controllers;

use App\Addspace;
use App\Category;
use App\Event;
use Cmgmyr\Messenger\Models\Thread;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AddspaceController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = Auth::user();

        $categories = Category::all();

        $filter = $request->query('category');

        if($filter == null)
            $addspaces = $user->isEditor() ? $user->addspaces()->get() : Addspace::all();
        else
            $addspaces = $user->isEditor() ? $user->addspaces()->whereHas('categories', function($q) use ($filter) {
                                                $q->where('name', $filter);
                                             })->get()

                                           : Addspace::whereHas('categories', function($q) use ($filter) {
                                                $q->where('name', $filter);
                                             })->get();
       
        return view('addspace.index', compact('addspaces', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();

        return view('addspace.create', compact('categories'));
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

        $categories = $addspace->categories()->get();

        $threads = $addspace->getUserThreads($user);

        return view('addspace.show', compact('addspace', 'categories', 'threads'));
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

        if(Auth::id() != $addspace->editor_id){
            Session::flash('message', Lang::get('messages.forbidden'));
            return redirect('addspaces');
        }

        $categories = Category::all();

        return view('addspace.edit', compact('addspace', 'categories'));
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
        else{
            $addspace = Addspace::find($id);
            $addspace->url = Input::get('url');
            $addspace->description = Input::get('description');
            $addspace->visits = Input::get('visits');
            $addspace->cost = Input::get('cost');
            $addspace->save();

            // redirect
            Session::flash('message', Lang::get('messages.edited', ['item' =>'Addspace']));
            return redirect('addspaces');
        }
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

        if(Auth::id() != $addspace->editor_id){
            Session::flash('message', Lang::get('messages.forbidden'));
            return redirect('addspaces');
        }

        $addspace->delete();

        Session::flash('message', Lang::get('messages.deleted', ['item' =>'Addspace']));

        return redirect('addspaces');
    }

    public function activate($id)
    {
        $addspace = Addspace::find($id);

        if(Auth::id() != $addspace->editor_id){
            Session::flash('message', Lang::get('messages.forbidden'));
            return redirect('addspaces');
        }

        $addspace->status = 'ACTIVE';
        $addspace->save();

        Session::flash('message', Lang::get('messages.activation', ['item' =>'Addspace']));

        return redirect('addspaces');

    }

    public function pause($id)
    {
        $addspace = Addspace::find($id);

        if(Auth::id() != $addspace->editor_id){
            Session::flash('message', Lang::get('messages.forbidden'));
            return redirect('addspaces');
        }

        $addspace->status = 'PAUSED';
        $addspace->save();

        Session::flash('message', Lang::get('messages.pause', ['item' =>'Addspace']));

        return redirect('addspaces');
    }

    public function close($id)
    {
        $addspace = Addspace::find($id);

        if(Auth::id() != $addspace->editor_id){
            Session::flash('message', Lang::get('messages.forbidden'));
            return redirect('addspaces');
        }

        $addspace->status = 'CLOSED';
        $addspace->save();

        Session::flash('message', Lang::get('messages.closed', ['item' =>'Addspace']));

        return redirect('addspaces');
    }
}
