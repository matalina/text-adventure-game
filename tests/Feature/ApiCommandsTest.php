<?php

namespace Tests\Feature;

use App\Exceptions\InvalidCommandException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CommandsApiTest extends TestCase
{
    /** @test */
    public function api_accepts_post_with_valid_command()
    {
        $string = 'move north';
        $response = $this->post('/api/commands/parse', ['command' => $string]);
        $response->assertStatus(200);
        $response->assertJsonStructure(['command','object']);
        $response->assertJson(['command' => 'move', 'object' => 'north']);
    }

    /** @test */
    public function api_rejects_post_with_invalid_command()
    {
        $string = 'hat off';
        $response = $this->post('/api/commands/parse', ['command' => $string]);
        $response->assertStatus(422);
        $response->assertJsonStructure(['error']);
        $response->assertJson(['error' => 'Invalid user command']);
    }

    /** @test */
    public function api_accepts_post_with_aliased_command()
    {
        $string = 'go north';
        $response = $this->post('/api/commands/parse', ['command' => $string]);
        $response->assertStatus(200);
    }

}
