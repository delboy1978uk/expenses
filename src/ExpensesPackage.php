<?php

namespace Del\Expenses;

use Del\Common\Container\RegistrationInterface;
use Del\Expenses\Service\ExpensesService;
use Pimple\Container;

class ExpensesPackage implements RegistrationInterface
{
    /**
     * @param Container $c
     */
    public function addToContainer(Container $c)
    {
        $function = function($c){
            $svc = new ExpensesService($c);
            return $svc;
        };

        $c['service.expenses'] = $c->factory($function);
    }

    /**
     * @return string
     */
    function getEntityPath()
    {
        return 'vendor/delboy1978uk/expenses/src/Entity';
    }

    /**
     * @return bool
     */
    function hasEntityPath()
    {
        return true;
    }

}