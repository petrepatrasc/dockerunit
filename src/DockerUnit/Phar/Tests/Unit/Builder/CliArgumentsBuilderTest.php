<?php


namespace DockerUnit\Phar\Tests\Unit\Builder;


use DockerUnit\Core\Tests\Unit\AbstractUnitTestCase;
use DockerUnit\Phar\Builder\CliArgumentsBuilder;
use DockerUnit\Phar\Entity\CliArguments;

/**
 * Unit tests for the CLI arguments builder.
 *
 * @package DockerUnit\Phar\Tests\Unit\Builder
 * @author  Petre Pătrașc <petre@dreamlabs.ro>
 */
class CliArgumentsBuilderTest extends AbstractUnitTestCase
{
    const VALID_PHAR_FILE = 'build/dockerunit.phar';
    const VALID_COMMAND = 'lint';
    const VALID_CONFIGURATION_FILE = 'config/dockerunit.yml';
    const VALID_DOCKERFILE_PATH = 'env/docker/Dockerfile';

    const INVALID_PHAR_FILE = 123;
    const INVALID_COMMAND = null;
    const INVALID_CONFIGURATION_FILE = 456;
    const INVALID_DOCKERFILE_PATH = false;

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

        $this->builder = new CliArgumentsBuilder();
    }

    public function testGivenNoSpecificOptionsThenTheBuilderWillGenerateCliArgumentsWithDefaultValues()
    {
        $argumentWrapper = $this->builder->build();

        $this->assertNotNull($argumentWrapper, 'The build method did not return anything');
        $this->assertTrue($argumentWrapper instanceof CliArguments, 'The build method should have returned a new instance of CLI arguments');

        $this->assertEquals(CliArgumentsBuilder::DEFAULT_PHAR_FILE, $argumentWrapper->getPharFilePath());
        $this->assertEquals(CliArgumentsBuilder::DEFAULT_COMMAND, $argumentWrapper->getCommand());
        $this->assertEquals(CliArgumentsBuilder::DEFAULT_CONFIGURATION_FILE, $argumentWrapper->getConfigurationFile());
        $this->assertEquals(CliArgumentsBuilder::DEFAULT_DOCKERFILE_PATH, $argumentWrapper->getDockerFilePath());
    }

    public function testGivenAnInvalidPharFileThenTheBuilderWillThrowAnException()
    {
        $pharFile = self::INVALID_PHAR_FILE;

        $this->setExpectedException(
            'DockerUnit\Core\Exception\DockerUnitException',
            "The invalid phar file {$pharFile} was passed to the CLI arguments buidler."
        );

        $this->builder->withPharFile($pharFile)
            ->build();
    }

    public function testGivenAValidPharFileThenTheBuilderWillGenerateAMatchingArgumentsWrapper()
    {
        $testPharFile = self::VALID_PHAR_FILE;

        $argumentWrapper = $this->builder->withPharFile($testPharFile)
            ->build();

        $this->assertEquals($testPharFile, $argumentWrapper->getPharFilePath());
    }

    public function testGivenAnInvalidCommandThenTheBuilderWillThrowAnException()
    {
        $command = self::INVALID_COMMAND;

        $this->setExpectedException(
            'DockerUnit\Core\Exception\DockerUnitException',
            "The invalid command {$command} was passed to the CLI arguments buidler."
        );

        $this->builder->withCommand($command)
            ->build();
    }

    public function testGivenAValidCommandThenTheBuilderWillGenerateAMatchingArgumentsWrapper()
    {
        $testCommand = self::VALID_COMMAND;

        $argumentWrapper = $this->builder->withCommand($testCommand)
            ->build();

        $this->assertEquals($testCommand, $argumentWrapper->getCommand());
    }

    public function testGivenAnInvalidConfigurationFileThenTheBuilderWillThrowAnException()
    {
        $configuration = self::INVALID_CONFIGURATION_FILE;

        $this->setExpectedException(
            'DockerUnit\Core\Exception\DockerUnitException',
            "The invalid configuration file {$configuration} was passed to the CLI arguments buidler."
        );

        $this->builder->withConfigurationFile($configuration)
            ->build();
    }

    public function testGivenAValidConfigurationFileThenTheBuilderWillGenerateAMatchingArgumentsWrapper()
    {
        $testConfiguration = self::VALID_CONFIGURATION_FILE;

        $argumentWrapper = $this->builder->withConfigurationFile($testConfiguration)
            ->build();

        $this->assertEquals($testConfiguration, $argumentWrapper->getConfigurationFile());
    }

    public function testGivenAnInvalidDockerFileThenTheBuilderWillThrowAnException()
    {
        $dockerfile = self::INVALID_DOCKERFILE_PATH;

        $this->setExpectedException(
            'DockerUnit\Core\Exception\DockerUnitException',
            "The invalid Dockerfile {$dockerfile} was passed to the CLI arguments buidler."
        );

        $this->builder->withDockerfile($dockerfile)
            ->build();
    }

    public function testGivenAValidDockerFileThenTheBuilderWillGenerateAMatchingArgumentsWrapper()
    {
        $dockerfile = self::VALID_DOCKERFILE_PATH;

        $argumentsWrapper = $this->builder->withDockerfile($dockerfile)
            ->build();

        $this->assertEquals($dockerfile, $argumentsWrapper->getDockerFilePath());
    }

    public function testGivenAllValidParametersThenTheBuilderWillGenerateAMatchingArgumentsWrapper()
    {
        $argumentsWrapper = $this->builder
            ->withPharFile(self::VALID_PHAR_FILE)
            ->withCommand(self::VALID_COMMAND)
            ->withConfigurationFile(self::VALID_CONFIGURATION_FILE)
            ->withDockerfile(self::VALID_DOCKERFILE_PATH)
            ->build();

        $this->assertEquals(self::VALID_PHAR_FILE, $argumentsWrapper->getPharFilePath());
        $this->assertEquals(self::VALID_COMMAND, $argumentsWrapper->getCommand());
        $this->assertEquals(self::VALID_CONFIGURATION_FILE, $argumentsWrapper->getConfigurationFile());
        $this->assertEquals(self::VALID_DOCKERFILE_PATH, $argumentsWrapper->getDockerFilePath());
    }
}
