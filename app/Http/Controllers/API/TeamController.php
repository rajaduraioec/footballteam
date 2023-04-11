<?php

namespace App\Http\Controllers\API;

use App\Models\Team;
use Illuminate\Http\Request;
use App\Services\TeamService;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\StoreTeamRequest;
use App\Http\Requests\UpdateTeamRequest;

class TeamController extends BaseController
{
    protected $teamService;

    public function __construct(TeamService $teamService)
    {
        $this->teamService = $teamService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $data['teams'] = $this->teamService->getAllTeams();

        return $this->sendResponse($data, 'Team list retrieved successfully.');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTeamRequest $request): JsonResponse
    {
        $data['team'] = $this->teamService->createTeam($request->validated());

        return $this->sendResponse($data, 'Team created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Team $team): JsonResponse
    {
        $data['team'] = $this->teamService->getTeamById($team->id);

        return $this->sendResponse($data, 'Team created successfully.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTeamRequest $request, Team $team): JsonResponse
    {
        $data['team'] = $this->teamService->updateTeam($request->validated(), $team->id);

        return $this->sendResponse($data, 'Team updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Team $team): JsonResponse
    {
        $this->teamService->deleteTeam($team->id);
        
        return $this->sendResponse([], 'Team deleted successfully.');
    }

    public function players(Request $request): JsonResponse
    {
        $code = $request->code ?? "";
        $name = $request->name ?? "";

        $data['players'] = $this->teamService->getTeamPlayers($code, $name);

        return $this->sendResponse($data, 'Team players retrieved successfully.');
    }
}
