<?php

namespace Tests\Feature;

use App\Models\Player;
use App\Models\Team;
use App\Models\User;
use Tests\TestCase;

class TeamTest extends TestCase
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

    /**
     * A basic feature test example.
     */
    public function test_authenticated_admin_user_get_all_teams(): void
    {
        $team = Team::factory()->create();

        $response = $this->get('/api/team', $this->headers);

        $response->assertStatus(200);
        $response->assertJson([ 'success' => true ]);

        $response->assertJsonFragment([
            'code' => $team->code,
            'name' => $team->name,
            'logoURI' => $team->logoURI
        ]);
    }

    public function test_authenticated_admin_user_can_save_team(): void
    {
        $data = [
            'name' => 'Qatar',
            'logoURI' => 'https://qatar.com/football-team-logo.png'
        ];

        $response = $this->post('/api/team', $data, $this->headers);

        $response->assertStatus(201);
        $response->assertJson([ 'success' => true ]);

        $response->assertJsonFragment([
            'name' => 'Qatar',
            'logoURI' => 'https://qatar.com/football-team-logo.png'
        ]);
    }

    public function test_authenticated_admin_user_can_get_team_by_code(): void
    {
        $team = Team::factory()->create();

        $response = $this->get("/api/team/{$team->code}", $this->headers);

        $response->assertStatus(200);
        $response->assertJson([ 'success' => true ]);

        $response->assertJsonFragment([
            'code' => $team->code,
            'name' => $team->name,
            'logoURI' => $team->logoURI
        ]);
    }

    public function test_authenticated_admin_user_can_update_team(): void
    {
        $team = Team::factory()->create();

        $data = [
            'name' => 'England',
            'logoURI' => 'https://england.com/football-team-logo.png'
        ];

        $response = $this->put("/api/team/{$team->code}", $data, $this->headers);

        $response->assertStatus(200);
        $response->assertJson([ 'success' => true ]);

        $response->assertJsonFragment([
            'name' => 'England',
            'logoURI' => 'https://england.com/football-team-logo.png'
        ]);
    }

    public function test_authenticated_admin_user_can_delete_team(): void
    {
        $team = Team::factory()->create();

        $response = $this->delete("/api/team/{$team->code}", [], $this->headers);

        $response->assertStatus(200);
        $response->assertJson([ 'success' => true ]);
        $this->assertModelMissing($team);
    }

    public function test_unauthenticated_user_get_all_teams(): void
    {
        $team = Team::factory()->create();

        $response = $this->get('/api/team');

        $response->assertStatus(200);
        $response->assertJson([ 'success' => true ]);

        $response->assertJsonFragment([
            'code' => $team->code,
            'name' => $team->name,
            'logoURI' => $team->logoURI
        ]);
    }

    public function test_unauthenticated_user_get_team_players_by_unique_identifier(): void
    {
        $team = Team::factory()->create();
        $player = Player::factory()->for($team)->create();

        $response = $this->post('/api/team/players', [
            'code' => $team->code
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

    public function test_unauthenticated_user_get_team_players_by_team_name(): void
    {
        $team = Team::factory()->create();
        $player = Player::factory()->for($team)->create();

        $response = $this->post('/api/team/players', [
            'name' => $team->name
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
