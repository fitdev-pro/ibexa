<?php

declare(strict_types=1);

namespace App\Infrastructure\LoadBalancer;

use App\Infrastructure\Hosts\HostInterface;

class SequenceVariant implements LoadVariantInterface
{
    private string|null $lastHost = null;
    private bool $returnHost = false;

    public function choseHost(array $hosts):HostInterface
    {
        if(is_null($this->lastHost)){
            $key = array_key_first($hosts);
            $host =  $hosts[$key];

            $this->lastHost = $host->getHost();

            return $host;
        }

        $lastKey = array_key_last($hosts);

        foreach ($hosts as $key => $host) {
            if($this->returnHost){
                if($key === $lastKey){
                    $this->lastHost = null;
                }else{
                    $this->lastHost = $host->getHost();
                }
                return $host;
            }

            if($host->getHost() === $this->lastHost) {
                $this->returnHost = true;
            }
        }
    }
}
