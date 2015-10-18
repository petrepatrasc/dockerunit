<?php


namespace DockerUnit\Phar\Tests\Unit\Builder;


use DockerUnit\Phar\Builder\CliArgumentsBuilder;
use DockerUnit\Phar\Entity\CliArguments;

class CliArgumentsBuilderTest extends \PHPUnit_Framework_TestCase
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

//    public function testGivenAnInvalidDockerFileThenTheBuilderWillThrowAnException() {}
//    public function testGivenAValidDockerFileThenTheBuilderWillGenerateAMatchingArgumentsWrapper() {}
//    public function testGivenAllValidParametersThenTheBuilderWillGenerateAMatchingArgumentsWrapper() {}
}
