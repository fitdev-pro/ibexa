<?php

declare(strict_types=1);

namespace App\Tests\Infrastructure\LoadBalancer;

use App\Infrastructure\Hosts\HostInterface;
use App\Infrastructure\LoadBalancer\SequenceVariant;
use PHPUnit\Framework\TestCase;

class SequenceVariantTest extends TestCase
{
    public function testGetFirstHost()
    {
        $variant = new SequenceVariant();

        $host1 = $this->createMock(HostInterface::class);
        $host1->method('getLoad')->willReturn(0.78);
        $host1->method('getHost')->willReturn('host1');

        $host2 = $this->createMock(HostInterface::class);
        $host2->method('getLoad')->willReturn(0.78);
        $host2->method('getHost')->willReturn('host2');

        $host = $variant->choseHost([$host1, $host2]);

        $this->assertEquals('host1', $host->getHost());
    }

    public function testGetSecondHost()
    {
        $variant = new SequenceVariant();

        $host1 = $this->createMock(HostInterface::class);
        $host1->method('getLoad')->willReturn(0.78);
        $host1->method('getHost')->willReturn('host1');

        $host2 = $this->createMock(HostInterface::class);
        $host2->method('getLoad')->willReturn(0.78);
        $host2->method('getHost')->willReturn('host2');

        $hostFirst = $variant->choseHost([$host1, $host2]);
        $hostSecond = $variant->choseHost([$host1, $host2]);

        $this->assertEquals('host1', $hostFirst->getHost());
        $this->assertEquals('host2', $hostSecond->getHost());
    }

    public function testGetFirstHostAgain()
    {
        $variant = new SequenceVariant();

        $host1 = $this->createMock(HostInterface::class);
        $host1->method('getLoad')->willReturn(0.78);
        $host1->method('getHost')->willReturn('host1');

        $host2 = $this->createMock(HostInterface::class);
        $host2->method('getLoad')->willReturn(0.78);
        $host2->method('getHost')->willReturn('host2');

        $hostFirst = $variant->choseHost([$host1, $host2]);
        $hostSecond = $variant->choseHost([$host1, $host2]);
        $hostLast = $variant->choseHost([$host1, $host2]);

        $this->assertEquals('host1', $hostFirst->getHost());
        $this->assertEquals('host2', $hostSecond->getHost());
        $this->assertEquals('host1', $hostLast->getHost());
    }
}
