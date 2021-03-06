<?php

namespace Del\Expenses\Repository;

use Del\Expenses\Entity\EntryInterface;
use Del\Expenses\Criteria\EntryCriteria;
use Del\Expenses\Entity\Expenditure;
use Del\Expenses\Entity\Income;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;

class EntryRepository extends EntityRepository
{
    /** @var QueryBuilder */
    private $qb;

    /**
     * @param EntryInterface $entry
     * @return EntryInterface|Income|Expenditure
     */
    public function save(EntryInterface $entry)
    {
        $this->_em->persist($entry);
        $this->_em->flush();
        return $entry;
    }

    /**
     * @param EntryInterface $entry
     */
    public function delete(EntryInterface $entry)
    {
        $this->_em->remove($entry);
        $this->_em->flush();
    }


    /**
     * @param EntryCriteria $criteria
     * @return EntryInterface|Income|Expenditure|null
     */
    public function findOneByCriteria(EntryCriteria $criteria)
    {
        $results = $this->findByCriteria($criteria);
        return isset($results[0]) ? $results[0] : null;
    }



    /**
     * @param EntryCriteria $criteria
     * @return array
     */
    public function findByCriteria(EntryCriteria $criteria)
    {
        $this->qb = $this->createQueryBuilder('e');
        $this->checkId($criteria);
        $this->checkUserId($criteria);
        $this->checkDate($criteria);
        $this->checkDateRange($criteria);
        $this->checkAmount($criteria);
        $this->checkCategory($criteria);
        $this->checkDescription($criteria);
        $this->checkNote($criteria);
        $this->checkType($criteria);
        $this->checkOrder($criteria);
        $this->checkLimit($criteria);
        $this->checkOffset($criteria);
        $query = $this->qb->getQuery();
        unset($this->qb);
        return $query->getResult();
    }

    /**
     * @param EntryCriteria $criteria
     */
    private function checkId(EntryCriteria $criteria)
    {
        if($criteria->hasId()) {
            $this->qb->andWhere('e.id = :id');
            $this->qb->setParameter('id', $criteria->getId());
        }
    }

    /**
     * @param EntryCriteria $criteria
     */
    private function checkUserId(EntryCriteria $criteria)
    {
        if($criteria->hasUserId()) {
            $this->qb->andWhere('e.userId = :userid');
            $this->qb->setParameter('userid', $criteria->getUserId());
        }
    }

    /**
     * @param EntryCriteria $criteria
     */
    private function checkDate(EntryCriteria $criteria)
    {
        if($criteria->hasDate()) {
            $this->qb->andWhere('e.date = :date');
            $this->qb->setParameter('date', $criteria->getDate());
        }
    }

    /**
     * @param EntryCriteria $criteria
     */
    private function checkDateRange(EntryCriteria $criteria)
    {
        if($criteria->hasDateRange()) {
            $this->qb->andWhere('e.date BETWEEN :fromdate AND :todate');
            $this->qb->setParameter('fromdate', $criteria->getDateRange()[0]);
            $this->qb->setParameter('todate', $criteria->getDateRange()[1]);
        }
    }

    /**
     * @param EntryCriteria $criteria
     */
    private function checkAmount(EntryCriteria $criteria)
    {
        if($criteria->hasAmount()) {
            $this->qb->andWhere('e.amount = :amount');
            $this->qb->setParameter('amount', $criteria->getAmount());
        }
    }

    /**
     * @param EntryCriteria $criteria
     */
    private function checkCategory(EntryCriteria $criteria)
    {
        if($criteria->hasCategory()) {
            $this->qb->andWhere('e.category = :category');
            $this->qb->setParameter('category', $criteria->getCategory());
        }
    }

    /**
     * @param EntryCriteria $criteria
     */
    private function checkDescription(EntryCriteria $criteria)
    {
        if($criteria->hasDescription()) {
            $this->qb->andWhere('e.description = :description');
            $this->qb->setParameter('description', $criteria->getDescription());
        }
    }

    /**
     * @param EntryCriteria $criteria
     */
    private function checkNote(EntryCriteria $criteria)
    {
        if($criteria->hasNote()) {
            $this->qb->andWhere('e.note = :note');
            $this->qb->setParameter('note', $criteria->getNote());
        }
    }

    /**
     * @param EntryCriteria $criteria
     */
    private function checkType(EntryCriteria $criteria)
    {
        if($criteria->hasType()) {
            $this->processType($criteria);
        }
    }

    /**
     * @param EntryCriteria $criteria
     */
    private function processType(EntryCriteria $criteria)
    {
        switch($criteria->getType()) {
            case 'IN':
                $this->qb->andWhere('e INSTANCE OF Del\Expenses\Entity\Income');
                break;
            case 'OUT':
                $this->qb->andWhere('e INSTANCE OF Del\Expenses\Entity\Expenditure');
                break;
        }
    }

    /**
     * @param EntryCriteria $criteria
     */
    private function checkOrder(EntryCriteria $criteria)
    {
        $criteria->hasOrder() ? $this->qb->addOrderBy('e.'.$criteria->getOrder(), $criteria->getOrderDirection()) : null;

    }

    /**
     * @param EntryCriteria $criteria
     */
    private function checkLimit(EntryCriteria $criteria)
    {
        $criteria->hasLimit() ? $this->qb->setMaxResults($criteria->getLimit()) : null;
    }

    /**
     * @param EntryCriteria $criteria
     */
    private function checkOffset(EntryCriteria $criteria)
    {
        $criteria->hasOffset() ? $this->qb->setFirstResult($criteria->getOffset()) : null;
    }

}
