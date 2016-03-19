<?php

namespace DelTesting\Entity;

use Del\Expenses\Entity\Expenditure;
use Codeception\TestCase\Test;

class ExpenditureTest extends Test
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    /**
     * @var Expenditure
     */
    protected $expenditure;

    protected function _before()
    {
        $this->expenditure = new Expenditure();
    }

    protected function _after()
    {
        unset($this->expenditure);
    }

    public function testGetSetType()
    {
        $this->assertEquals('OUT', $this->expenditure->getType());
    }
}