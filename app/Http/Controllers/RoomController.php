<?php
namespace App\Http\Controllers;

use App\GameAssets\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function show($id)
    {
        $room = new Room($id);
        return $room->get();
    }
}
