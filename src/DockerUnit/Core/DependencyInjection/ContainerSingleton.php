<?php


namespace DockerUnit\Core\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

/**
 * Provides an interface for uniquely creating containers for the DockerUnit package.
 *
 * @package DockerUnit\Core\DependencyInjection
 * @author  Petre Pătrașc <petre@dreamlabs.ro>
 */
class ContainerSingleton
{
    /**
     * @var ContainerInterface
     */
    private static $container;

    public static function getInstance()
    {
        if (null !== static::$container) {
            return static::$container;
        }

        $container               = new ContainerBuilder();
        $packageWrapperDirectory = __DIR__ . '/../..';

        $loader = new YamlFileLoader($container, new FileLocator($packageWrapperDirectory . '/Core/Resources/config'));
        $loader->load('services.yml');

        $loader = new YamlFileLoader($container, new FileLocator($packageWrapperDirectory . '/Phar/Resources/config'));
        $loader->load('services.yml');

        $container->compile();

        static::$container = $container;

        return static::$container;
    }

    /**
     * Protected constructor to prevent creating a new instance of the
     * container via the `new` operator from outside of this class.
     */
    protected function __construct()
    {
    }

    /**
     * Private clone method to prevent cloning of the instance of the
     * container instance.
     *
     * @return void
     */
    private function __clone()
    {
    }

    /**
     * Private unserialize method to prevent unserializing of the container
     * instance.
     *
     * @return void
     */
    private function __wakeup()
    {
    }

}
