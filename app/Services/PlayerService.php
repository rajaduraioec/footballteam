<?php

namespace App\Services;

use App\Models\Player;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\PlayerResource;
use App\Models\Team;
use Illuminate\Http\Resources\Json\JsonResource;

class PlayerService
{    
    public function getAllPlayers(): JsonResource
    {
        return PlayerResource::collection(Player::all());
    }

    public function createPlayer(array $data): JsonResource
    {
        $team = Team::where('code', '=', $data['teamCode'])->firstOrFail();

        return new PlayerResource(Player::create(array_merge($data, [ 'teamId' => $team->id ])));
    }
    
    public function getPlayerById(int $id): JsonResource
    {
        return new PlayerResource(Player::findOrFail($id));
    }

    public function updatePlayer(array $data, int $id): JsonResource
    {
        $player = Player::findOrFail($id);
        $player->update($data);

        return new PlayerResource($player);
    }

    public function deletePlayer(int $id): void
    {
        $player = Player::findOrFail($id);
        $player->delete();
    }

    public function getPlayer(string $code, string $name): JsonResource
    {
        $player = Player::where(DB::raw('concat(firstName, " ", lastName)'), '=', $name)
            ->orWhere('code', '=', $code)->firstOrFail();

        return new PlayerResource($player);
    }
}