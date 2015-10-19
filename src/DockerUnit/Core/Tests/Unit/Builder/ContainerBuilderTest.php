<?php


namespace DockerUnit\Core\Tests\Unit\Builder;


use DockerUnit\Core\Builder\ContainerBuilder;
use DockerUnit\Core\Entity\Container;
use DockerUnit\Core\Tests\Unit\AbstractUnitTestCase;
use PHPUnit_Framework_TestCase;

class ContainerBuilderTest extends AbstractUnitTestCase
{
    const INVALID_ID = 123456789;
    const VALID_ID = '7cf8c69551aaf7b219976b4222205db76c52793c23073446feb28e7975b76e91';
    const INVALID_NAME = 987654321;
    const VALID_NAME = 'somevendor_somepackage';

    /**
     * @var \DockerUnit\Core\Builder\ContainerBuilder
     */
    protected $builder;

    /**
     * @inheritDoc
     */
    protected function setUp()
    {
        parent::setUp();

        $this->builder = new ContainerBuilder();
    }

    public function testGivenNoSpecificParametersThenTheBuilderWillGenerateAContainerWithSomeDefaultValues()
    {
        $container = $this->builder->build();

        $this->assertNotNull($container, 'The builder did not generate anything. Must be an issue in the way the generated instance is returned');
        $this->assertTrue($container instanceof Container, 'The builder generated data should be a Container');

        $this->assertEquals(ContainerBuilder::DEFAULT_ID, $container->getId(), 'The container should have a default ID');
        $this->assertEquals(ContainerBuilder::DEFAULT_NAME, $container->getName(), 'The container should have a default name');
    }

    public function testGivenAnInvalidIdThenTheBuilderWillThrowAnException()
    {
        $testedId = self::INVALID_ID;

        $this->setExpectedException(
            'DockerUnit\Core\Exception\DockerUnitException',
            "The invalid ID {$testedId} was passed to the container buidler."
        );

        $this->builder->withId($testedId)
            ->build();
    }

    public function testGivenAValidIdThenTheBuilderWillGenerateAMatchingContainer()
    {
        $testedId = self::VALID_ID;

        $container = $this->builder->withId($testedId)
            ->build();

        $this->assertEquals($testedId, $container->getId(), 'The builder did not generate a container with the specified ID');
    }
}
