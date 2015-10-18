<?php


namespace DockerUnit\Runner;

/**
 * Runs shell commands.
 *
 * @package DockerUnit\Runner
 * @author  Petre Pătrașc <petre@dreamlabs.ro>
 */
class ShellCommandRunner implements CommandRunnerInterface
{
    /**
     * @inheritDoc
     */
    public function run($command)
    {
        $output = shell_exec($command);

        $outputWithoutEndingNewLine = $this->removeNewLineFromEndOfOutput($output);

        return $outputWithoutEndingNewLine;
    }

    public function removeNewLineFromEndOfOutput($output)
    {
        $outputLength          = strlen($output);
        $lastCharacterIndex    = $outputLength - 1;
        $lastCharacterInOutput = $output[$lastCharacterIndex];

        if (PHP_EOL === $lastCharacterInOutput) {
            $output = substr($output, 0, $outputLength - 1);
        }

        return $output;
    }
}
