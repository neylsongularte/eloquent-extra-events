<?php

namespace NeylsonGularte\EloquentExtraEvents;

use Illuminate\Database\Eloquent\Relations\BelongsToMany as BelongsToManyEloquent;
use Illuminate\Contracts\Events\Dispatcher;


class BelongsToMany extends BelongsToManyEloquent {




    public function sync($ids, $detaching = true)
    {

        $baseEventData = array(
            'parentModel' => get_class($this->getParent()),
            'parent_id' => $this->getParent()->getKey(),
            'relatedModel' => get_class($this->getRelated())
        );

        $eventData = array_merge($baseEventData, ['related_ids' => $ids]);
        event('eloquent.syncing', [$eventData]);

        $changes = parent::sync($ids, $detaching);

        $eventData = array_merge($baseEventData, ['changes' => $changes]);
        event('eloquent.synced', [$eventData]);

        return $changes;
    }
}
