<?php

namespace Tests\Feature;

use Tests\TestCase;

class CommandsApiTest extends TestCase
{
    /** @test */
    public function api_accepts_post_with_valid_command()
    {
        $string = 'move north';
        $response = $this->post('/api/commands', ['command' => $string]);
        $response->assertStatus(200);
        $response->assertJsonStructure(['command','object']);
        $response->assertJson(['command' => 'move', 'object' => 'north']);
    }

    /** @test */
    public function api_rejects_post_with_invalid_command()
    {
        $string = 'hat off';
        $response = $this->post('/api/commands', ['command' => $string]);
        $response->assertStatus(422);
        $response->assertJsonStructure(['error']);
        $response->assertJson(['error' => 'Invalid user command']);
    }

    /** @test */
    public function api_accepts_post_with_aliased_command()
    {
        $string = 'go north';
        $response = $this->post('/api/commands', ['command' => $string]);
        $response->assertStatus(200);
    }

    /** @test */
    public function api_accepts_get_to_list_all_commands()
    {
        $response = $this->get('/api/commands');
        $response->assertStatus(200);
        $response->assertJsonStructure(['move','reset']);
    }

    /** @test */
    public function api_rejects_patch_put_delete()
    {
        $response = $this->patch('/api/commands');
        $response->assertStatus(405);

        $response = $this->put('/api/commands');
        $response->assertStatus(405);

        $response = $this->delete('/api/commands');
        $response->assertStatus(405);
    }
}
