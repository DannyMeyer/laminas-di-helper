<?php

declare(strict_types=1);

namespace Test\Stubs;

use DannyMeyer\Di\Container;

/**
 * Class TestConfigProvider
 *
 * @package Test\Stubs
 * @author Danny Meyer <danny.meyer@ravenc.de>
 */
class TestConfigProvider
{
    /**
     * @return array
     */
    public function __invoke(): array
    {
        return [
            Container::CONFIG_DEPENDENCIES => [
                Container::CONFIG_FACTORIES => [
                    Test::class => TestFactory::class,
                ],
                Container::CONFIG_ALIASES => [
                    TestInterface::class => Test::class,
                ],
            ]
        ];
    }
}
