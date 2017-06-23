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

Listen events in `App\Providers\AppServiceProvider`:

```
In 5.2.x and 5.3.x:
Event::listen('eloquent.syncing*', function (array $eventData) {
});

In 5.4.x:
Event::listen('eloquent.syncing*', function ($eventName, array $eventData) {
});

```
