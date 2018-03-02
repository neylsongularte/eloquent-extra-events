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

        $eventData = array_merge($baseEventData, ['related_ids_attributes' => $this->processIdsWithAttributes($ids)]);
        event('eloquent.syncing: ' . $baseEventData['parent_model'], $eventData);

        $changes = parent::sync($ids, $detaching);

        $eventData = array_merge($baseEventData, ['changes' => $changes]);
        event('eloquent.synced: ' . $baseEventData['parent_model'], $eventData);

        return $changes;
    }

    public function attach($id, array $attributes = [], $touch = true)
    {
        $baseEventData = $this->getBaseEventData();

        $eventData = array_merge($baseEventData, ['related_ids_attributes' => $this->processIdsWithAttributes($id, $attributes)]);

        event('eloquent.attaching: ' . $baseEventData['parent_model'], $eventData);

        parent::attach($id, $attributes, $touch);

        event('eloquent.attached: ' . $baseEventData['parent_model'], $eventData);
    }


    public function detach($ids = [], $touch = true)
    {
        $baseEventData = $this->getBaseEventData();

        $eventData = array_merge($baseEventData, ['related_ids_attributes' => $this->processIdsWithAttributes($ids)]);
        event('eloquent.detaching: ' . $baseEventData['parent_model'], $eventData);

        $results = parent::detach($ids, $touch);

        $eventData = array_merge($baseEventData, ['related_ids_attributes' => $this->processIdsWithAttributes($ids), 'results' => $results]);
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

    public function processIdsWithAttributes($ids, $attributes = [])
    {
        $pivotAttributes = [];
        if ($ids instanceof Model) {
            $pivotAttributes[$ids->getKey()] = $attributes;
        } elseif ($ids instanceof Collection) {
            foreach ($ids as $model) {
                $pivotAttributes[$model->getKey()] = $attributes;
            }
        } elseif (is_array($ids)) {
            foreach ($ids as $key => $attributesArray) {
                if (is_array($attributesArray)) {
                    $pivotAttributes[$key] = array_merge($attributes, $attributesArray);
                } else {
                    $pivotAttributes[$attributesArray] = $attributes;
                }
            }
        } elseif (is_int($ids) || is_string($ids)) {
            $pivotAttributes[$ids] = $attributes;
        }
        return $pivotAttributes;
    }

}
