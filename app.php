<?php

require_once './CommandRunner.php';
require_once './StartCommand.php';
require_once './StopCommand.php';
require_once './ResetCommand.php';
require_once './StatsCommand.php';

$commandRunner = new CommandRunner([
    'start' => StartCommand::class,
    'stop' => StopCommand::class,
    'reset' => ResetCommand::class,
    'stats' => StatsCommand::class,
]);
