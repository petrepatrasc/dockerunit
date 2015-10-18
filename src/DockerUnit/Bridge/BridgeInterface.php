<?php


namespace DockerUnit\Bridge;


use DockerUnit\Entity\Container;

interface BridgeInterface
{
    /**
     * @return Container
     */
    public function boot();
}
