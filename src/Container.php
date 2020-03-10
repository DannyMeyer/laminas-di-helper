<?php

declare(strict_types=1);

namespace DannyMeyer\Di;

use Laminas\ConfigAggregator\ConfigAggregator;
use Laminas\ServiceManager\Config;
use Laminas\ServiceManager\ServiceLocatorInterface;
use Laminas\ServiceManager\ServiceManager;
use Laminas\Stdlib\ArrayUtils;

/**
 * Class Container
 *
 * @package DannyMeyer\Di
 * @author Danny Meyer <danny.meyer@ravenc.de>
 */
class Container extends ServiceManager
{
    public const CONFIG_DEPENDENCIES = 'dependencies';

    /**
     * Available config keys
     *
     * @see Config
     */
    public const CONFIG_ABSTRACT_FACTORIES = 'abstract_factories';
    public const CONFIG_ALIASES = 'aliases';
    public const CONFIG_DELEGATORS = 'delegators';
    public const CONFIG_FACTORIES = 'factories';
    public const CONFIG_INITIALIZERS = 'initializers';
    public const CONFIG_INVOKABLES = 'invokables';
    public const CONFIG_LAZY_SERVICES = 'lazy_services';
    public const CONFIG_SERVICES = 'services';
    public const CONFIG_SHARED = 'shared';

    /** @var ServiceManager|null */
    private static $instance;

    /** @var array */
    private static $configuration = [];

    /**
     * @return ServiceLocatorInterface
     */
    public static function getInstance(): ServiceLocatorInterface
    {
        if (static::$instance === null) {
            static::$instance = new static();
            self::configureServiceManager(static::$configuration);
        }

        return static::$instance;
    }

    /**
     * @param ConfigAggregator $configuration
     *
     * @return void
     */
    public static function addConfiguration(ConfigAggregator $configuration): void
    {
        $configData = $configuration->getMergedConfig();

        if (static::isInitialized()) {
            self::configureServiceManager($configData);
        }

        static::$configuration = ArrayUtils::merge(
            static::$configuration,
            $configData
        );
    }

    /**
     * @return bool
     */
    public static function isInitialized(): bool
    {
        return self::$instance instanceof ServiceLocatorInterface;
    }

    /**
     * @param array $configData
     *
     * @return void
     */
    private static function configureServiceManager(array $configData): void
    {
        $configuration = $configData[self::CONFIG_DEPENDENCIES] ?? [];
        $serviceConfig = new Config($configuration);
        $serviceConfig->configureServiceManager(static::$instance);
    }

    /**
     * @return void
     */
    private function __construct()
    {
        parent::__construct();
    }

    /**
     * @return void
     */
    private function __clone()
    {
    }

    /**
     * @noinspection PhpUnusedPrivateMethodInspection
     * @return void
     */
    private function __wakeup()
    {
    }
}
