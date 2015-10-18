<?php


namespace DockerUnit\Core\Tests\Unit\Runner;


use DockerUnit\Core\Runner\ShellCommandRunner;
use PHPUnit_Framework_TestCase;

class ShellCommandRunnerTest extends \PHPUnit_Framework_TestCase
{
    const MULTIPLE_NEWLINE_MISSING_EOL = "This is some test content \n with multiple newlines \n but no ending newline.";
    const MULTIPLE_NEWLINE_WITH_EOL = "This is some test content \n with multiple newlines \n but no ending newline.\n";

    /**
     * @var ShellCommandRunner
     */
    protected $runner;

    /**
     * @inheritDoc
     */
    protected function setUp()
    {
        parent::setUp();

        $this->runner = new \DockerUnit\Core\Runner\ShellCommandRunner();
    }

    public function testGivenAShellOutputWithAnEmptyNewLineAtTheEndThenItCanBeRemoved()
    {
        $testOutput = "Test output\n";

        $actualOutput = $this->runner->removeNewLineFromEndOfOutput($testOutput);

        $this->assertEquals('Test output', $actualOutput, 'The test output should no longer contain a trailing EOL');
    }

    public function testGivenAShellOutputWithoutANewLineAtTheEndThenItWillNotBeRemoved()
    {
        $testOutput = self::MULTIPLE_NEWLINE_MISSING_EOL;

        $actualOutput = $this->runner->removeNewLineFromEndOfOutput($testOutput);

        $this->assertEquals($testOutput, $actualOutput, 'The test output should match, since it does not contain a trailing newline.');
    }
}
