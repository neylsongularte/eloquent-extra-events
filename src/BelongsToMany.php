<?php

namespace NeylsonGularte\EloquentExtraEvents;

use Illuminate\Database\Eloquent\Relations\BelongsToMany as BelongsToManyEloquent;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;


class BelongsToMany extends BelongsToManyEloquent
{


    public function sync($ids, $detaching = true)
    {
        $baseEventData = $this->getBaseEventData();

        $eventData = array_merge($baseEventData, ['related_ids' => $this->processIds($ids)]);
        event('eloquent.syncing: ' . $baseEventData['parent_model'], $eventData);

        $changes = parent::sync($ids, $detaching);

        $eventData = array_merge($baseEventData, ['changes' => $changes]);
        event('eloquent.synced: ' . $baseEventData['parent_model'], $eventData);

        return $changes;
    }

    public function attach($id, array $attributes = [], $touch = true)
    {
        $baseEventData = $this->getBaseEventData();

        $eventData = array_merge($baseEventData, ['related_ids' => $this->processIds($id)]);

        event('eloquent.attaching: ' . $baseEventData['parent_model'], $eventData);

        parent::attach($id, $attributes, $touch);

        event('eloquent.attached: ' . $baseEventData['parent_model'], $eventData);
    }


    public function detach($ids = [], $touch = true)
    {
        $baseEventData = $this->getBaseEventData();

        $eventData = array_merge($baseEventData, ['related_ids' => $this->processIds($ids)]);
        event('eloquent.detaching: ' . $baseEventData['parent_model'], $eventData);

        $results = parent::detach($ids, $touch);

        $eventData = array_merge($baseEventData, ['related_ids' => $this->processIds($ids), 'results' => $results]);
        event('eloquent.detached: ' . $baseEventData['parent_model'], $eventData);

        return $results;
    }

    protected function getBaseEventData()
    {
        return array(
            'parent_model'  => get_class($this->getParent()),
            'parent_id'     => $this->getParent()->getKey(),
            'related_model' => get_class($this->getRelated())
        );
    }

    public function processIds($ids)
    {
        if ($ids instanceof Collection) {
            $ids = $ids->modelKeys();
        }

        if ($ids instanceof Model) {
            $ids = $ids->getKey();
        }

        return (array) $ids;
    }

}
