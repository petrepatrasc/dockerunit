<?php


namespace DockerUnit\Phar\Builder;


use DockerUnit\Core\Builder\BuilderInterface;
use DockerUnit\Core\Exception\DockerUnitException;
use DockerUnit\Phar\Entity\CliArguments;

/**
 * Handles the composition of CLI argument wrappers.
 *
 * @package DockerUnit\Phar\Builder
 * @author  Petre Pătrașc <petre@dreamlabs.ro>
 */
class CliArgumentsBuilder implements BuilderInterface
{
    const DEFAULT_PHAR_FILE = '';
    const DEFAULT_COMMAND = '';
    const DEFAULT_CONFIGURATION_FILE = '';
    const DEFAULT_DOCKERFILE_PATH = '';

    /**
     * @var string
     */
    protected $pharFilePath;

    /**
     * @var string
     */
    protected $command;

    /**
     * @var string
     */
    protected $configurationFile;

    /**
     * @var string
     */
    protected $dockerFilePath;

    /**
     * CliArgumentsBuilder constructor.
     */
    public function __construct()
    {
        $this->setDefaultOptions();
    }

    /**
     * Reset the fields in the CLI arguments with some sensible defaults.
     */
    protected function setDefaultOptions()
    {
        $this->pharFilePath      = self::DEFAULT_PHAR_FILE;
        $this->command           = self::DEFAULT_COMMAND;
        $this->configurationFile = self::DEFAULT_CONFIGURATION_FILE;
        $this->dockerFilePath    = self::DEFAULT_DOCKERFILE_PATH;
    }

    /**
     * Build a new CLI arguments instance.
     *
     * @return CliArguments
     */
    public function build()
    {
        $arguments = new CliArguments(
            $this->pharFilePath,
            $this->command,
            $this->configurationFile,
            $this->dockerFilePath
        );

        $this->setDefaultOptions();

        return $arguments;
    }

    /**
     * @param string $pharFile
     *
     * @return $this
     * @throws DockerUnitException
     */
    public function withPharFile($pharFile)
    {
        if (false === is_string($pharFile)) {
            throw new DockerUnitException("The invalid phar file {$pharFile} was passed to the CLI arguments buidler.");
        }

        $this->pharFilePath = $pharFile;

        return $this;
    }

    public function withCommand($command)
    {
        if (false === is_string($command)) {
            throw new DockerUnitException("The invalid command {$command} was passed to the CLI arguments buidler.");
        }

        $this->command = $command;

        return $this;
    }
}
