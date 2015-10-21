<?php


namespace DockerUnit\Phar\Adapter;


use DockerUnit\Core\Builder\BuilderInterface;
use DockerUnit\Core\Exception\DockerUnitException;
use DockerUnit\Phar\Builder\CliArgumentsBuilder;

class ArgvAdapter
{
    const DEFAULT_PHARFILE = './phar/dockerunit.phar';
    const DEFAULT_COMMAND = 'undefined';
    const DEFAULT_DOCKERUNIT_FILE = 'dockerunit.yml';
    const DEFAULT_DOCKERFILE = 'Dockerfile';

    /**
     * @var CliArgumentsBuilder
     */
    protected $cliArgumentsBuilder;

    /**
     * ArgvAdapter constructor.
     *
     * @param CliArgumentsBuilder $cliArgumentsBuilder
     */
    public function __construct(CliArgumentsBuilder $cliArgumentsBuilder)
    {
        $this->cliArgumentsBuilder = $cliArgumentsBuilder;
    }

    public function fromArgv(array $arguments)
    {
        if (0 === count($arguments)) {
            throw new DockerUnitException('Phar file was not provided in arguments');
        }

        $arguments = $this->normalizeArgvArguments($arguments);

        $this->cliArgumentsBuilder
            ->withPharFile($arguments[0])
            ->withCommand($arguments[1])
            ->withConfigurationFile($arguments[2])
            ->withDockerfile($arguments[3])
            ->build();

        $this->cliArgumentsBuilder;
    }

    public function normalizeArgvArguments(array $arguments)
    {
        $defaultOptions = $this->getDefaultArguments();

        return $arguments + $defaultOptions;
    }

    protected function getDefaultArguments()
    {
        $defaultPharfile       = self::DEFAULT_PHARFILE;
        $defaultCommand        = self::DEFAULT_COMMAND;
        $defaultDockerunitFile = self::DEFAULT_DOCKERUNIT_FILE;
        $defaultDockerfile     = self::DEFAULT_DOCKERFILE;

        return [
            $defaultPharfile,
            $defaultCommand,
            $defaultDockerunitFile,
            $defaultDockerfile,
        ];
    }
}
