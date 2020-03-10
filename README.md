# laminas-di-helper
Laminas based helper for dependency injection

**Setup:**
```php
\DannyMeyer\Di\Container::addConfiguration(
    new \Laminas\ConfigAggregator\ConfigAggregator(
        [
            MyConfigProvider::class
        ]
    )
);
```

**Example for ConfigProvider:**
```php
class MyConfigProvider {

    /**
     * @return array
     */
    public function __invoke(): array
    {
        return [
             \DannyMeyer\Di\Container::CONFIG_DEPENDENCIES => [
                 \DannyMeyer\Di\Container::CONFIG_FACTORIES => [
                     MyClass::class => \Laminas\ServiceManager\Factory\InvokableFactory::class,
                 ],
             ]
         ];
    }
}
```

**Usage:**
```php
$container = \DannyMeyer\Di\Container::getInstance();
$container->get(MyClass::class);
```