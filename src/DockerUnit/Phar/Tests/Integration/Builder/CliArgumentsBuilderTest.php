<?php


namespace DockerUnit\Phar\Tests\Integration\Builder;


use DockerUnit\Phar\Builder\CliArgumentsBuilder;
use DockerUnit\Core\Tests\Integration\AbstractIntegrationTestCase;

class CliArgumentsBuilderTestAbstract extends AbstractIntegrationTestCase
{
    const VALID_PHAR_FILE = 'build/dockerunit.phar';
    const VALID_COMMAND = 'lint';
    const VALID_CONFIGURATION_FILE = 'config/dockerunit.yml';
    const VALID_DOCKERFILE_PATH = 'env/docker/Dockerfile';

    /**
     * @var CliArgumentsBuilder
     */
    protected $builder;

    /**
     * @inheritDoc
     */
    protected function setUp()
    {
        parent::setUp();

        $this->builder = $this->container->get('dockerunit.phar.cli_arguments.builder');
    }

    public function testGivenThatTheDependencyInjectionMechanismWorksCorrectlyThenTheBuilderCanBeInstantiated()
    {
        $this->assertNotNull($this->builder, 'Builder was not instantiated correctly by the DI mechanism');
        $this->assertTrue($this->builder instanceof CliArgumentsBuilder, 'DI mechanism did not instantiate the correct class type');
    }

    public function testGivenThatTheBuilderIsUsedToConstructMultipleObjectsThenTheDataWillBeResetBetweenSubsequentCalls()
    {
        $firstCliArguments = $this->builder
            ->withPharFile(self::VALID_PHAR_FILE)
            ->withCommand(self::VALID_COMMAND)
            ->withConfigurationFile(self::VALID_CONFIGURATION_FILE)
            ->withDockerfile(self::VALID_DOCKERFILE_PATH)
            ->build();

        $this->assertEquals(self::VALID_PHAR_FILE, $firstCliArguments->getPharFilePath());
        $this->assertEquals(self::VALID_COMMAND, $firstCliArguments->getCommand());
        $this->assertEquals(self::VALID_CONFIGURATION_FILE, $firstCliArguments->getConfigurationFile());
        $this->assertEquals(self::VALID_DOCKERFILE_PATH, $firstCliArguments->getDockerFilePath());

        $secondCliArguments = $this->builder->build();

        $this->assertNotEquals($firstCliArguments, $secondCliArguments, 'The cleanup of provisioning data inside the builder was not correct.');
    }
}
