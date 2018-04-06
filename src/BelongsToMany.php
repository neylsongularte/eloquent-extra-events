<?php

namespace NeylsonGularte\EloquentExtraEvents;

use Illuminate\Database\Eloquent\Relations\BelongsToMany as BelongsToManyEloquent;


class BelongsToMany extends BelongsToManyEloquent
{
    use BaseRelation;


}
