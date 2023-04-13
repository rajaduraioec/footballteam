<?php

namespace Tests\Feature;

use App\Models\Player;
use App\Models\Team;
use Tests\TestCase;
use App\Models\User;

class PlayerTest extends TestCase
{
    private $token;
    private $headers;

    public function setUp(): void
    {
        parent::setUp();

        $user = User::factory([ 'is_admin' => 1 ])->create();
        $this->token = $user->createToken('TestToken')->plainTextToken;

        $this->headers = [
            'Authorization' => "Bearer {$this->token}",
            'Accept' => 'application/json'
        ];
    }

    public function test_authenticated_admin_user_can_save_player(): void
    {
        $team = Team::factory()->create();

        $data = [
            'firstName' => fake()->firstName(),
            'lastName' => fake()->lastName(),
            'playerImageURI' => fake()->imageUrl(),
            'teamCode' => $team->code
        ];

        $response = $this->post('/api/player', $data, $this->headers);

        $response->assertStatus(201);
        $response->assertJson([ 'success' => true ]);

        $response->assertJsonFragment([
            'firstName' => $data['firstName'],
            'lastName' => $data['lastName'],
            'playerImageURI' => $data['playerImageURI'],
        ]);
    }

    public function test_authenticated_admin_user_can_get_player_by_code(): void
    {
        $player = Player::factory()->for(Team::factory()->create())->create();

        $response = $this->get("/api/player/{$player->code}", $this->headers);

        $response->assertStatus(200);
        $response->assertJson([ 'success' => true ]);

        $response->assertJsonFragment([
            'code' => $player->code,
            'firstName' => $player->firstName,
            'lastName' => $player->lastName,
            'playerImageURI' => $player->playerImageURI
        ]);
    }

    public function test_authenticated_admin_user_can_update_player(): void
    {
        $player = Player::factory()->for(Team::factory()->create())->create();

        $newTeam = Team::factory()->create();

        $data = [
            'firstName' => fake()->firstName(),
            'lastName' => fake()->lastName(),
            'playerImageURI' => fake()->imageUrl(),
            'teamCode' => $newTeam->code
        ];

        $response = $this->put("/api/player/{$player->code}", $data, $this->headers);

        $response->assertStatus(200);
        $response->assertJson([ 'success' => true ]);

        $response->assertJsonFragment([
            'firstName' => $data['firstName'],
            'lastName' => $data['lastName'],
            'playerImageURI' => $data['playerImageURI'],
        ]);
    }

    public function test_authenticated_admin_user_can_delete_player(): void
    {
        $player = Player::factory()->for(Team::factory()->create())->create();

        $response = $this->delete("/api/player/{$player->code}", [], $this->headers);

        $response->assertStatus(200);
        $response->assertJson([ 'success' => true ]);
        $this->assertModelMissing($player);
    }

    public function test_unauthenticated_user_get_player_by_unique_identifier(): void
    {
        $player = Player::factory()->for(Team::factory()->create())->create();

        $response = $this->post('/api/player/info', [
            'code' => $player->code
        ]);

        $response->assertStatus(200);
        $response->assertJson([ 'success' => true ]);

        $response->assertJsonFragment([
            'code' => $player->code,
            'firstName' => $player->firstName,
            'lastName' => $player->lastName,
            'playerImageURI' => $player->playerImageURI
        ]);
    }

    public function test_unauthenticated_user_get_player_by_name(): void
    {
        $player = Player::factory()->for(Team::factory()->create())->create();

        $response = $this->post('/api/player/info', [
            'name' => "{$player->firstName} {$player->lastName}"
        ]);

        $response->assertStatus(200);
        $response->assertJson([ 'success' => true ]);

        $response->assertJsonFragment([
            'code' => $player->code,
            'firstName' => $player->firstName,
            'lastName' => $player->lastName,
            'playerImageURI' => $player->playerImageURI
        ]);
    }
}
