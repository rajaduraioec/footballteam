<?php

namespace App\Http\Controllers\API;

use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\StoreTeamRequest;
use App\Http\Requests\UpdateTeamRequest;
use App\Repositories\TeamRepository;

class TeamController extends BaseController
{
    protected $teamRepository;

    public function __construct(TeamRepository $teamRepository)
    {
        $this->teamRepository = $teamRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $data['teams'] = $this->teamRepository->getAllTeams();

        return $this->sendResponse($data, 'Team list retrieved successfully.');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTeamRequest $request): JsonResponse
    {
        $data['team'] = $this->teamRepository->createTeam($request->validated());

        return $this->sendResponse($data, 'Team created successfully.', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Team $team): JsonResponse
    {
        $data['team'] = $this->teamRepository->getTeamById($team->id);

        return $this->sendResponse($data, 'Team created successfully.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTeamRequest $request, Team $team)
    {
        
        $data['team'] = $this->teamRepository->updateTeam($team->id, $request->validated());
        
        return $this->sendResponse($data, 'Team updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Team $team): JsonResponse
    {
        $this->teamRepository->deleteTeam($team->id);
        
        return $this->sendResponse([], 'Team deleted successfully.');
    }

    public function players(Request $request): JsonResponse
    {
        $code = $request->code ?? "";
        $name = $request->name ?? "";

        $data['players'] = $this->teamRepository->getTeamPlayers($code, $name);

        return $this->sendResponse($data, 'Team players retrieved successfully.');
    }
}
