<?php

namespace Del\Expenses\Entity;


class ExpenseClaim extends Entry
{
    public function setType()
    {
        $this->type = 'CLAIM';
        return $this;
    }
}