<?php

namespace DelTesting\Service;

use Codeception\Test\Unit;
use DateTime;
use Del\Common\ContainerService;
use Del\Expenses\Criteria\EntryCriteria;
use Del\Expenses\Entity\Expenditure;
use Del\Expenses\Entity\Income;
use Del\Expenses\Service\ExpensesService;
use Del\Expenses\Value\Category;

class ExpensesServiceTest extends Unit
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
            'category' => 'accommodation',
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
            'category' => Category::INCOME_INVOICE,
            'description' => 'paid for work',
            'note' => 'note about this income',
        ];
        $income = $this->svc->createIncomeFromArray($incomeArray);
        $this->assertInstanceOf('Del\Expenses\Entity\Income', $income);
    }

    public function testToArray()
    {
        $expense = [
            'id' => 1,
            'userId' => 10,
            'date' => '2016-04-07 09:00:00',
            'category' => Category::EXPENSE_TRANSPORT,
            'amount' => 300.00,
            'description' => 'Rail Tickets',
            'note' => 'note about this expense claim',
        ];
        $claim = $this->svc->createExpenditureFromArray($expense);
        $this->assertInstanceOf('Del\Expenses\Entity\Expenditure', $claim);
        $array = $this->svc->toArray($claim);
        $this->assertArrayHasKey('id',$array);
        $this->assertArrayHasKey('userId',$array);
        $this->assertArrayHasKey('date',$array);
        $this->assertArrayHasKey('amount',$array);
        $this->assertArrayHasKey('description',$array);
        $this->assertArrayHasKey('category',$array);
        $this->assertArrayHasKey('note',$array);
    }


    public function testSaveFindAndDeleteIncome()
    {
        $incomeArray = [
            'userId' => 10,
            'date' => new DateTime(),
            'amount' => 350.00,
            'description' => 'Rent',
            'category' => Category::EXPENSE_ACCOMMODATION,
            'note' => 'note about this payment',
        ];
        $income = $this->svc->createIncomeFromArray($incomeArray);
        $income = $this->svc->saveIncome($income);
        $id = $income->getId();
        $this->assertInstanceOf('Del\Expenses\Entity\Income', $income);
        $income = $this->svc->findIncomeById($id);
        $this->assertInstanceOf('Del\Expenses\Entity\Income', $income);
        $this->assertEquals(10, $income->getUserId());
        $this->svc->deleteIncome($income);
        $income = $this->svc->findIncomeById($id);
        $this->assertNull($income);
    }


    public function testSaveFindAndDeleteExpenditure()
    {
        $data = [
            'userId' => 10,
            'date' => new DateTime(),
            'amount' => 350.00,
            'description' => 'Rent',
            'category' => Category::EXPENSE_ACCOMMODATION,
            'note' => 'note about this payment',
        ];
        $expenditure = $this->svc->createExpenditureFromArray($data);
        $expenditure = $this->svc->saveExpenditure($expenditure);
        $id = $expenditure->getId();
        $this->assertInstanceOf('Del\Expenses\Entity\Expenditure', $expenditure);
        $expenditure = $this->svc->findExpenditureById($id);
        $this->assertInstanceOf('Del\Expenses\Entity\Expenditure', $expenditure);
        $this->assertEquals(10, $expenditure->getUserId());
        $this->svc->deleteExpenditure($expenditure);
        $expenditure = $this->svc->findExpenditureById($id);
        $this->assertNull($expenditure);
    }



    public function testFindByCriteria()
    {
        $data = [
            'userId' => 1,
            'date' => new DateTime('2016-03-20 01:44:00'),
            'amount' => 10000.00,
            'description' => 'Work done',
            'category' => Category::INCOME_INVOICE,
            'note' => 'amazing website',
        ];
        $income = $this->svc->createIncomeFromArray($data);
        $this->svc->saveIncome($income);

        $data = [
            'userId' => 3,
            'date' => new DateTime('2016-06-06 12:44:00'),
            'amount' => 4000.00,
            'description' => 'Harley Davidson',
            'category' => Category::EXPENSE_EQUIPMENT,
            'note' => 'paid by card',
        ];
        $expenditure = $this->svc->createExpenditureFromArray($data);
        $this->svc->saveExpenditure($expenditure);

        $criteria = new EntryCriteria();
        $criteria->setDate('2016-03-20 01:44:00');
        $results = $this->svc->findByCriteria($criteria);
        $this->assertNotEmpty($results);
        $entity = $results[0];
        $this->assertInstanceOf('Del\Expenses\Entity\Income', $entity);

        $criteria = new EntryCriteria();
        $criteria->setDate('2016-03-20 01:44:00');
        $results = $this->svc->findByCriteria($criteria);
        $this->assertNotEmpty($results);
        $entity = $results[0];
        $this->assertInstanceOf('Del\Expenses\Entity\Income', $entity);

        $criteria = new EntryCriteria();
        $criteria->setDateRange('2016-03-19 01:44:00','2016-03-21 01:44:00');
        $results = $this->svc->findByCriteria($criteria);
        $this->assertNotEmpty($results);
        $entity = $results[0];
        $this->assertInstanceOf('Del\Expenses\Entity\Income', $entity);

        $criteria = new EntryCriteria();
        $criteria->setCategory(Category::EXPENSE_EQUIPMENT);
        $criteria->setOrder(EntryCriteria::ORDER_USERID);
        $results = $this->svc->findByCriteria($criteria);
        $this->assertNotEmpty($results);
        $entity = $results[0];
        $this->assertInstanceOf('Del\Expenses\Entity\Expenditure', $entity);

        $criteria = new EntryCriteria();
        $criteria->setDescription('Work Done');
        $results = $this->svc->findByCriteria($criteria);
        $this->assertNotEmpty($results);
        $entity = $results[0];
        $this->assertInstanceOf('Del\Expenses\Entity\Income', $entity);

        $criteria = new EntryCriteria();
        $criteria->setNote('amazing website');
        $results = $this->svc->findByCriteria($criteria);
        $this->assertNotEmpty($results);
        $entity = $results[0];
        $this->assertInstanceOf('Del\Expenses\Entity\Income', $entity);

        $criteria = new EntryCriteria();
        $criteria->setType('IN');
        $results = $this->svc->findByCriteria($criteria);
        $this->assertNotEmpty($results);
        $entity = $results[0];
        $this->assertInstanceOf('Del\Expenses\Entity\Income', $entity);

        $criteria = new EntryCriteria();
        $criteria->setType('OUT');
        $results = $this->svc->findByCriteria($criteria);
        $this->assertNotEmpty($results);
        $entity = $results[0];
        $this->assertInstanceOf('Del\Expenses\Entity\Expenditure', $entity);


        $criteria = new EntryCriteria();
        $results = $this->svc->findByCriteria($criteria);
        foreach($results as $result) {

            if ($result instanceof Income) {
                $this->svc->deleteIncome($result);
            } elseif ($result instanceof Expenditure) {
                $this->svc->deleteExpenditure($result);
            }
        }

    }

}
