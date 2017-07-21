# eloquent-extra-events

[![Total Downloads](https://poser.pugx.org/neylsongularte/eloquent-extra-events/downloads)](https://packagist.org/packages/neylsongularte/eloquent-extra-events)
[![Monthly Downloads](https://poser.pugx.org/neylsongularte/eloquent-extra-events/d/monthly)](https://packagist.org/packages/neylsongularte/eloquent-extra-events)
[![Daily Downloads](https://poser.pugx.org/neylsongularte/eloquent-extra-events/d/daily)](https://packagist.org/packages/neylsongularte/eloquent-extra-events)
[![Latest Stable Version](https://poser.pugx.org/neylsongularte/eloquent-extra-events/v/stable)](https://packagist.org/packages/neylsongularte/eloquent-extra-events)
[![Latest Unstable Version](https://poser.pugx.org/neylsongularte/eloquent-extra-events/v/unstable)](https://packagist.org/packages/neylsongularte/eloquent-extra-events)
[![License](https://poser.pugx.org/neylsongularte/eloquent-extra-events/license)](https://packagist.org/packages/neylsongularte/eloquent-extra-events)

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
