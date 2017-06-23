# eloquent-extra-events

Install:

`composer require neylsongularte/eloquent-extra-events`


In your model:

`use NeylsonGularte\EloquentExtraEvents\ExtraEventsTrait;`

Events:
  * eloquent.syncing
  * eloquent.synced
  * eloquent.attaching
  * eloquent.attached
  * eloquent.detaching
  * eloquent.detached
  
Listen events in App\Providers\AppServiceProvider:

```
In 5.2.x and 5.3.x:
$this->app['events']->listen('eloquent.syncing*', function ($eventData) {        
});

In 5.4.x:
$this->app['events']->listen('eloquent.syncing*', function ($eventName, $eventData) {        
});

```



