<?php

namespace App;

use Cmgmyr\Messenger\Models\Thread;
use Illuminate\Database\Eloquent\Model;

class Addspace extends Model
{
    protected $fillable = [
        'url', 'description', 'visits', 'cost','editor_id'
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function editor(){
        return $this->belongsTo(User::class,'editor_id');
    }

    public function events(){
        return $this->hasMany(Event::class);
    }

    public function getEditor()
    {
        return $this->editor()->first();
    }

    public function getCategories()
    {
        return $this->categories()->get();
    }

    public function getEvents()
    {
        return $this->events()->get();
    }

    public function getThreads()
    {
        $eventThreads = EventThreads::whereIn('event_id', $this->events()->pluck('id')->toArray())
            ->pluck('thread_id')
            ->toArray();

        return Thread::whereIn('id', $eventThreads)
            ->latest('updated_at')
            ->get();

    }

    /**
     * @param $user
     * @return mixed
     */
    public function getUserThreads($user)
    {
        $eventThreads = EventThreads::whereIn('event_id', $this->events()->pluck('id')->toArray())
            ->pluck('thread_id')
            ->toArray();

        if($user->isEditor())
            return Thread::forUser($user->id)
                           ->where('subject','like','%'.$this->url.'%')
                           ->latest('updated_at')
                           ->get();
        else
            return Thread::between([$this->getEditor()->id, $user->id])
                                         ->whereIn('id', $eventThreads)
                                         ->latest('updated_at')
                                         ->get();
    }
}
