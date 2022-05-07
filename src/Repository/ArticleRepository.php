<?php

namespace App\Repository;

use App\Entity\Article;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Article|null find($id, $lockMode = null, $lockVersion = null)
 * @method Article|null findOneBy(array $criteria, array $orderBy = null)
 * @method Article[]    findAll()
 * @method Article[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Article::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Article $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(Article $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    public function orderByTitre(){

        $em = $this->getEntityManager();
        $query = $em->createQuery('select a from App\Entity\Article a order by a.titre ASC');
        return $query->getResult();

    }
    public function orderByDate(){

    $em = $this->getEntityManager();
    $query = $em->createQuery('select a from App\Entity\Article a order by a.Date ASC');
    return $query->getResult();

}
    public function showNbCommentaire(){

        $qb = $this->getEntityManager()->createQueryBuilder();
        return $qb->select('count (r.id)')
            ->from('App\Entity\Article', 'a')
            ->join('App\Entity\Review', 'r', 'a.id=r.article_id')
            ->getQuery()
            ->getResult();
    }

    public function search($titre)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.titre LIKE :titre ')
            ->setParameter('titre', '%'.$titre.'%')
            ->getQuery()
            ->execute();
    }

    public function username()
    {
        $em = $this->getEntityManager();
        $query = $em->createQuery('SELECT u.username from App\Entity\Users u INNER join App\Entity\Article a ON a.user_id=u.id;');
        return $query->getResult();
    }



}