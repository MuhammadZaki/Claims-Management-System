<?php

namespace App\Facades;

use App\Classes\Localization;
use Illuminate\Support\Facades\Facade;

class Locale extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return Localization::class; }
}