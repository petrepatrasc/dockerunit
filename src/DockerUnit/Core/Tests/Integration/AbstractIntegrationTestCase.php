<?php


namespace DockerUnit\Core\Tests\Integration;


use PHPUnit_Framework_TestCase;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

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

        $this->container         = new ContainerBuilder();
        $packageWrapperDirectory = __DIR__ . '/../../..';

        $loader = new YamlFileLoader($this->container, new FileLocator($packageWrapperDirectory . '/Core/Resources/config'));
        $loader->load('services.yml');

        $loader = new YamlFileLoader($this->container, new FileLocator($packageWrapperDirectory . '/Phar/Resources/config'));
        $loader->load('services.yml');
    }
}
