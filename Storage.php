<?php

require_once './Stopwatch.php';

abstract class Storage
{
	
	abstract public function restore();
	
	abstract public function clear();
	
	abstract public function store($times);
	
}