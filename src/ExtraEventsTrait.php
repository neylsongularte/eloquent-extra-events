<?php

namespace NeylsonGularte\EloquentExtraEvents;

// use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait ExtraEventsTrait {




    // public function extraEventsWrapper($object)
    // {
    //     if($object instanceof BelongsToMany) {
    //         return new BelongsToManyWrapper(static::$dispatcher, $object);
    //     }
    //
    //     throw new Exception("Objeto não suportado!", 1);
    // }

    public function belongsToMany($related, $table = null, $foreignKey = null, $otherKey = null, $relation = null)
    {
        return (BelongsToManyWrapper) $this->belongsToMany($related, $table, $foreignKey, $otherKey, $relation);
    }
}
