<?php

namespace Spatie\StatamicAlgoliaPlaces;

use Spatie\StatamicAlgoliaPlaces\Fieldtypes\Places;
use Statamic\Providers\AddonServiceProvider;

class ServiceProvider extends AddonServiceProvider
{
    protected $fieldtypes = [
        Places::class,
    ];

    protected $scripts = [
        __DIR__.'/../dist/js/places.js',
    ];
}
