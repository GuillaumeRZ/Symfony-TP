<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class SubjectRepository extends EntityRepository
{
	public function findNotResolved()
	{
		return $this->createQueryBuilder('subject')
		            ->where('subject.resolved = false')
		            ->orderBy('subject.vote', 'DESC')
		            ->getQuery()
		            ->getResult();
	}

	public function findResolved()
	{
		return $this->createQueryBuilder('subject')
		            ->where('subject.resolved = true')
		            ->setParameter("dateSixMonths", new \DateTime('-6 months'))
		            ->andWhere('subject.updatedAt > :dateSixMonths')
		            ->getQuery()
		            ->getResult();
	}
}