<?php

namespace App\Services;

use Parsedown;

class MarkdownService
{
    public function __construct(private Parsedown $parsedown)
    {
        $this->parsedown = new Parsedown;
    }

    public function parse($content)
    {
        return $this->parsedown->text($content);
    }
}