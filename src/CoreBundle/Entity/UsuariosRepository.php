<?php

namespace CoreBundle\Entity;

use Symfony\Bridge\Doctrine\Security\User\UserLoaderInterface;
use Doctrine\ORM\EntityRepository;

class UsuariosRepository extends EntityRepository implements UserLoaderInterface
{
    public function loadUserByUsername($username)
    {
        return $this->createQueryBuilder('u')
            ->where('u.email = :email or u.user = :email')
            ->andWhere('u.activo = :act')
            ->andWhere('u.valido = :val')
            ->setParameter('email', $username)
            ->setParameter('act', 1)
            ->setParameter('val', 1)
            ->getQuery()
            ->getOneOrNullResult();
    }
}