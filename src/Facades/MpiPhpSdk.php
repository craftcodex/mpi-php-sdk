<?php

namespace CraftCodex\MpiPhpSdk\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \CraftCodex\MpiPhpSdk\MpiPhpSdk
 */
class MpiPhpSdk extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \CraftCodex\MpiPhpSdk\MpiPhpSdk::class;
    }
}
