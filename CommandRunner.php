<?php

class CommandRunner
{
    protected $commands = [];
    protected $command;

    public function __construct($commands)
    {
        $this->registerCommands($commands);

        if (empty($argv[1])) {
            $this->output('You haven\'t enter a command');
            $this->showAvailableCommands();
            return;
        }
        if ($this->commandExists($argv[1])) {
            $this->output('Command doesn\'t exist');
            $this->showAvailableCommands();
            return;
        }
        $this->runCommand($argv[1]);
    }

    public function registerCommands($commands)
    {
        foreach ($commands as $name => $command) {
            $this->commands[$name] = new $command;
        }
    }

    public function output($string)
    {
        echo "{$string}\n";
    }

    public function showAvailableCommands()
    {
        foreach ($this->commands as $command) {
            $command->displyDescription();
        }
    }

    public function commandExists($command)
    {
        return isset($this->commands[$command]);
    }

    public function runCommand($command)
    {
        $this->commands[$command]->run();
    }
}