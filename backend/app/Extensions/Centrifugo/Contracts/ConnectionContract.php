<?php 

namespace App\Extensions\Centrifugo\Contracts;

interface ConnectionContract
{
    public function host(): string;

    public function port(): string;
}