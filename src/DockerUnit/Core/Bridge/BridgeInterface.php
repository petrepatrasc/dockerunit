<?php


namespace DockerUnit\Core\Bridge;


use DockerUnit\Core\Entity\Container;

interface BridgeInterface
{
    /**
     * @return \DockerUnit\Core\Entity\Container
     */
    public function boot();
}
