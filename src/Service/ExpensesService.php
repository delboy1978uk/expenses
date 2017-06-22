<?php

namespace Del\Expenses\Service;

use DateTime;
use Del\Expenses\Criteria\EntryCriteria;
use Del\Expenses\Entity\EntryInterface;
use Del\Expenses\Entity\Expenditure;
use Del\Expenses\Entity\Income;
use Del\Expenses\Repository\EntryRepository;
use Del\Expenses\Value\Category;


class ExpensesService
{
    /** @var float $vatRate */
    private $vatRate;

    /** @var EntryRepository $repository */
    protected $repository;

    public function __construct(EntryRepository $repository, $vatRate = 20)
    {
        $this->vatRate = $vatRate;
        $this->repository = $repository;
    }

    /**
     * @return EntryRepository
     */
    private function getRepository()
    {
        return $this->repository;
    }

    /**
     * @param array $data
     * @param EntryInterface $entry
     * @return EntryInterface
     */
    private function setFromArray(array $data, EntryInterface $entry)
    {
        if(!$data['date'] instanceof DateTime) {
            $data['date'] = new DateTime($data['date']);
        }
        $entry->setId($data['userId'])
            ->setUserId($data['userId'])
            ->setCategory(new Category($data['category']))
            ->setAmount($data['amount'])
            ->setDate($data['date'])
            ->setDescription($data['description'])
            ->setNote($data['note']);
        return $entry;
    }

    /**
     * @return Expenditure
     */
    public function createExpenditureFromArray(array $data)
    {
        $expenditure = new Expenditure();
        /** @var Expenditure $expenditure */
        $expenditure = $this->setFromArray($data, $expenditure);
        return $expenditure;
    }

    /**
     * @return Income
     */
    public function createIncomeFromArray(array $data)
    {
        $income = new Income();
        /** @var Income $income */
        $income = $this->setFromArray($data, $income);
        return $income;
    }

    /**
     * Pass an Income, Expenditure, or Expense Claim
     * @return array
     */
    public function toArray(EntryInterface $entry)
    {
        return [
            'id' => $entry->getId(),
            'userId' => $entry->getUserId(),
            'date' => $entry->getDate(),
            'amount' => $entry->getAmount(),
            'vatRate' => $entry->getVatRate(),
            'vat' => $entry->getVat(),
            'total' => $entry->getTotal(),
            'description' => $entry->getDescription(),
            'category' => $entry->getCategory()->getValue(),
            'note' => $entry->getNote(),
        ];
    }

    /**
     * @param Income $income
     * @return Income
     */
    public function saveIncome(Income $income)
    {
        return $this->getRepository()->save($income);
    }

    /**
     * @param Income $income
     */
    public function deleteIncome(Income $income)
    {
        $this->deleteEntry($income);
    }

    /**
     * @param $id
     * @return Income
     */
    public function findIncomeById($id)
    {
        $criteria = new EntryCriteria();
        $criteria->setId($id);
        return $this->getRepository()->findOneByCriteria($criteria);
    }

    /**
     * @param Expenditure $expenditure
     * @return Expenditure
     */
    public function saveExpenditure(Expenditure $expenditure)
    {
        return $this->getRepository()->save($expenditure);
    }

    /**
     * @param Expenditure $expenditure
     */
    public function deleteExpenditure(Expenditure $expenditure)
    {
        $this->deleteEntry($expenditure);
    }

    /**
     * @param $id
     * @return Expenditure
     */
    public function findExpenditureById($id)
    {
        $criteria = new EntryCriteria();
        $criteria->setId($id);
        return $this->getRepository()->findOneByCriteria($criteria);
    }

    /**
     * @param EntryCriteria $criteria
     * @return array
     */
    public function findByCriteria(EntryCriteria $criteria)
    {
        return $this->getRepository()->findByCriteria($criteria);
    }

    /**
     * @param EntryInterface $entry
     */
    public function deleteEntry(EntryInterface $entry)
    {
        $this->getRepository()->delete($entry);
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
     * @return ExpensesService
     */
    public function setVatRate($vatRate)
    {
        $this->vatRate = $vatRate;
        return $this;
    }
}