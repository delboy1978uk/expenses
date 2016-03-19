<?php

namespace Del\Expenses\Entity;

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