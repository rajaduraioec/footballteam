<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController;
use App\Models\Player;
use App\Http\Requests\StorePlayerRequest;
use App\Http\Requests\UpdatePlayerRequest;
use App\Services\PlayerService;

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
    public function index()
    {
        $data['players'] = $this->playerService->getAllPlayers();

        return $this->sendResponse($data, 'Player list retrieved successfully.');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePlayerRequest $request)
    {
        $data['player'] = $this->playerService->createPlayer($request->validated());

        return $this->sendResponse($data, 'Player created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Player $player)
    {
        $data['player'] = $this->playerService->createPlayer($player->id);

        return $this->sendResponse($data, 'Player created successfully.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePlayerRequest $request, Player $player)
    {
        $data['player'] = $this->playerService->updatePlayer($request->validated(), $player->id);

        return $this->sendResponse($data, 'Player updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Player $player)
    {
        $data['player'] = $this->playerService->deletePlayer($player->id);
        
        return $this->sendResponse($data, 'Player deleted successfully.');
    }
}
