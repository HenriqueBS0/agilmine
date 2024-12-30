<?php

namespace App\Services;

use Parsedown;

class MarkdownService
{
    protected $parsedown;

    public function __construct()
    {
        $this->parsedown = new Parsedown;
    }

    public function parse($content)
    {
        return $this->parsedown->text($content);
    }
}