<?php

namespace Tests\Feature;

use App\Exceptions\InvalidCommandException;
use App\Services\CommandParser;
use Tests\TestCase;

class ParseCommandTest extends TestCase
{
    private function parseCommand($string) {
        $commands = [
            'move' => [
                'format' => '<command> <object>',
                'aliases' => ['go'],
                'description' => 'Move to an object',
            ],
            'get' => [
                'format' => '<command> <object>',
                'aliases' => ['take'],
                'description' => 'Get an object',
            ],
            'put' => [
                'format' => '<command> <object> <xn_object?>',
                'aliases' => ['set'],
                'description' => 'Put an object on or in another object. If a second object is not specified it will be put into your backpack if it fits.',
            ],


        ];

        $service = new CommandParser($commands);

        return $service->parse($string);
    }

    /** @test */
    public function parse_simple_valid_command()
    {
        $command = $this->parseCommand('get sword');

        $this->assertIsArray($command);
        $this->assertCount(2,$command);
        $this->assertArrayHasKey('object',$command);
        $this->assertArrayHasKey('command',$command);
        $this->assertEquals('get', $command['command']);
        $this->assertEquals('sword', $command['object']);
    }

    /** @test */
    public function reject_invalid_command()
    {
        $this->expectException(InvalidCommandException::class);

        $command = $this->parseCommand('hat north');
    }

    /** @test */
    public function reject_valid_command_with_missing_parameters()
    {
        $this->expectException(InvalidCommandException::class);

        $command = $this->parseCommand('get');
    }

    /** @test */
    public function parse_valid_command_with_optional_parameters_included()
    {
        $command = $this->parseCommand('put hat rack');

        $this->assertIsArray($command);
        $this->assertCount(3,$command);
        $this->assertArrayHasKey('object',$command);
        $this->assertArrayHasKey('command',$command);
        $this->assertArrayHasKey('xn_object?',$command);
    }

    /** @test */
    public function parse_valid_command_with_optional_parameters_excluded()
    {
        $command = $this->parseCommand('put hat');

        $this->assertIsArray($command);
        $this->assertCount(3,$command);
        $this->assertArrayHasKey('object',$command);
        $this->assertArrayHasKey('command',$command);
        $this->assertArrayHasKey('xn_object?',$command);
        $this->assertEquals(null, $command['xn_object?']);
    }

    /** @test */
    public function parse_valid_command_and_ignore_exception_words()
    {
        $command = $this->parseCommand('get the at in on with up down sword');

        $this->assertIsArray($command);
        $this->assertCount(2,$command);
        $this->assertArrayHasKey('object',$command);
        $this->assertArrayHasKey('command',$command);

        $this->assertEquals('sword',$command['object']);
    }

    /** @test */
    public function parse_move_up_command()
    {
        $command = $this->parseCommand('move up');

        $this->assertIsArray($command);
        $this->assertCount(2,$command);
        $this->assertArrayHasKey('object',$command);
        $this->assertArrayHasKey('command',$command);
    }

    /** @test */
    public function parse_move_down_command()
    {
        $command = $this->parseCommand('move down');

        $this->assertIsArray($command);
        $this->assertCount(2,$command);
        $this->assertArrayHasKey('object',$command);
        $this->assertArrayHasKey('command',$command);
    }

    /** @test */
    public function parse_aliased_command()
    {
        $command = $this->parseCommand('take sword');

        $this->assertIsArray($command);
        $this->assertCount(2,$command);
        $this->assertArrayHasKey('object',$command);
        $this->assertArrayHasKey('command',$command);
        $this->assertEquals('get', $command['command']);
        $this->assertEquals('sword', $command['object']);
    }

    /** @test */
    public function parse_aliased_move_up_command()
    {
        $command = $this->parseCommand('go up');

        $this->assertIsArray($command);
        $this->assertCount(2,$command);
        $this->assertArrayHasKey('object',$command);
        $this->assertArrayHasKey('command',$command);
        $this->assertEquals('move', $command['command']);
        $this->assertEquals('up', $command['object']);
    }

    /** @test */
    public function parse_aliased_move_down_command()
    {
        $command = $this->parseCommand('go down');

        $this->assertIsArray($command);
        $this->assertCount(2,$command);
        $this->assertArrayHasKey('object',$command);
        $this->assertArrayHasKey('command',$command);
        $this->assertEquals('move', $command['command']);
        $this->assertEquals('down', $command['object']);
    }
}
