<?php

namespace NeylsonGularte\EloquentExtraEvents;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Contracts\Events\Dispatcher;


class BelongsToManyWrapper extends BelongsToMany {

    // protected $dispatcher;
    // protected $belongsToMany;
    //
    // public function __construct(Dispatcher $dispatcher, BelongsToMany $belongsToMany)
    // {
    //     $this->dispatcher = $dispatcher;
    //     $this->belongsToMany = $belongsToMany;
    // }

    public function sync($ids, $detaching = true)
    {
        dd('joinha');
        
        $baseEventData = array(
            'parentModel' => get_class($this->$belongsToMany()->getParent()),
            'parent_id' => $this->getKey(),
            'relatedModel' => get_class($this->$belongsToMany()->getRelated())
        );

        dd($baseEventData);

        $eventData = array_merge($baseEventData, ['related_ids' => $ids]);
        $this->dispatcher->fire('eloquent.syncing', [$eventData]);

        $changes = $this->belongsToMany->sync($ids, $detaching);

        $eventData = array_merge($baseEventData, ['changes' => $changes]);
        $this->dispatcher->fire('eloquent.synced', [$eventData]);

        return $changes;
    }
}
