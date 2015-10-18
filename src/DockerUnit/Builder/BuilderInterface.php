<?php


namespace DockerUnit\Builder;

/**
 * Defines interaction with builder services.
 *
 * @package DockerUnit\Builder
 * @author  Petre Pătrașc <petre@dreamlabs.ro>
 */
interface BuilderInterface
{
    public function build();
}
