<?php

namespace FlyingLuscas\PagarMeLaravel;

use PagarMe\Sdk\PagarMe;

class PagarmeFacadeTest extends TestCase
{
    /**
     * @dataProvider getPagarMeHandlersMethods
     */
    public function testPagarMeHandlersViaFacade($method)
    {
        $this->assertInternalType(
            'object',
            PagarMeFacade::{$method}(),
            'PagarMeFacade::'.$method.'() is not an object.'
        );
    }

    /**
     * Get a list of methods from the PagarMe's class that
     * must be callable from the PagarMe facade without errors.
     *
     * @return array
     */
    public function getPagarMeHandlersMethods()
    {
        $methods = get_class_methods(PagarMe::class);

        return array_map(function ($method) {
            return [$method];
        }, array_filter($methods, function ($method) {
            return $method != '__construct';
        }));
    }
}
