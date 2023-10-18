<?php

namespace App\Repositories\Purse;

interface IPurseRepository
{
    public function purseList(string $user_id,array $data = null);
    public function createPurse(string $user_id,array $data);
    public function readPurse(string $id);
    public function updatePurse(string $id,array $data);
    public function deletePurse(string $id);
    public function addUser(string $purseId, string $userId, int $percentage);
    public function updateUser(string $purseId, string $userId, int $percentage);
    public function deleteUser(string $id);
}
