<?php


namespace DockerUnit\Core\Bridge;


use DockerUnit\Core\Entity\DockerContainer;

interface BridgeInterface
{
    /**
     * @return \DockerUnit\Core\Entity\DockerContainer
     */
    public function boot();
}
