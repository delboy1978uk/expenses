<?php

namespace Del\Expenses\Service;

use DateTime;
use Del\Expenses\Entity\EntryInterface;
use Del\Expenses\Entity\Expenditure;
use Del\Expenses\Entity\ExpenseClaim;
use Del\Expenses\Entity\Income;
use Del\Expenses\Repository\Entry;
use Pimple\Container;


class ExpensesService
{

    /** @var Container $container */
    protected $container;

    public function __construct(Container $c)
    {
        $this->container = $c;
    }

    /**
     * @return Entry
     */
    protected function getRepository()
    {
        return $this->container['doctrine.entity_manager']->getRepository('Del\Expenses\Entity\Entry');
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
        $entry->setAmount($data['amount'])
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

        ];
    }

    /**
     * @param Income $income
     * @return Income
     */
    public function saveIncome(Income $income)
    {
        return $income;
    }

    /**
     * @param Income $income
     */
    public function deleteIncome(Income $income)
    {
        return;
    }

    /**
     * @param int $id
     */
    public function findIncomeById($id)
    {

    }

    /**
     * @param Expenditure $expenditure
     * @return Expenditure
     */
    public function saveExpenditure(Expenditure $expenditure)
    {
        return $expenditure;
    }

    /**
     * @param Expenditure $expenditure
     */
    public function deleteExpenditure(Expenditure $expenditure)
    {
        return;
    }

    /**
     * @param int $id
     */
    public function findExpenditureById($id)
    {

    }

    /**
     * @param ExpenseClaim $claim
     * @return ExpenseClaim
     */
    public function saveExpenseClaim(ExpenseClaim $claim)
    {
        return $claim;
    }

    /**
     * @param ExpenseClaim $claim
     */
    public function deleteExpenseClaim(ExpenseClaim $claim)
    {
        return;
    }

    /**
     * @param int $id
     */
    public function findExpenseClaimById($id)
    {

    }

}