<?php

declare(strict_types=1);

namespace App\Tests\Infrastructure\LoadBalancer;

use App\Infrastructure\Hosts\HostInterface;
use App\Infrastructure\LoadBalancer\LoadLimitVariant;
use PHPUnit\Framework\TestCase;

class LoadLimitVariantTest extends TestCase
{
    public function testGetHostWithLowestLoad()
    {
        $variant = new LoadLimitVariant(0.75);

        $host1 = $this->createMock(HostInterface::class);
        $host1->method('getLoad')->willReturn(0.79);
        $host1->method('getHost')->willReturn('host1');

        $host2 = $this->createMock(HostInterface::class);
        $host2->method('getLoad')->willReturn(0.74);
        $host2->method('getHost')->willReturn('host2');

        $host = $variant->choseHost([$host1, $host2]);

        $this->assertEquals('host2', $host->getHost());
    }

    public function testGetFirstHostBelowLimit()
    {
        $variant = new LoadLimitVariant(0.75);

        $host1 = $this->createMock(HostInterface::class);
        $host1->method('getLoad')->willReturn(0.50);
        $host1->method('getHost')->willReturn('host1');

        $host2 = $this->createMock(HostInterface::class);
        $host2->method('getLoad')->willReturn(0.50);
        $host2->method('getHost')->willReturn('host2');

        $host3 = $this->createMock(HostInterface::class);
        $host3->method('getLoad')->willReturn(0.50);
        $host3->method('getHost')->willReturn('host3');

        $host = $variant->choseHost([$host1, $host2, $host3]);

        $this->assertEquals('host1', $host->getHost());
    }

    public function testGetFirstHostBelowLimit2()
    {
        $variant = new LoadLimitVariant(0.75);

        $host1 = $this->createMock(HostInterface::class);
        $host1->method('getLoad')->willReturn(0.75);
        $host1->method('getHost')->willReturn('host1');

        $host2 = $this->createMock(HostInterface::class);
        $host2->method('getLoad')->willReturn(0.50);
        $host2->method('getHost')->willReturn('host2');

        $host3 = $this->createMock(HostInterface::class);
        $host3->method('getLoad')->willReturn(0.50);
        $host3->method('getHost')->willReturn('host3');

        $host = $variant->choseHost([$host1, $host2, $host3]);

        $this->assertEquals('host2', $host->getHost());
    }
}
