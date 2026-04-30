<?php

namespace App\Repository;

use App\Entity\Project;
use App\Entity\Tag;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Project>
 */
class ProjectRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Project::class);
    }

    public function findByTag(Tag $tag): array
    {
        return $this->createQueryBuilder('project')
            ->innerJoin('project.tags', 'tag')
            ->where('tag.id = :tagId')
            ->setParameter('tagId', $tag->getId())
            ->getQuery()
            ->getResult();
    }
}
