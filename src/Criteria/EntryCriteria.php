<?php

namespace Del\Expenses\Criteria;

use DateTime;
use Del\Common\Criteria as CommonCriteria;


class EntryCriteria extends CommonCriteria
{
    const ORDER_AMOUNT          = 'amount';
    const ORDER_CATEGORY        = 'category';
    const ORDER_DATE            = 'date';
    const ORDER_DESCRIPTION     = 'description';
    const ORDER_ID              = 'id';
    const ORDER_NOTE            = 'note';
    const ORDER_TYPE            = 'type';
    const ORDER_USERID          = 'userId';

    protected $id;
    protected $userId;
    protected $date;
    protected $dateRange;
    protected $amount;
    protected $category;
    protected $description;
    protected $note;
    protected $type;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = (int) $id;
        return $this;
    }

    /**
     * @return bool
     */
    public function hasId()
    {
        return $this->id != null;
    }

    /**
     * @return int
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param $id
     * @return $this
     */
    public function setUserId($id)
    {
        $this->userId = (int) $id;
        return $this;
    }

    /**
     * @return bool
     */
    public function hasUserId()
    {
        return $this->userId != null;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     * @return EntryCriteria
     */
    public function setDate($date)
    {
        $this->date = $date;
        return $this;
    }

    /**
     * @return bool
     */
    public function hasDateRange()
    {
        return $this->dateRange != null;
    }

    /**
     * @return mixed
     */
    public function getDateRange()
    {
        return $this->dateRange;
    }

    /**
     * @param string $fromDate
     * @param string $toDate
     * @return $this
     */
    public function setDateRange($fromDate, $toDate)
    {
        $this->dateRange = [
            $fromDate, $toDate
        ];
        return $this;
    }

    /**
     * @return bool
     */
    public function hasDate()
    {
        return $this->date != null;
    }

    /**
     * @return mixed
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param mixed $amount
     * @return EntryCriteria
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
        return $this;
    }

    /**
     * @return bool
     */
    public function hasAmount()
    {
        return $this->amount != null;
    }

    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param mixed $category
     * @return EntryCriteria
     */
    public function setCategory($category)
    {
        $this->category = $category;
        return $this;
    }

    /**
     * @return bool
     */
    public function hasCategory()
    {
        return $this->category != null;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     * @return EntryCriteria
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return bool
     */
    public function hasDescription()
    {
        return $this->description != null;
    }

    /**
     * @return mixed
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * @param mixed $note
     * @return EntryCriteria
     */
    public function setNote($note)
    {
        $this->note = $note;
        return $this;
    }

    /**
     * @return bool
     */
    public function hasNote()
    {
        return $this->note != null;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     * @return EntryCriteria
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return bool
     */
    public function hasType()
    {
        return $this->type != null;
    }


}