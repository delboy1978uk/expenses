<?php

namespace Del\Expenses\Entity;

/**
 * Class Expenditure
 * @package Del\Expenses\Entity
 * @Entity
 */
class ExpenseClaim extends Entry
{
    public function setType()
    {
        $this->type = 'CLAIM';
        return $this;
    }
}