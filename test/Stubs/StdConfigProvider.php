<?php

namespace Test\Stubs;

use DannyMeyer\Di\Container;
use Laminas\ServiceManager\Factory\InvokableFactory;
use stdClass;

/**
 * Class stdConfigProvider
 *
 * @package Test\Stubs
 * @author Danny Meyer <danny.meyer@ravenc.de>
 */
class StdConfigProvider
{
    /**
     * @return array
     */
    public function __invoke(): array
    {
        /**
         * Also available keys:
         *
         * @see Container::CONFIG_ABSTRACT_FACTORIES
         * @see Container::CONFIG_ALIASES
         * @see Container::CONFIG_DELEGATORS
         * @see Container::CONFIG_FACTORIES
         * @see Container::CONFIG_INITIALIZERS
         * @see Container::CONFIG_INVOKABLES
         * @see Container::CONFIG_LAZY_SERVICES
         * @see Container::CONFIG_SERVICES
         * @see Container::CONFIG_SHARED
         */
        return [
            Container::CONFIG_DEPENDENCIES => [
                Container::CONFIG_FACTORIES => [
                    stdClass::class => InvokableFactory::class,
                ],
                Container::CONFIG_SHARED => [
                    stdClass::class => false,
                ],
            ]
        ];
    }
}
