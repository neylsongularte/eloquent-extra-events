<?php

namespace NeylsonGularte\EloquentExtraEvents;


// Trait for models
trait ExtraEventsTrait {



    public function belongsToMany($related, $table = null, $foreignKey = null, $otherKey = null, $relation = null)
    {

        $belongsToMany = parent::belongsToMany($related, $table, $foreignKey, $otherKey, $relation);

        $query = $belongsToMany->getQuery()->getModel()->newQuery();
        $parent = $belongsToMany->getParent();
        $table = $belongsToMany->getTable();

        if(str_contains(app()->VERSION(), ['5.2.', '5.3.'])) {
            $foreignKey = explode('.', $belongsToMany->getForeignKey())[1];
            $otherKey = explode('.', $belongsToMany->getOtherKey())[1];
        } else {
            $foreignKey = explode('.', $belongsToMany->getQualifiedForeignKeyName())[1];
            $otherKey = explode('.', $belongsToMany->getQualifiedRelatedKeyName())[1];
        }

        $relation = $belongsToMany->getRelationName();


        return new BelongsToMany($query, $parent, $table, $foreignKey, $otherKey, $relation);
    }

    public function morphToMany($related, $name, $table = null, $foreignKey = null, $relatedKey = null, $inverse = false)
    {
        $morphToMany = parent::morphToMany($related, $name, $table, $foreignKey, $relatedKey, $inverse);

        $query = $morphToMany->getQuery()->getModel()->newQuery();
        $name = substr($morphToMany->getMorphType(), 0, -5);
        $table = $morphToMany->getTable();
        $caller = $morphToMany->getRelationName();

        if(str_contains(app()->VERSION(), ['5.2.', '5.3.'])) {
            $foreignKey = explode('.', $morphToMany->getForeignKey())[1];
            $relatedKey = explode('.', $morphToMany->getOtherKey())[1];
        } else {
            $foreignKey = explode('.', $morphToMany->getQualifiedForeignKeyName())[1];
            $relatedKey = explode('.', $morphToMany->getQualifiedRelatedKeyName())[1];
        }

        return new MorphToMany($query, $this, $name, $table, $foreignKey, $relatedKey, $caller, $inverse);
    }
}
