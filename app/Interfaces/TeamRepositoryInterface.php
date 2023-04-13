<?php

namespace App\Interfaces;

use Illuminate\Http\Resources\Json\JsonResource;


interface TeamRepositoryInterface
{
    public function getAllTeams(): JsonResource;

    public function createTeam(array $teamArray): JsonResource;

    public function getTeamById(int $teamId): JsonResource;

    public function updateTeam(int $teamId, array $updatedTeamArray): JsonResource;

    public function deleteTeam(int $teamId): JsonResource;

    public function getTeamPlayers(string $code, string $name): JsonResource;
}