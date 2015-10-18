<?php


namespace DockerUnit\Phar\Entity;


class CliArguments
{
    /**
     * @var string
     */
    private $pharFilePath;

    /**
     * @var string
     */
    private $command;

    /**
     * @var string
     */
    private $configurationFile;

    /**
     * @var string
     */
    private $dockerFilePath;

    /**
     * CliArguments constructor.
     *
     * @param string $pharFilePath
     * @param string $command
     * @param string $configurationFile
     * @param string $dockerFilePath
     */
    public function __construct($pharFilePath, $command, $configurationFile, $dockerFilePath)
    {
        $this->pharFilePath      = $pharFilePath;
        $this->command           = $command;
        $this->configurationFile = $configurationFile;
        $this->dockerFilePath    = $dockerFilePath;
    }

    /**
     * @return string
     */
    public function getPharFilePath()
    {
        return $this->pharFilePath;
    }

    /**
     * @return string
     */
    public function getCommand()
    {
        return $this->command;
    }

    /**
     * @return string
     */
    public function getConfigurationFile()
    {
        return $this->configurationFile;
    }

    /**
     * @return string
     */
    public function getDockerFilePath()
    {
        return $this->dockerFilePath;
    }
}
