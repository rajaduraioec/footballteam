<?php

namespace App\Http\Controllers\API;

use App\Models\Player;
use Illuminate\Http\Request;
use App\Services\PlayerService;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\StorePlayerRequest;
use App\Http\Requests\UpdatePlayerRequest;
use App\Http\Controllers\API\BaseController;

class PlayerController extends BaseController
{
    protected $playerService;

    public function __construct(PlayerService $playerService)
    {
        $this->playerService = $playerService;
        $this->authorizeResource(Player::class, 'player');
    }
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $data['players'] = $this->playerService->getAllPlayers();

        return $this->sendResponse($data, 'Player list retrieved successfully.');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePlayerRequest $request): JsonResponse
    {
        $data['player'] = $this->playerService->createPlayer($request->validated());

        return $this->sendResponse($data, 'Player created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Player $player): JsonResponse
    {
        $data['player'] = $this->playerService->getPlayerById($player->id);

        return $this->sendResponse($data, 'Player retrieved successfully.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePlayerRequest $request, Player $player): JsonResponse
    {
        $data['player'] = $this->playerService->updatePlayer($request->validated(), $player->id);

        return $this->sendResponse($data, 'Player updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Player $player): JsonResponse
    {
        $this->playerService->deletePlayer($player->id);
        
        return $this->sendResponse([], 'Player deleted successfully.');
    }
    
    public function player(Request $request): JsonResponse
    {
        $code = $request->code ?? "";
        $name = $request->name ?? "";
        
        $data['player'] = $this->playerService->getPlayer($code, $name);

        return $this->sendResponse($data, 'Player retrieved successfully.');
    }
}
