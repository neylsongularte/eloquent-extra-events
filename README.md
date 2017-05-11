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

$this->app['events']->listen('eloquent.attaching*', function ($eventData) {        
});

$this->app['events']->listen('eloquent.attached*', function ($eventData) {        
});

$this->app['events']->listen('eloquent.detaching*', function ($eventData) {        
});

$this->app['events']->listen('eloquent.detached*', function ($eventData) {        
});


```



