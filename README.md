# eloquent-extra-events

Install:

`composer require neylsongularte/eloquent-extra-events`


In your model:

`use NeylsonGularte\EloquentExtraEvents\ExtraEventsTrait;`


Listen events:

```
$this->app['events']->listen('eloquent.syncing*', function ($eventData) {        
});

$this->app['events']->listen('eloquent.synced*', function ($eventData) {        
});


```



