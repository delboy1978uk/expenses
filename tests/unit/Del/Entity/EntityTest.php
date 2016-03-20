<?php

namespace DelTesting\Service;

use DateTime;
use Del\Expenses\Entity\Income;

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
        $this->income->setCategory('Fuel');
        $this->assertEquals('Fuel', $this->income->getCategory());
    }

    public function testGetSetType()
    {
        $this->assertEquals('IN', $this->income->getType());
    }
}
