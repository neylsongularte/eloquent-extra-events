<?php

namespace NeylsonGularte\EloquentExtraEvents;



trait ExtraEventsTrait {



    public function extraEventsSync($relation, $ids, $detaching = true)
    {

        $changes = $this->$relation()->sync($ids, $detaching);

        return $changes;
    }

}
