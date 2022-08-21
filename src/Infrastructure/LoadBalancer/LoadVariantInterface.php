<?php

declare(strict_types=1);

namespace App\Infrastructure\LoadBalancer;

use App\Infrastructure\Hosts\HostInterface;

interface LoadVariantInterface
{
    public function canHandleRequest(HostInterface $host):bool;
}
