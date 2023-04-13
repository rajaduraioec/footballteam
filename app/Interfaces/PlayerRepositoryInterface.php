<?php

namespace App\Interfaces;

use Illuminate\Http\Resources\Json\JsonResource;

interface PlayerRepositoryInterface
{
    public function getAllPlayers(): JsonResource;

    public function createPlayer(array $playerArray): JsonResource;

    public function getPlayerById(int $playerId): JsonResource;

    public function updatePlayer(int $playerId, array $updatedPlayerArray): JsonResource;

    public function deletePlayer(int $playerId): JsonResource;

    public function getPlayer(string $code, string $name): JsonResource;
}