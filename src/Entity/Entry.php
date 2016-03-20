<?php

namespace Del\Expenses\Entity;

use DateTime;

/**
 * @Entity(repositoryClass="Del\Expenses\Repository\Entry")
 * @InheritanceType("SINGLE_TABLE")
 * @DiscriminatorColumn(name="type", type="string")
 * @DiscriminatorMap({"IN" = "Del\Expenses\Entity\Income", "OUT" = "Del\Expenses\Entity\Expenditure", "CLAIM" = "Del\Expenses\Entity\ExpenseClaim"})
 */
abstract class Entry implements EntryInterface
{
    /**
     * @Id
     * @Column(type="integer")
     * @GeneratedValue
     */
    private $id;

    /**
     * @Column(type="integer")
     */
    private $userId;

    /**
     * @Column(type="date")
     * @var DateTime
     */
    private $date;

    /** @Column(type="decimal",precision=11,scale=2) */
    private $amount;

    /** @Column(type="string",length=50,nullable=true) */
    private $category;

    /** @Column(type="string",length=50,nullable=true) */
    private $description;

    /** @Column(type="string",length=255,nullable=true) */
    private $note;


    public function __construct()
    {
        $this->setType();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Entry
     */
    public function setId($id)
    {
        $this->id = (int) $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param mixed $userId
     * @return Entry
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
        return $this;
    }



    /**
     * @return DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param DateTime $date
     * @return Entry
     */
    public function setDate(DateTime $date)
    {
        $this->date = $date;
        return $this;
    }

    /**
     * @return float
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param float $amount
     * @return Entry
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
        return $this;
    }

    /**
     * @return string
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param string $category
     * @return Entry
     */
    public function setCategory($category)
    {
        $this->category = $category;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return Entry
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return string
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * @param string $note
     * @return Entry
     */
    public function setNote($note)
    {
        $this->note = $note;
        return $this;
    }

    /**
     * @return $this
     */
    abstract public function setType();

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }


}