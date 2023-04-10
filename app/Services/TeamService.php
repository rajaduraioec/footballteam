<?php

namespace App\Services;

use App\Models\Team;

class TeamService
{
    public function getAllTeams()
    {
        return Team::all();
    }

    public function createTeam(array $data)
    {
        return Team::create($data);
    }
    
    public function getTeamById($id)
    {
        return Team::findOrFail($id);
    }

    public function updateTeam(array $data, $id)
    {
        $team = Team::findOrFail($id);
        $team->update($data);

        return $team;
    }

    public function deleteTeam($id)
    {
        $team = Team::findOrFail($id);
        $team->delete();
    }
}