<?php

namespace App\Http\Controllers;

use App\Addspace;
use App\Category;
use App\Event;
use App\EventThreads;
use App\Profit;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;

class AddspaceController extends Controller
{

    private $categories;
    private $search_categories;
    private $editors;

    public function __construct()
    {
        $this->categories = Category::orderBy('name', 'asc')->get();
        View::share('categories', $this->categories);

        $used_categories = DB::table('addspace_category')->distinct('category_id')->pluck('category_id')->toArray();
        $this->search_categories = Category::whereIn('id', $used_categories)->orderBy('name', 'asc')->get();
        View::share('search_categories', $this->search_categories);

        $role = Role::where('name', 'Editor')->first();
        $this->editors = User::where('role_id', $role->id)->get();
        View::share('editors', $this->editors);
    }

    private function retrieveMetrics($user)
    {
        return $user->isEditor()
            ? [
                'all' => Auth::user()->addspaces()->count(),
                'active' => Auth::user()->addspaces()->where('status', 'ACTIVE')->count(),
                'paused' => Auth::user()->addspaces()->where('status', 'PAUSED')->count(),
                'closed' => Auth::user()->addspaces()->where('status', 'CLOSED')->count(),
            ]
            : [
                'all' => Addspace::count(),
                'active' => Addspace::where('status', 'ACTIVE')->count(),
                'paused' => Addspace::where('status', 'PAUSED')->count(),
                'closed' => Addspace::where('status', 'CLOSED')->count(),
            ]
        ;
    }

    public function index(Request $request)
    {
        $user = Auth::user();

        $filter = $request->query('category');
        $status = $request->query('status');

        $addspaces = $user->isEditor() ? $user->addspaces() : Addspace::query();

        if($filter  != null)
            $addspaces = $addspaces->whereHas('categories', function($query) use ($filter) {
                is_null($filter) ? $query : $query->where('name', $filter);
            });

        if($status != null)
            $addspaces = $addspaces->where('status', $status);

        $addspaces = $addspaces->get();
        $metrics = $this->retrieveMetrics($user);

        $selected_categories = Collection::make([]);
        return view('addspace.index', compact('addspaces', 'selected_categories', 'metrics'));
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

    private function getProfit($price)
    {
        $profit = Profit::where([
            ['from_range', '<', $price],
            ['to_range', '>=', $price]
        ])->first();

        return empty($profit) ? 0 : $profit->value;
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
            'url' => 'required',
            'description' => 'required|string',
            'visits' => 'required|numeric',
            'cost' => 'required|numeric'
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails())
        {
            return redirect('addspaces/create')
                ->withErrors($validator)
                ->withInput(Input::all());
        }
        else
        {

            $profit = $this->getProfit(Input::get('cost'));


            $url = substr( Input::get('url'), 0, 7 ) === "http://" ? Input::get('url') : 'http://'.Input::get('url');

            $addspace = Addspace::create([
                'url' => $url,
                'description' => Input::get('description'),
                'visits' => Input::get('visits'),
                'periodicity' => Input::get('periodicity'),
                'cost' => Input::get('cost'),
                'profit' => $profit,
                'editor_id' => Auth::user()->id,
            ]);

            $addspace->language = Input::get('language', 'ES');
            $addspace->save();

            if(count(Input::get('categories')))
            {
                foreach(Input::get('categories') as $category_id){
                    $category = Category::find($category_id);
                    if($category != null)
                        $addspace->categories()->attach($category);
                }
            }

            Session::flash('status', Lang::get('messages.created', ['item' =>'Addspace']));
            return redirect('addspaces');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        if("create" == $id)
            return $this->create();
        elseif("search" == $id)
            return $this->search($request);

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
        $addspace_categories = $addspace->categories()->pluck('categories.id')->toArray();

        if((Auth::user()->isManager() || Auth::id() == $addspace->editor_id) && !$addspace->isClosed())
            return view('addspace.edit', compact('addspace', 'addspace_categories'));

        Session::flash('errors', Lang::get('messages.forbidden'));
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

        if((Auth::user()->isManager() || Auth::id() == $addspace->editor_id) && !$addspace->isClosed())
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
            $addspace->periodicity = Input::get('periodicity');
            $addspace->cost = Input::get('cost');

            if(!$addspace->admin_profit)
            {
                $profit = $this->getProfit(Input::get('cost'));
                $addspace->profit = $profit;
            }

            $addspace->language = Input::get('language', 'ES');

            $addspace->save();

            Session::flash('status', Lang::get('messages.edited', ['item' =>'Addspace']));
            return redirect('addspaces');
        }

        Session::flash('errors', Lang::get('messages.forbidden'));
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

            Session::flash('status', Lang::get('messages.deleted', ['item' =>'Addspace']));
            return redirect('addspaces');
        }

