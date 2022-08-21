<?php

declare(strict_types=1);

namespace App\Infrastructure\LoadBalancer;

use App\Infrastructure\Hosts\HostInterface;

class LoadLimitVariant implements LoadVariantInterface
{
    private float $limit;

    public function __construct(float $limit)
    {
        $this->limit = $limit;
    }

    public function canHandleRequest(HostInterface $host):bool
    {
        return $this->limit > $host->getLoad();
    }
}
