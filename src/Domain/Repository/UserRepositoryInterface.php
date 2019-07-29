<?php

namespace App\Domain\Repository;
use App\Entity\User;

interface UserRepositoryInterface
{
    public function find(int $id): ?User;
    public function findOneByEmail(string $username): ?User;
    public function findOneActiveByUsername(string $username): ?User;
    public function save(User $user): void;
    public function remove(User $user): void;
}