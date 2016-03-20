<?php

namespace Del\Expenses\Entity;

/**
 * Class Expenditure
 * @package Del\Expenses\Entity
 * @Entity
 */
class Expenditure extends Entry
{
    /**
     * @return Expenditure
     */
    public function setType()
    {
        $this->type = 'OUT';
        return $this;
    }
}