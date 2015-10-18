<?php


namespace DockerUnit\Core\Builder;

use DockerUnit\Core\Builder\BuilderInterface;
use DockerUnit\Core\Entity\Container;
use DockerUnit\Core\Exception\DockerUnitException;

/**
 * Handles the composition of container entities.
 *
 * @package DockerUnit\Builder
 * @author  Petre Pătrașc <petre@dreamlabs.ro>
 */
class ContainerBuilder implements BuilderInterface
{
    const DEFAULT_ID = 'container_default_id';
    const DEFAULT_NAME = 'container_default_name';

    /**
     * @var string
     */
    protected $id;

    /**
     * @var string
     */
    protected $name;

    /**
     * ContainerBuilder constructor.
     */
    public function __construct()
    {
        $this->setDefaultOptions();
    }

    /**
     * Set the fields and properties to their default values.
     */
    protected function setDefaultOptions()
    {
        $this->id   = self::DEFAULT_ID;
        $this->name = self::DEFAULT_NAME;
    }

    /**
     * @return Container
     */
    public function build()
    {
        $container = new Container(
            $this->id,
            $this->name
        );

        $this->setDefaultOptions();

        return $container;
    }

    /**
     * @param string $id
     *
     * @return $this
     * @throws DockerUnitException
     */
    public function withId($id)
    {
        if (false === is_string($id)) {
            throw new DockerUnitException("The invalid ID {$id} was passed to the container buidler.");
        }

        $this->id = $id;

        return $this;
    }
}
