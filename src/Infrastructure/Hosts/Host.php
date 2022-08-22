<?php

declare(strict_types=1);

namespace App\Infrastructure\Hosts;

use Symfony\Component\HttpFoundation\Request;

class Host
{
    private float $load;
    private array $requests = [];
    private string $host;

    public function __construct(string $host)
    {
        $this->load = 0;
        $this->host = $host;
    }

    public function getHost():string{
        return $this->host;
    }

    public function getLoad(): float
    {
        return $this->load;
    }

    public function handleRequest(Request $request):void
    {
        $this->endOldRequests();

        $this->startNewRequest();
    }

    private function endOldRequests():void{
        foreach ($this->requests as $key => $request){
            if($request < time()){
                unset($this->requests[$key]);
                $this->load -= 0.25;
            }
        }
    }

    private function startNewRequest():void{
        $this->requests[] = time()+2;
        $this->load += 0.25;
    }
}
