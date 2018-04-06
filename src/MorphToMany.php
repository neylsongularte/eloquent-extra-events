<?php

namespace NeylsonGularte\EloquentExtraEvents;

use Illuminate\Database\Eloquent\Relations\MorphToMany as MorphToManyEloquent;

class MorphToMany extends MorphToManyEloquent
{
    use BaseRelation;



}
