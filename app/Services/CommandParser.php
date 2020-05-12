<?php
namespace App\Services;

use App\Exceptions\InvalidCommandException;

class CommandParser
{
    protected $commands;
    protected $aliases = [];
    protected $ignore = [
        'a','an','the',
        'in','on','at','of','for', 'under','over','with','after','before', 'as','below','by', 'from','to','near','into',
        'inside','outside','within','without','toward','towards','across','against','along','around','beneath','beside','besides',
        'between','off','past','underneath','upon','via','up','down',
    ];

    public function __construct($commands)
    {
        $this->commands = $commands;
        foreach($commands as $command => $info) {
            $this->aliases[$command] = $command;
            foreach($info['aliases'] as $alias) {
                $this->aliases[$alias] = $command;
            }
        }
    }

    public function parse($string)
    {
        $parsed = [];
        $parts = explode(' ', $string);
        $command = $parts[0];

        if(! isset($this->aliases[$command])) {
            throw new InvalidCommandException();
        }

        $command = $this->aliases[$command];
        $parts[0] = $command;

        // process special cases
        $special_cases = ($parts[0] == 'move' && ($parts[1] == 'up' || $parts[1] == 'down')); // move up or move down

        if(! $special_cases) {
            foreach($parts as $key => $p) {
                if(in_array($p,array_merge($this->ignore))) {
                    unset($parts[$key]);
                }
            }
        }

        $parts = array_values($parts);

        preg_match_all('/<([\w \|\?]+)>/',$this->commands[$command]['format'],$format);

        foreach($format[1] as $key => $f) {
            if(preg_match('/.+\?$/',$f)) {
                if(! isset($parts[$key])) {
                    $parts[$key] = null;
                }
            }
        }

        if(count($parts) < count($format[1])) {
            throw new InvalidCommandException();
        }

        foreach($format[1] as $key => $f) {
            $parsed[$f] = $parts[$key];
        }

        return $parsed;
    }

    public function get()
    {
        return $this->commands;
    }
}
