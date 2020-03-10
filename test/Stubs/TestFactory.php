<?php

declare(strict_types=1);

namespace Test\Stubs;

use Psr\Container\ContainerInterface;

/**
 * Class TestFactory
 *
 * @package Test\Stubs
 * @author Danny Meyer <danny.meyer@ravenc.de>
 */
class TestFactory
{
    /**
     * @param ContainerInterface $container
     *
     * @return Test
     */
    public function __invoke(ContainerInterface $container): Test
    {
        return new Test();
    }
}
