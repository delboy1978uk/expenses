<?php

namespace Del\Expenses\Repository;

use Del\Expenses\Entity\EntryInterface;
use Del\Expenses\Criteria\EntryCriteria;
use Doctrine\ORM\EntityRepository;

class Entry extends EntityRepository
{
    /**
     * @param EntryInterface $entry
     * @return EntryInterface
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
     * @return array
     */
    public function findByCriteria(EntryCriteria $criteria)
    {
        $qb = $this->createQueryBuilder('e');

        if($criteria->hasId()) {
            $qb->where('e.id = :id');
            $qb->setParameter('id', $criteria->getId());
        }

        if($criteria->hasId()) {
            $qb->where('e.userId = :userid');
            $qb->setParameter('userid', $criteria->getId());
        }

        if($criteria->hasDate()) {
            $qb->where('e.date = :date');
            $qb->setParameter('date', $criteria->getDate());
        }

        if($criteria->hasAmount()) {
            $qb->where('e.amount = :amount');
            $qb->setParameter('amount', $criteria->getAmount());
        }

        if($criteria->hasCategory()) {
            $qb->andWhere('e.category = :category');
            $qb->setParameter('category', $criteria->getAka());
        }

        if($criteria->hasDescription()) {
            $qb->andWhere('e.description = :description');
            $qb->setParameter('description', $criteria->getDescription());
        }

        if($criteria->hasNote()) {
            $qb->andWhere('e.note = :note');
            $qb->setParameter('note', $criteria->getNote());
        }

        if($criteria->hasType()) {
            $qb->andWhere('e.type = :type');
            $qb->setParameter('type', $criteria->getType());
        }

        $criteria->hasOrder() ? $qb->addOrderBy($criteria->getOrder(), $criteria->getOrderDirection()) : null;
        $criteria->hasLimit() ? $qb->setMaxResults($criteria->getLimit()) : null;
        $criteria->hasOffset() ? $qb->setFirstResult($criteria->getOffset()) : null;

        $query = $qb->getQuery();

        return $query->getResult();
    }
}
