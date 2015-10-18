<?php


namespace DockerUnit\Runner;

/**
 * Manages the interactions available for command runners.
 *
 * @package DockerUnit\Runner
 * @author  Petre Pătrașc <petre@dreamlabs.ro>
 */
interface CommandRunnerInterface
{
    /**
     * Run a command via the runner and return the output.
     *
     * @param string $command The command to be executed.
     *
     * @return string The output of the command.
     */
    public function run($command);
}
