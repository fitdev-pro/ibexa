<?php

declare(strict_types=1);

namespace App\Infrastructure\Hosts;

use Symfony\Component\HttpFoundation\Request;

class Host
{
    private float $load;

    public function __construct(float $load)
    {
        $this->load = $load;
    }

    public function getLoad(): float
    {
        return $this->load;
    }

    public function handleRequest(Request $request):void
    {

    }
}