        Session::flash('status', Lang::get('messages.forbidden'));
        return redirect('addspaces');
    }

    public function activate($id)
    {
        $addspace = Addspace::find($id);

        if((Auth::user()->isManager() || Auth::id() == $addspace->editor_id) && !$addspace->isClosed())
        {
            $addspace->status = 'ACTIVE';
            $addspace->save();

            Session::flash('status', Lang::get('messages.activated', ['item' =>'Addspace']));
            return redirect()->back();
        }

        Session::flash('errors', Lang::get('messages.forbidden'));
        return redirect()->back();
    }

    public function pause($id)
    {
        $addspace = Addspace::find($id);

        if(Auth::user()->isManager() || Auth::id() == $addspace->editor_id)
        {
            $addspace->status = 'PAUSED';
            $addspace->save();

            Session::flash('status', Lang::get('messages.paused', ['item' =>'Addspace']));
            return redirect()->back();
        }

        Session::flash('errors', Lang::get('messages.forbidden'));
        return redirect()->back();
    }

    public function close($id)
    {
        $addspace = Addspace::find($id);

        if(Auth::user()->isManager() || Auth::id() == $addspace->editor_id)
        {
            $addspace->status = 'CLOSED';
            $addspace->save();

            Session::flash('status', Lang::get('messages.closed', ['item' =>'Addspace']));
            return redirect()->back();
        }

        Session::flash('errors', Lang::get('messages.forbidden'));
        return redirect()->back();
    }

    public function search(Request $request)
    {
        $request->flush();

        $addspaces = Addspace::where('status','ACTIVE')->get();

        $clusters = array_chunk($addspaces->toArray(), 3);
        return view('addspace.search.index', compact('clusters'));
    }

    public function indexFilter(Request $request)
    {
        $user = Auth::user();

        $query_addspaces = $user->isEditor() ? $user->addspaces() : Addspace::query();

        $selected_categories = Collection::make();

        if(Input::has('categories'))
        {
            $categories = Input::get('categories');
            $query_addspaces = $query_addspaces->whereHas('categories', function($query) use ($categories) {
                is_null($categories) ? $query : $query->whereIn('name', $categories);
            });

            $selected_categories = Category::whereIn('name', $categories)->get();
        }

        if(Input::has('status') && Input::get('status') != null)
            $query_addspaces = $query_addspaces->where('status', Input::get('status'));

        $addspaces = $query_addspaces->get();
        $metrics = $this->retrieveMetrics($user);

        $request->flash();
        return view('addspace.index', compact('addspaces', 'selected_categories', 'metrics'));
    }

    public function filter(Request $request)
    {
        $addspaces = Addspace::query()->where('status', 'ACTIVE');

        if(Input::has('editors'))
        {
            $editors = Input::get('editors');
            $addspaces = $addspaces->whereIn('editor_id',$editors);
        }

        if(Input::has('categories'))
        {
            $categories = Input::get('categories');
            $addspaces = $addspaces->whereHas('categories', function($query) use ($categories) {
                is_null($categories) ? $query : $query->whereIn('name', $categories);
            });
        }

        if(Input::filled('url'))
            $addspaces = $addspaces->where('url', 'like' , '%'.Input::get('url').'%');


        $addspaces = $addspaces->get();

        if(Input::filled('price')){
            $min_price = explode(',',Input::get('price'))[0];
            $max_price = explode(',',Input::get('price'))[1];
            $addspaces = $addspaces->filter(function ($addspace) use ($min_price, $max_price){
                return $addspace->getCost() >= $min_price && $addspace->getCost() <= $max_price;
            });
        }

        switch (Input::get('frequency')){
            case 'month':
                $min_visits = explode(',',Input::get('visits'))[0] / 30;
                $max_visits = explode(',',Input::get('visits'))[1] / 30;
                break;
            case 'week':
                $min_visits = explode(',',Input::get('visits'))[0] / 7;
                $max_visits = explode(',',Input::get('visits'))[1] / 7;
                break;
            default:
                $min_visits = explode(',',Input::get('visits'))[0];
                $max_visits = explode(',',Input::get('visits'))[1];
                break;
        }

        $addspaces = $addspaces->filter(function($addspace) use($min_visits, $max_visits){
            switch ($addspace->periodicity){
                case 'month':
                    return ($addspace->visits / 30) >= $min_visits && ($addspace->visits / 30) <= $max_visits;
                    break;
                case 'week':
                    return ($addspace->visits / 7) >= $min_visits && ($addspace->visits / 7) <= $max_visits;
                    break;
                default:
                    return $addspace->visits >= $min_visits && $addspace->visits <= $max_visits;
                    break;
            }
        });

        if(Input::get('order'))
            $addspaces = $addspaces->sortBy(function($addspace){
                return $addspace->getCost();
            });
        else
            $addspaces = $addspaces->sortByDesc(function($addspace){
                return $addspace->getCost();
            });

        $clusters = array_chunk($addspaces->toArray(), 3);
        $request->flash();
        return view('addspace.search.index', compact('clusters'));
    }
}
