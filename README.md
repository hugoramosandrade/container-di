# Implementation of Container Interface PSR-11

### Examples

```php
$container = new DI;

//set a bind between a interface and a concrete class
$container->set(SomeInterface::class, ConcreteClass::class);

// retrieve a concrete class from interface
$instance = $container->get(SomeInterface::class);

$instance->doSomethingAwesome();
```
The get method, of DI container, will resolve automatically all dependencies of a class.