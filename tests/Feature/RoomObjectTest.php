<?php

namespace Tests\Feature;

use App\Exceptions\RoomDoesNotExistException;
use App\GameAssets\Room;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class RoomObjectTest extends TestCase
{
    private function createRoom1(): void
    {
        $content = "---
id: 1
name: Your Studio Apartment
items:
    sofa: item_1
exits:
    north:
        name: bathroom
        id: room_2
        locked: false
    west:
        name: hall
        id: room_3
        locked: true
        key: item_3
---
Using markdown formatting you can describe your studio apartment here including all the objects that you'd like to have interacted with such as your **sofa** with bold lettering.
";
        Storage::fake('local');
        Storage::put(storage_path('game/rooms/room_1.md'), $content);
    }

    private function createRoom2(): void
    {
        $content = "---
id: 2
name: The Bathroom
items:
    note: item_2
exits:
    south:
        name: studio
        id: room_1
        locked: false
---
This is your bathroom with a **note** scribbled on the mirror.
";
        Storage::fake('local');
        Storage::put(storage_path('game/rooms/room_2.md'), $content);
    }

    /** @test */
    public function parse_room_object()
    {
        $this->createRoom1();

        $room = new Room('room_1');

        $this->assertClassHasAttribute('id',Room::class);
        $this->assertClassHasAttribute('name',Room::class);
        $this->assertClassHasAttribute('description',Room::class);
        $this->assertClassHasAttribute('items',Room::class);
        $this->assertClassHasAttribute('exits',Room::class);
    }

    /** @test */
    public function reject_nonexisting_room_object()
    {
        $this->createRoom1();

        $this->expectException(RoomDoesNotExistException::class);
        $room = new Room('room_100');
    }

    /** @test */
    public function get_room_object()
    {
        $this->createRoom1();

        $room = new Room('room_1');
        $data = $room->get();

        $this->assertEquals(1,$data['id']);
        $this->assertEquals('Your Studio Apartment',$data['name']);
        $this->assertEquals('item_1',$data['items']['sofa']);
    }

    /** @test */
    public function api_accepts_get_room_1()
    {
        $response = $this->get('/api/rooms/room_1');
        $response->assertStatus(200);
        $response->assertJsonStructure(['id','name','description','items','exits']);
        $response->assertJson(['id' => 1]);
    }

    /** @test */
    public function api_rejects_get_room_100()
    {
        $response = $this->get('/api/rooms/room_100');
        $response->assertStatus(422);
        $response->assertJsonStructure(['error']);
        $response->assertJson(['error' => 'No such room exists']);
    }
}
