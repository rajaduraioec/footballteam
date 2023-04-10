<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\StoreTeamRequest;
use App\Http\Requests\UpdateTeamRequest;
use App\Models\Team;
use App\Services\TeamService;

class TeamController extends BaseController
{
    protected $teamService;

    public function __construct(TeamService $teamService)
    {
        $this->teamService = $teamService;
        $this->authorizeResource(Team::class, 'team');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['teams'] = $this->teamService->getAllTeams();

        return $this->sendResponse($data, 'Team list retrieved successfully.');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTeamRequest $request)
    {
        $data['team'] = $this->teamService->createTeam($request->validated());

        return $this->sendResponse($data, 'Team created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Team $team)
    {
        $data['team'] = $this->teamService->getTeamById($team->id);

        return $this->sendResponse($data, 'Team created successfully.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTeamRequest $request, Team $team)
    {
        $data['team'] = $this->teamService->updateTeam($request->validated(), $team->id);

        return $this->sendResponse($data, 'Team updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Team $team)
    {
        $data['team'] = $this->teamService->deleteTeam($team->id);
        return $this->sendResponse($team, 'Team deleted successfully.');
    }
}
