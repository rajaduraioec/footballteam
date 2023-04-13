<?php

namespace App\Repositories;

use App\Models\Team;
use App\Models\Player;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\PlayerResource;
use App\Interfaces\PlayerRepositoryInterface;
use Illuminate\Http\Resources\Json\JsonResource;

class PlayerRepository implements PlayerRepositoryInterface
{
    public function getAllPlayers(): JsonResource
    {
        return PlayerResource::collection(Player::all());
    }

    public function createPlayer(array $playerArray): JsonResource
    {
        $team = Team::where('code', '=', $playerArray['teamCode'])->firstOrFail();

        return new PlayerResource(Player::create(array_merge($playerArray, ['teamId' => $team->id])));
    }

    public function getPlayerById(int $playerId): JsonResource
    {
        return new PlayerResource(Player::findOrFail($playerId));
    }

    public function updatePlayer(int $playerId, array $updatedPlayerArray): JsonResource
    {
        $player = Player::findOrFail($playerId);
        $player->update($updatedPlayerArray);

        return new PlayerResource($player);
    }

    public function deletePlayer(int $playerId): JsonResource
    {
        $player = Player::findOrFail($playerId);
        $player->delete();

        return new PlayerResource($player);
    }

    public function getPlayer(string $code, string $name): JsonResource
    {
        $player = Player::where(DB::raw('concat(firstName, " ", lastName)'), '=', $name)
            ->orWhere('code', '=', $code)->firstOrFail();

        return new PlayerResource($player);
    }
}
