<?php

namespace Spatie\StatamicAlgoliaPlaces;

use Spatie\StatamicAlgoliaPlaces\Fieldtypes\Location;
use Statamic\Providers\AddonServiceProvider;

class ServiceProvider extends AddonServiceProvider
{
    protected $fieldtypes = [
        Location::class,
    ];

    protected $scripts = [
        __DIR__.'/../dist/js/places.js',
    ];
}
