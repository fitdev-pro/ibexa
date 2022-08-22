<?php

declare(strict_types=1);

namespace App\Infrastructure\LoadBalancer;

use App\Infrastructure\Hosts\HostInterface;
use Symfony\Component\HttpFoundation\Request;

class LoadBalancer
{
    /**
     * @var HostInterface[]
     */
    private array $hosts;
    private LoadVariantInterface $variant;

    /**
     * @param HostInterface[] $hosts
     * @param LoadVariantInterface $variant
     */
    public function __construct(array $hosts, LoadVariantInterface $variant)
    {
        $this->hosts = $hosts;
        $this->variant = $variant;
    }

    public function handleRequest(Request $request): void{
        $host = $this->variant->choseHost($this->hosts);
        $host->handleRequest($request);
    }
}
