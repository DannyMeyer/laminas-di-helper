<?php

declare(strict_types=1);

namespace Test\DannyMeyer\Di;

use DannyMeyer\Di\Container;
use Laminas\ConfigAggregator\ConfigAggregator;
use Laminas\ServiceManager\Exception\ServiceNotFoundException;
use PHPUnit\Framework\TestCase;
use stdClass;
use Test\Stubs\StdConfigProvider;
use Test\Stubs\Test;
use Test\Stubs\TestConfigProvider;
use Test\Stubs\TestInterface;

use function get_class;

/**
 * Class ContainerTest
 *
 * @package Test\DannyMeyer\Di
 * @author Danny Meyer <danny.meyer@ravenc.de>
 */
class ContainerTest extends TestCase
{
    /**
     * @return void
     */
    public static function setUpBeforeClass(): void
    {
        Container::addConfiguration(
            new ConfigAggregator(
                [
                    TestConfigProvider::class
                ]
            )
        );
    }

    /**
     * @return void
     */
    public function testContainer(): void
    {
        $container = Container::getInstance();

        $test = $container->get(TestInterface::class);
        $this->assertSame(Test::class, get_class($test));
    }

    /**
     * @return void
     */
    public function testAddAdditionalConfiguration(): void
    {
        $container = Container::getInstance();

        Container::addConfiguration(
            new ConfigAggregator(
                [
                    StdConfigProvider::class
                ]
            )
        );

        $test = $container->get(TestInterface::class);
        $this->assertSame(Test::class, get_class($test));

        $stdClass = $container->get(stdClass::class);
        $this->assertSame(stdClass::class, get_class($stdClass));
    }

    /**
     * @return void
     */
    public function testUnknownAlias(): void
    {
        $container = Container::getInstance();
        $this->expectException(ServiceNotFoundException::class);

        $container->get('somethingUnknown');
    }
}
