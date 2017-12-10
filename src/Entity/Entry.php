<?php

namespace Del\Expenses\Entity;

use DateTime;
use Del\Expenses\Value\Category;
use LogicException;

/**
 * @Entity(repositoryClass="Del\Expenses\Repository\EntryRepository")
 * @InheritanceType("SINGLE_TABLE")
 * @DiscriminatorColumn(name="type", type="string")
 * @DiscriminatorMap({"IN" = "Del\Expenses\Entity\Income", "OUT" = "Del\Expenses\Entity\Expenditure"})
 */
abstract class Entry implements EntryInterface
{
    const VAT_NONE = 0;
    const VAT_EXC = 1;
    const VAT_INC = 2;

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
     * @Column(type="datetime")
     * @var DateTime
     */
    private $date;

    /** @Column(type="decimal",precision=11,scale=2) */
    private $amount;

    /**
     * @Column(type="decimal",precision=11,scale=2)
     * @var float $vatRate
     */
    private $vatRate;

    /**
     * @Column(type="decimal",precision=11,scale=2)
     * @var float
     */
    private $vat;

    /**
     * @Column(type="decimal",precision=11,scale=2)
     * @var float
     */
    private $total;

    /** @Column(type="string",length=50,nullable=true) */
    private $category;

    /** @Column(type="string",length=50,nullable=true) */
    private $description;

    /** @Column(type="string",length=255,nullable=true) */
    private $note;

    /**
     * Entry constructor.
     * @param int $vatRate
     */
    public function __construct($vatRate = 0)
    {
        $this->vatRate = $vatRate;
        $this->amount = 0;
        $this->vat = 0;
        $this->total = 0;
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
    public function setAmount($amount, $vatPaid = self::VAT_NONE)
    {
        if ($vatPaid != self::VAT_NONE && $this->vatRate == 0) {

            throw new LogicException('Set a VAT rate before setting the amount, if inc/ex VAT');

        } elseif ($vatPaid == self::VAT_INC) {

            $fraction = 100 / $this->vatRate;
            $fraction ++ ;
            $vatAmount = $amount / $fraction;
            $total = $amount;
            $amount = $amount - $vatAmount;

        } elseif ($vatPaid == self::VAT_EXC) {

            $vatAmount = ($amount / 100) * $this->vatRate;
            $total = $amount + $vatAmount;

        } else {

            $vatAmount = 0;
            $total = $amount;
            $this->vatRate = 0;

        }
        $this->amount = $amount;
        $this->vat = $vatAmount;
        $this->total = $total;
        return $this;
    }

    /**
     * @return Category
     */
    public function getCategory()
    {
        return new Category($this->category);
    }

    /**
     * @param Category $category
     * @return Entry
     */
    public function setCategory(Category $category)
    {
        $this->category = $category->getValue();
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
     * @return float
     */
    public function getVatRate()
    {
        return $this->vatRate;
    }

    /**
     * @param float $vatRate
     * @return Entry
     */
    public function setVatRate($vatRate)
    {
        $this->vatRate = $vatRate;
        return $this;
    }

    /**
     * @return float
     */
    public function getVat()
    {
        return $this->vat;
    }

    /**
     * @return float
     */
    public function getTotal()
    {
        return $this->total;
    }
}