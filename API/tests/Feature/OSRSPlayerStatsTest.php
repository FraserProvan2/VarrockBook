<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OSRSPlayerStatsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * makes sure stats are fetched
     *
     * @return void
     */
    public function check_player_stats_fetched()
    {
        $response = $this->get('/api/playerStats/krun64');
        
        $response
            ->assertOk()
            ->assertJson([
                'username' => 'krun64',
                'stats' => []
            ]);
    }

    /**
     * @test
     * check for correct error code when no player found
     *
     * @return void
     */
    public function check_player_stats_for_no_player()
    {
        $response = $this->get('/api/playerStats/thisisnotauser');

        $response
        ->assertStatus(404)
        ->assertJson([
            'message' => 'Player thisisnotauser not found.'
        ]);
    }

}