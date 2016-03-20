<?php

namespace Del\Expenses\Entity;

/**
 * Class Expenditure
 * @package Del\Expenses\Entity
 * @Entity
 */
class Income extends Entry
{
    /**
     * @return Income
     */
    public function setType()
    {
        $this->type = 'IN';
    }
}