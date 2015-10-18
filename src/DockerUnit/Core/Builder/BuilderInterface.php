<?php


namespace DockerUnit\Core\Builder;

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
