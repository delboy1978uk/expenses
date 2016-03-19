<?php

namespace DelTesting\Service;

use DateTime;
use Del\Common\ContainerService;
use Del\Expenses\ExpensesPackage;
use Del\Expenses\Entity\Expenditure;
use Del\Expenses\Entity\ExpenseClaim;
use Del\Expenses\Entity\Income;
use Del\Expenses\Service\ExpensesService;

class ExpensesTest extends \Codeception\TestCase\Test
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    /**
     * @var ExpensesService
     */
    protected $svc;

    protected function _before()
    {
        $package = new ExpensesPackage();
        ContainerService::getInstance()->registerToContainer($package);
        $container = ContainerService::getInstance()->getContainer();
        $this->svc = $container['service.expenses'];
    }

    protected function _after()
    {
        unset($this->svc);
    }

    public function testSetFromArray()
    {
        $expenditureArray = [
            'date' => new DateTime(),
            'amount' => 350.00,
            'description' => 'Rent',
            'note' => 'note about this payment',
        ];
        $expenditure = $this->svc->createExpenditureFromArray($expenditureArray);
        $this->assertInstanceOf('Del\Expenses\Entity\Expenditure', $expenditure);
    }


}
