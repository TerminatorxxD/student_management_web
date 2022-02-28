<?php

namespace App\Repository;

use App\Entity\Score;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Score|null find($id, $lockMode = null, $lockVersion = null)
 * @method Score|null findOneBy(array $criteria, array $orderBy = null)
 * @method Score[]    findAll()
 * @method Score[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ScoreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Score::class);
    }

//    // /**
//    //  * @return Score[] Returns an array of Score objects
//    //  */
//    /*
    public function findByStudentID($value)
    {
        return $this->createQueryBuilder('s')
            ->setParameter('val', $value)
            ->andWhere('s.StudentID = :val')
            ->orderBy('s.StudentID', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    public function findScoreByStudentIdAndSubjectId($studentId, $subjectId){
        return $this->createQueryBuilder("s")
            ->setParameters(
                [
                    'studentId' => $studentId,
                    'subjectId' => $subjectId
                ]
            )
            ->where("s.StudentID = :studentId")
            ->andWhere("s.SubjectID = :subjectId")
            ->getQuery()
            ->getResult();
    }

    /*
    public function findOneBySomeField($value): ?Score
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
