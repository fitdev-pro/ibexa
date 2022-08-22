<?php

declare(strict_types=1);

namespace App\Tests\Infrastructure\LoadBalancer;

use App\Infrastructure\Hosts\HostInterface;
use App\Infrastructure\LoadBalancer\LoadBalancer;
use App\Infrastructure\LoadBalancer\LoadLimitVariant;
use App\Infrastructure\LoadBalancer\SequenceVariant;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;

class LoadBalancerTest extends TestCase
{
    public function testHandleRequestWithLimit()
    {
        $host1 = $this->createMock(HostInterface::class);
        $host1->method('getLoad')->willReturn(0.78);
        $host1->expects($this->never())->method('handleRequest');

        $host2 = $this->createMock(HostInterface::class);
        $host2->method('getLoad')->willReturn(0.0);
        $host2->expects($this->once())->method('handleRequest');

        $host3 = $this->createMock(HostInterface::class);
        $host3->method('getLoad')->willReturn(0.0);
        $host3->expects($this->never())->method('handleRequest');

        $hosts = [$host1,$host2,$host3];

        $balancer = new LoadBalancer($hosts, new LoadLimitVariant(0.75));

        $balancer->handleRequest(new Request());
    }

    public function testHandleRequestSequence()
    {
        $host1 = $this->createMock(HostInterface::class);
        $host1->method('getLoad')->willReturn(0.78);
        $host1->expects($this->never())->method('handleRequest');

        $host2 = $this->createMock(HostInterface::class);
        $host2->method('getLoad')->willReturn(0.0);
        $host2->expects($this->once())->method('handleRequest');

        $host3 = $this->createMock(HostInterface::class);
        $host3->method('getLoad')->willReturn(0.0);
        $host3->expects($this->never())->method('handleRequest');

        $hosts = [$host1,$host2,$host3];

        $balancer = new LoadBalancer($hosts, new SequenceVariant());

        $balancer->handleRequest(new Request());
    }
}
