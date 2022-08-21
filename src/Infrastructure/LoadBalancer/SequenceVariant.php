<?php

declare(strict_types=1);

namespace App\Infrastructure\LoadBalancer;

use App\Infrastructure\Hosts\HostInterface;

class SequenceVariant implements LoadVariantInterface
{
    public function canHandleRequest(HostInterface $host):bool
    {
        return $host->getLoad() == 0;
    }
}
