<?php

namespace App\Services;

use App\Models\Team;
use App\Http\Resources\TeamResource;
use App\Http\Resources\PlayerResource;
use Illuminate\Http\Resources\Json\JsonResource;

class TeamService
{
    public function getAllTeams(): JsonResource
    {
        return TeamResource::collection(Team::all());
    }

    public function createTeam(array $data): JsonResource
    {
        return new TeamResource(Team::create($data));
    }

    public function getTeamById(int $id): JsonResource
    {
        return new TeamResource(Team::findOrFail($id));
    }

    public function updateTeam(array $data, int $id): JsonResource
    {
        $team = Team::findOrFail($id);
        $team->update($data);

        return new TeamResource($team);
    }

    public function deleteTeam(int $id): void
    {
        $team = Team::findOrFail($id);
        $team->delete();
    }

    public function getTeamPlayers(string $code, string $name): JsonResource
    {
        $team = Team::where('code', '=', $code)->orWhere('name', '=', $name)->firstOrFail();

        return PlayerResource::collection($team->players);        
    }
}