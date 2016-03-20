<?php

namespace DelTesting\Service;

use Codeception\Module\Db;
use DateTime;
use Del\Common\ContainerService;
use Del\Expenses\ExpensesPackage;
use Del\Expenses\Entity\Expenditure;
use Del\Expenses\Entity\ExpenseClaim;
use Del\Expenses\Entity\Income;
use Del\Expenses\Service\ExpensesService;
use Del\Common\Config\DbCredentials;

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
        $creds = new DbCredentials();
        $creds->setDatabase('expenses');
        $package = new ExpensesPackage();
        ContainerService::getInstance()->registerToContainer($package);
        ContainerService::getInstance()->setDbCredentials($creds);
        $container = ContainerService::getInstance()->getContainer();
        $this->svc = $container['service.expenses'];
    }

    protected function _after()
    {
        unset($this->svc);
    }

    public function testCreateExpenditureFromArray()
    {
        $expenditureArray = [
            'id' => 1,
            'userId' => 10,
            'date' => new DateTime(),
            'amount' => 350.00,
            'description' => 'Rent',
            'note' => 'note about this payment',
        ];
        $expenditure = $this->svc->createExpenditureFromArray($expenditureArray);
        $this->assertInstanceOf('Del\Expenses\Entity\Expenditure', $expenditure);
    }

    public function testCreateIncomeFromArray()
    {
        $incomeArray = [
            'id' => 1,
            'userId' => 10,
            'date' => '2016-04-07 09:00:00',
            'amount' => 6500.00,
            'description' => 'Rent',
            'note' => 'note about this income',
        ];
        $income = $this->svc->createIncomeFromArray($incomeArray);
        $this->assertInstanceOf('Del\Expenses\Entity\Income', $income);
    }

    public function testExpenseClaimFromArray()
    {
        $claimArray = [
            'id' => 1,
            'userId' => 10,
            'date' => '2016-04-07 09:00:00',
            'amount' => 300.00,
            'description' => 'Rail Tickets',
            'note' => 'note about this expense claim',
        ];
        $claim = $this->svc->createExpenseClaimFromArray($claimArray);
        $this->assertInstanceOf('Del\Expenses\Entity\ExpenseClaim', $claim);
    }

    public function testToArray()
    {
        $claimArray = [
            'id' => 1,
            'userId' => 10,
            'date' => '2016-04-07 09:00:00',
            'amount' => 300.00,
            'description' => 'Rail Tickets',
            'note' => 'note about this expense claim',
        ];
        $claim = $this->svc->createExpenseClaimFromArray($claimArray);
        $this->assertInstanceOf('Del\Expenses\Entity\ExpenseClaim', $claim);
        $array = $this->svc->toArray($claim);
        $this->assertArrayHasKey('id',$array);
        $this->assertArrayHasKey('userId',$array);
        $this->assertArrayHasKey('date',$array);
        $this->assertArrayHasKey('amount',$array);
        $this->assertArrayHasKey('description',$array);
        $this->assertArrayHasKey('category',$array);
        $this->assertArrayHasKey('note',$array);
        $this->assertArrayHasKey('type',$array);
    }


    public function testSaveIncome()
    {
        $incomeArray = [
            'userId' => 10,
            'date' => new DateTime(),
            'amount' => 350.00,
            'description' => 'Rent',
            'note' => 'note about this payment',
        ];
        $income = $this->svc->createIncomeFromArray($incomeArray);
        $income = $this->svc->saveIncome($income);
        $id = $income->getId();
        $this->assertInstanceOf('Del\Expenses\Entity\Income', $income);
        $income = $this->svc->findIncomeById($id);
        $this->assertInstanceOf('Del\Expenses\Entity\Income', $income);
        $this->assertEquals(10, $income->getUserId());
    }

}
