<?php

namespace App\Http\Controllers\API;

use App\Models\Player;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\StorePlayerRequest;
use App\Http\Requests\UpdatePlayerRequest;
use App\Http\Controllers\API\BaseController;
use App\Repositories\PlayerRepository;

class PlayerController extends BaseController
{
    protected $playerRepository;

    public function __construct(PlayerRepository $playerRepository)
    {
        $this->playerRepository = $playerRepository;
        $this->authorizeResource(Player::class, 'player');
    }
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $data['players'] = $this->playerRepository->getAllPlayers();

        return $this->sendResponse($data, 'Player list retrieved successfully.');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePlayerRequest $request): JsonResponse
    {
        $data['player'] = $this->playerRepository->createPlayer($request->validated());

        return $this->sendResponse($data, 'Player created successfully.', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Player $player): JsonResponse
    {
        $data['player'] = $this->playerRepository->getPlayerById($player->id);

        return $this->sendResponse($data, 'Player retrieved successfully.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePlayerRequest $request, Player $player): JsonResponse
    {
        $data['player'] = $this->playerRepository->updatePlayer($player->id, $request->validated());

        return $this->sendResponse($data, 'Player updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Player $player): JsonResponse
    {
        $this->playerRepository->deletePlayer($player->id);
        
        return $this->sendResponse([], 'Player deleted successfully.');
    }
    
    public function player(Request $request): JsonResponse
    {
        $code = $request->code ?? "";
        $name = $request->name ?? "";
        
        $data['player'] = $this->playerRepository->getPlayer($code, $name);

        return $this->sendResponse($data, 'Player retrieved successfully.');
    }
}
