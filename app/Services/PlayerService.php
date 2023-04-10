<?php

namespace App\Services;

use App\Models\Player;

class PlayerService
{    
    public function getAllPlayers()
    {
        return Player::all();
    }

    public function createPlayer(array $data)
    {
        return Player::create($data);
    }
    
    public function getPlayerById($id)
    {
        return Player::findOrFail($id);
    }

    public function updatePlayer(array $data, $id)
    {
        $player = Player::findOrFail($id);
        $player->update($data);

        return $player;
    }

    public function deletePlayer($id)
    {
        $player = Player::findOrFail($id);
        $player->delete();
    }
}