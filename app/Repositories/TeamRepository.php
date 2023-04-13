<?php

namespace App\Repositories;

use App\Models\Team;
use App\Http\Resources\TeamResource;
use App\Http\Resources\PlayerResource;
use App\Interfaces\TeamRepositoryInterface;
use Illuminate\Http\Resources\Json\JsonResource;

class TeamRepository implements TeamRepositoryInterface
{
    public function getAllTeams(): JsonResource
    {
        return TeamResource::collection(Team::all());
    }

    public function createTeam(array $teamArray): JsonResource
    {
        return new TeamResource(Team::create($teamArray));
    }

    public function getTeamById(int $teamId): JsonResource
    {
        return new TeamResource(Team::findOrFail($teamId));
    }

    public function updateTeam(int $teamId, array $updatedTeamArray): JsonResource
    {
        $team = Team::findOrFail($teamId);
        $team->update($updatedTeamArray);
        
        return new TeamResource($team);
    }

    public function deleteTeam(int $teamId): JsonResource
    {
        $team = Team::findOrFail($teamId);
        $team->delete();

        return new TeamResource($team);
    }

    public function getTeamPlayers(string $code, string $name): JsonResource
    {
        $team = Team::where('code', '=', $code)->orWhere('name', '=', $name)->firstOrFail();

        return PlayerResource::collection($team->players);   
    }
}