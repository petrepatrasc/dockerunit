<?php


namespace DockerUnit\Core\Tests\Integration;


use DockerUnit\Core\DependencyInjection\ContainerSingleton;
use PHPUnit_Framework_TestCase;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Governs the testing of flows, and features usage of the DI mechanism.
 *
 * @package DockerUnit\Core\Tests\Integration
 * @author  Petre Pătrașc <petre@dreamlabs.ro>
 */
abstract class AbstractIntegrationTestCase extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * @inheritDoc
     */
    protected function setUp()
    {
        parent::setUp();

        $this->container = ContainerSingleton::getInstance();
    }
}
