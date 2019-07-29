<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Domain\Repository;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

final class UserRepository implements UserRepositoryInterface
{
    private const ENTITY = User::class;
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;
    /**
     * @var ObjectRepository
     */
    private $objectRepository;
    public function __construct(
       EntityManagerInterface $entityManager
    ) {
        $this->entityManager = $entityManager;
        $this->objectRepository = $this->entityManager->getRepository(self::ENTITY);
    }
    public function find(int $id): ?User
    {
        $this->entityManager->find(self::ENTITY, $id->toString());
    }
    public function findOneActiveByUsername(string $username): ?User
    {
        return $this->objectRepository->findOneBy(['username' => $username, 'active' => true]);
    }
    
    public function findOneByEmail(string $username): ?User
    {
        return $this->objectRepository->findOneBy(['username' => $username]);
    }
    public function save(User $user): void
    {
        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }
    public function remove(User $user): void
    {
        $this->entityManager->remove($user);
        $this->entityManager->flush();
    }
}