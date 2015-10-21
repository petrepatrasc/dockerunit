<?php


namespace DockerUnit\Phar\Tests\Unit\Adapter;


use DockerUnit\Core\Tests\Unit\AbstractUnitTestCase;
use DockerUnit\Phar\Adapter\ArgvAdapter;
use DockerUnit\Phar\Builder\CliArgumentsBuilder;

class ArgvAdapterTest extends AbstractUnitTestCase
{
    const VALID_PHARFILE = './phar/dockerunit.phar';
    const VALID_COMMAND = 'lint';
    const VALID_DOCKERUNIT_FILE = 'dockerunit.yml';
    const VALID_DOCKERFILE = 'Dockerfile';

    /**
     * @var ArgvAdapter
     */
    protected $adapter;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    protected $builder;

    /**
     * @inheritDoc
     */
    protected function setUp()
    {
        parent::setUp();

        $this->builder = $this->getMockBuilder('DockerUnit\Phar\Builder\CliArgumentsBuilder')
            ->getMock();

        $this->adapter = new ArgvAdapter($this->builder);
    }

    public function testGivenThatTheAdapterIsProvidedWithAnEmptyArrayOfArgumentsThenAnExceptionWillBeThrown()
    {
        $arguments = [];

        $this->setExpectedException(
            'DockerUnit\Core\Exception\DockerUnitException',
            'Phar file was not provided in arguments'
        );

        $this->adapter->fromArgv($arguments);
    }

    public function testGivenThatTheAdapterIsProvidedWithMultiArgvValuesThenTheCliArgumentsBuilderWillBeCalledWithAllOfThem()
    {
        $multipleArguments = [
            self::VALID_PHARFILE,
            self::VALID_COMMAND,
            self::VALID_DOCKERUNIT_FILE,
            self::VALID_DOCKERFILE
        ];

        $this->builder->expects($this->once())->method('withPharFile')->with(self::VALID_PHARFILE)->willReturn($this->builder);
        $this->builder->expects($this->once())->method('withCommand')->with(self::VALID_COMMAND)->willReturn($this->builder);
        $this->builder->expects($this->once())->method('withConfigurationFile')->with(self::VALID_DOCKERUNIT_FILE)->willReturn($this->builder);
        $this->builder->expects($this->once())->method('withDockerfile')->with(self::VALID_DOCKERFILE)->willReturn($this->builder);
        $this->builder->expects($this->once())->method('build')->willReturn($this->builder);

        $this->adapter->fromArgv($multipleArguments);
    }
}
