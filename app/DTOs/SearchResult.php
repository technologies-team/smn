<?php

namespace App\DTOs;

class SearchResult extends Result
{
    public function __construct( $data, string $message = '')
    {
        parent::__construct($data, $message, 0);
    }
}
