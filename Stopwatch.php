<?php

require_once './StopWithoutStartException.php';
require_once './TimeSpentWithoutStartException.php';
require_once './FullTimeWithoutStart.php';
require_once './FullTimeWithoutStop.php';

class Stopwatch
{
    protected $storage;
    protected $startTime;
    protected $endTime;

    public function __construct($storage)
    {
        $this->storage = $storage;
        list($this->startTime, $this->endTime) = $this->storage->restore();
    }

    public function start()
    {
        $this->startTime = time();
        $this->save();
    }

    public function stop()
    {
        if (is_null($this->startTime)) {
            throw new StopWithoutStartException();
        }
        $this->endTime = time();
        $this->save();
    }

    public function reset()
    {
        $this->startTime = null;
        $this->endTime = null;
        $this->storage->clear();
    }


    public function timeSpent()
    {
        if (is_null($this->startTime)) {
            throw new TimeSpentWithoutStartException();
        }
        if ($this->endTime) {
            return $this->fullTime();
        }
        return time() - $this->startTime;
    }

    public function fullTime()
    {
        if (is_null($this->startTime)) {
            throw new FullTimeWithoutStart();
        }
        if (is_null($this->endTime)) {
            throw new FullTimeWithoutStop();
        }

        return $this->endTime - $this->startTime;
    }

    protected function save()
    {
        $this->storage->store([$this->startTime, $this->endTime]);
    }

}