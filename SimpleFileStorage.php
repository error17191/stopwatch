<?php

require_once './Storage.php';

class SimpleFileStorage extends Storage
{
    protected $filePath;

    public function __construct($filePath)
    {
        $this->filePath = $filePath;
    }

    public function restore()
    {
        if (file_exists($this->filePath)) {
            $content = trim(file_get_contents($this->filePath));
            $pieces = explode("\n", $content);
        }
        return [
            !empty($content) && isset($pieces[0]) ? $pieces[0] : null,
            isset($pieces[1]) ? $pieces[1] : null
        ];
    }

    public function store($times)
    {
        file_put_contents($this->filePath,
            implode("\n", $times));
    }

    public function clear()
    {
        file_put_contents($this->filePath, null);
    }
}
