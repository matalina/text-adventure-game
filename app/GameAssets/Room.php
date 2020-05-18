<?php


namespace App\GameAssets;


use App\Exceptions\RoomDoesNotExistException;
use Mni\FrontYAML\Parser;

class Room
{
    private $id;
    private $name;
    private $description;
    private $items;
    private $exits;

    public function __construct($filename) {
        if(! \File::exists(storage_path('game/rooms/'.$filename.'.md'))) {
            throw new RoomDoesNotExistException();
        }

        $file = \File::get(storage_path('game/rooms/'.$filename.'.md'));
        $parser = new Parser;
        $document = $parser->parse($file, false);
        $yaml = $document->getYAML();
        $content = $document->getContent();

        $this->id = $yaml['id'];
        $this->name = $yaml['name'];
        $this->items = $yaml['items'];
        $this->exits = $yaml['exits'];
        $this->description = $content;
    }

    public function get()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'items' => $this->items,
            'exits' => $this->exits,
        ];
    }
}
