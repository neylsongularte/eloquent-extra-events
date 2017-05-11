<?php

namespace NeylsonGularte\EloquentExtraEvents;

// use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App;

trait ExtraEventsTrait {




    public function belongsToMany($related, $table = null, $foreignKey = null, $otherKey = null, $relation = null)
    {

        // Laravel 5.2 and 5.3 code
        if(str_contains(App::VERSION(), ['5.2.', '5.3.'])) {
            if (is_null($relation)) {
                $relation = $this->getBelongsToManyCaller();
            }

            $foreignKey = $foreignKey ?: $this->getForeignKey();
            $instance = new $related;
            $otherKey = $otherKey ?: $instance->getForeignKey();

            if (is_null($table)) {
                $table = $this->joiningTable($related);
            }

            $query = $instance->newQuery();

            return new BelongsToMany($query, $this, $table, $foreignKey, $otherKey, $relation);
        } else if(str_contains(App::VERSION(), '5.4.')) {

            if (is_null($relation)) {
                $relation = $this->guessBelongsToManyRelation();
            }

            $instance = $this->newRelatedInstance($related);
            $foreignKey = $foreignKey ?: $this->getForeignKey();
            $relatedKey = $relatedKey ?: $instance->getForeignKey();

            if (is_null($table)) {
                $table = $this->joiningTable($related);
            }

            return new BelongsToMany(
                $instance->newQuery(), $this, $table, $foreignKey, $relatedKey, $relation
            );
        }


        throw new Exception('Versão não suportada');
    }
}
