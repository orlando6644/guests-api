<?php

namespace App\Repositories\Contracts;

interface GuestRepositoryInterface
{
    public function getAll(): array;
    public function getById(int $id): ?array;
    public function create(array $data): array;
    public function update(int $id, array $data): bool;
    public function delete(int $id): bool;
}