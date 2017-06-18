<?php

namespace Del\Expenses\Entity;

use DateTime;
use Del\Expenses\Value\Category;

interface EntryInterface
{
    /**
     * @return int
     */
    public function getId();

    /**
     * @param int $id
     * @return $this
     */
    public function setId($id);
    /**
     * @return int
     */
    public function getUserId();

    /**
     * @param int $id
     * @return $this
     */
    public function setUserId($id);

    /**
     * @return DateTime
     */
    public function getDate();

    /**
     * @param DateTime $date
     * @return Entry
     */
    public function setDate(DateTime $date);

    /**
     * @return float
     */
    public function getAmount();

    /**
     * @param float $amount
     * @return Entry
     */
    public function setAmount($amount);

    /**
     * @return Category
     */
    public function getCategory();

    /**
     * @param Category $category
     * @return Entry
     */
    public function setCategory(Category $category);

    /**
     * @return string
     */
    public function getDescription();

    /**
     * @param string $description
     * @return Entry
     */
    public function setDescription($description);

    /**
     * @return string
     */
    public function getNote();

    /**
     * @param string $note
     * @return Entry
     */
    public function setNote($note);

}