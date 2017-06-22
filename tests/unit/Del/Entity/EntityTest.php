<?php

namespace DelTesting\Service;

use DateTime;
use Del\Expenses\Entity\Income;
use Del\Expenses\Value\Category;

class EntityTest extends \Codeception\TestCase\Test
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    /**
     * @var Income
     */
    protected $income;

    protected function _before()
    {
        $this->income = new Income();
    }

    protected function _after()
    {
        unset($this->income);
    }

    public function testGetSetId()
    {
        $this->income->setId(78);
        $this->assertEquals(78, $this->income->getId());
    }

    public function testGetSetUserId()
    {
        $this->income->setUserId(78);
        $this->assertEquals(78, $this->income->getUserId());
    }

    public function testGetSetDate()
    {
        $date = new DateTime('2016-03-16 14:33:45');
        $this->income->setDate($date);
        $this->assertInstanceOf('DateTime', $this->income->getDate());
        $this->assertEquals('2016-03-16 14:33:45', $this->income->getDate()->format('Y-m-d H:i:s'));
    }

    public function testGetSetAmount()
    {
        $this->income->setAmount(6000.00);
        $this->assertEquals(6000.00, $this->income->getAmount());
    }

    public function testGetSetDescription()
    {
        $this->income->setDescription('Contract Pay');
        $this->assertEquals('Contract Pay', $this->income->getDescription());
    }

    public function testGetSetNote()
    {
        $this->income->setNote('monthly retainer from client xyz');
        $this->assertEquals('monthly retainer from client xyz', $this->income->getNote());
    }

    public function testGetSetCategory()
    {
        $this->income->setCategory(new Category(Category::INCOME_INVOICE));
        $this->assertEquals('invoice', $this->income->getCategory()->getValue());
    }

    public function testIncludingVat()
    {
        // test at 20% VAT
        $in = new Income(20);
        $in->setAmount(1200, Income::VAT_INC);
        $this->assertEquals(20, $in->getVatRate());
        $this->assertEquals(1000, $in->getAmount());
        $this->assertEquals(200, $in->getVat());
        $this->assertEquals(1200, $in->getTotal());

        $in = new Income(20);
        $in->setAmount(3000, Income::VAT_INC);
        $this->assertEquals(20, $in->getVatRate());
        $this->assertEquals(2500, $in->getAmount());
        $this->assertEquals(500, $in->getVat());
        $this->assertEquals(3000, $in->getTotal());

        // £1100 in 10% VAT
        $in = new Income(10);
        $in->setAmount(1100, Income::VAT_INC);
        $this->assertEquals(10, $in->getVatRate());
        $this->assertEquals(1000, $in->getAmount());
        $this->assertEquals(100, $in->getVat());
        $this->assertEquals(1100, $in->getTotal());
    }

    public function testExcludingVat()
    {
        // test at 20% VAT
        $in = new Income(20);
        $in->setAmount(1000, Income::VAT_EXC);
        $this->assertEquals(20, $in->getVatRate());
        $this->assertEquals(1000, $in->getAmount());
        $this->assertEquals(200, $in->getVat());
        $this->assertEquals(1200, $in->getTotal());
    }

    public function testIgnoringVat()
    {
        $in = new Income();
        $in->setAmount(1200);
        $this->assertEquals(0, $in->getVatRate());
        $this->assertEquals(1200, $in->getAmount());
        $this->assertEquals(0, $in->getVat());
        $this->assertEquals(1200, $in->getTotal());
    }
}
