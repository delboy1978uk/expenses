<?php

namespace DelTesting\Entity;

use Del\Expenses\Entity\ExpenseClaim;
use Codeception\TestCase\Test;

class ClaimTest extends Test
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    /**
     * @var ExpenseClaim
     */
    protected $claim;

    protected function _before()
    {
        $this->claim = new ExpenseClaim();
    }

    protected function _after()
    {
        unset($this->claim);
    }

    public function testGetSetType()
    {
        $this->assertEquals('CLAIM', $this->claim->getType());
    }
}