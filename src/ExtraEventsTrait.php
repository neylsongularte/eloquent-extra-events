<?php

namespace NeylsonGularte\EloquentExtraEvents;


use App;

// Trait for models
trait ExtraEventsTrait {



    public function belongsToMany($related, $table = null, $foreignKey = null, $otherKey = null, $relation = null)
    {

        $belongsToMany = parent::belongsToMany($related, $table, $foreignKey, $otherKey, $relation);

        $query = $belongsToMany->getQuery()->getModel()->newQuery();
        $parent = $belongsToMany->getParent();
        $table = $belongsToMany->getTable();
        $foreignKey = explode('.', $belongsToMany->getForeignKey())[1];
        $otherKey = explode('.', $belongsToMany->getOtherKey())[1];
        $relation = $belongsToMany->getRelationName();

        return new BelongsToMany($query, $parent, $table, $foreignKey, $otherKey, $relation);
    }
}
