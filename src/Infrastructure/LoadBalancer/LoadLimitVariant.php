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

    public function choseHost(array $hosts):HostInterface
    {
        $lowestHost = null;
        $lowestHostLoad = 1;
        foreach ($hosts as $host) {
            if($host->getLoad() < $lowestHostLoad){
                $lowestHost = $host;
            }
            if($this->limit > $host->getLoad()) {
                return $host;
            }
        }

        return $lowestHost;
    }
}
