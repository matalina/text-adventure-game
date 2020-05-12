<?php

namespace App\Http\Controllers;

use App\Http\Requests\ParseCommandRequest;
use App\Services\CommandParser;

class CommandController extends Controller
{
    protected $parser;

    public function __construct(CommandParser $parser)
    {
        $this->parser = $parser;
    }

    public function index()
    {
        return $this->parser->get();
    }

    public function parse(ParseCommandRequest $request)
    {
        return $this->parser->parse($request->get('command'));
    }
}
