<?php

namespace Del\Expenses\Entity;

use DateTime;

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
     * @return string
     */
    public function getCategory();

    /**
     * @param string $category
     * @return Entry
     */
    public function setCategory($category);

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