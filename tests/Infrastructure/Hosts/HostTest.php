<?php

declare(strict_types=1);

namespace App\Tests\Infrastructure\Hosts;

use App\Infrastructure\Hosts\Host;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;

class HostTest extends TestCase
{
    public function testHandleRequest()
    {
        $request = $this->createMock(Request::class);

        $host = new Host('host1');

        $host->handleRequest($request);

        $this->assertEquals(0.15, $host->getLoad());
    }

    public function testEndRequest()
    {
        $request = $this->createMock(Request::class);

        $host = new Host('host1');

        $host->handleRequest($request);
        $host->handleRequest($request);

        sleep(3);

        $host->handleRequest($request);

        $this->assertEquals(0.25, $host->getLoad());
    }
}
