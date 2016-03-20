<?php

namespace Del\Expenses\Service;

use DateTime;
use Del\Expenses\Criteria\EntryCriteria;
use Del\Expenses\Entity\EntryInterface;
use Del\Expenses\Entity\Expenditure;
use Del\Expenses\Entity\ExpenseClaim;
use Del\Expenses\Entity\Income;
use Del\Expenses\Repository\Entry;
use Pimple\Container;


class ExpensesService
{

    /** @var Container $container */
    protected $repository;

    public function __construct(Container $c)
    {
        $this->repository = $c['doctrine.entity_manager']->getRepository('Del\Expenses\Entity\Entry');
    }

    /**
     * @return Entry
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
            ->setCategory($data['category'])
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
        $expenditure = $this->setFromArray($data, $expenditure);
        return $expenditure;
    }

    /**
     * @return Income
     */
    public function createIncomeFromArray(array $data)
    {
        $income = new Income();
        $income = $this->setFromArray($data, $income);
        return $income;
    }

    /**
     * @return ExpenseClaim
     */
    public function createExpenseClaimFromArray(array $data)
    {
        $claim = new ExpenseClaim();
        $claim = $this->setFromArray($data, $claim);
        return $claim;
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
            'description' => $entry->getDescription(),
            'category' => $entry->getCategory(),
            'note' => $entry->getNote(),
            'type' => $entry->getType(),
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
     * @param ExpenseClaim $claim
     * @return ExpenseClaim
     */
    public function saveExpenseClaim(ExpenseClaim $claim)
    {
        return $this->getRepository()->save($claim);
    }

    /**
     * @param ExpenseClaim $claim
     */
    public function deleteExpenseClaim(ExpenseClaim $claim)
    {
        $this->deleteEntry($claim);
    }

    /**
     * @param $id
     * @return ExpenseClaim
     */
    public function findExpenseClaimById($id)
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

}