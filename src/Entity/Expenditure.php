<?php

namespace Del\Expenses\Entity;

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