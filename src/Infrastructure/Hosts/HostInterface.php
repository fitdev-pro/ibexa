<?php

declare(strict_types=1);

namespace App\Infrastructure\Hosts;

use Symfony\Component\HttpFoundation\Request;

interface HostInterface
{
    public function getHost(): string;
    public function getLoad(): float;
    public function handleRequest(Request $request):void;
}
