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
            /** @var \Doctrine\ORM\EntityManager $em */
            $em = $c['doctrine.entity_manager'];
            /** @var \Del\Expenses\Repository\EntryRepository $repository */
            $repository = $em->getRepository('Del\Expenses\Entity\Entry');
            $svc = new ExpensesService($repository);
            return $svc;
        };

        $c['service.expenses'] = $c->factory($function);
    }

    /**
     * @return string
     */
    public function getEntityPath()
    {
        return 'vendor/delboy1978uk/expenses/src/Entity';
    }

    /**
     * @return bool
     */
    public function hasEntityPath()
    {
        return true;
    }

}