<?php

namespace FlyingLuscas\PagarMeLaravel;

use Illuminate\Support\Facades\Facade;

class PagarMeFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'PagarMe';
    }
}
