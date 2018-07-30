<?php

require_once './RedisStorage.php';
require_once './Stopwatch.php';

$stopWatch = new StopWatch(new RedisStorage());

$stopWatch->start();
usleep(5000000);
$stopWatch->stop();

echo $stopWatch->fullTime();
