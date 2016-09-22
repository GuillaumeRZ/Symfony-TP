<?php
/**
 * Created by PhpStorm.
 * User: guillaumeremy-zephir
 * Date: 22/09/2016
 * Time: 14:19
 */

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class ReplyRepository extends EntityRepository {
	public function RepliesOrder()
	{
		return $this->createQueryBuilder('reply')
		            ->orderBy('subject.vote', 'DESC')
		            ->getQuery()
		            ->getResult();
	}
}