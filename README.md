# README

Bundle that provides aviability of generating URL address to objects instead of giving route name and route parameters

## Instalation

Add bundle in poiurewqw AppKernel.php

```
$bundles = array(
                new Yasiekz\RouterBundle\YasiekzRouterBundle(),
            )
```

Bundle automatically overrides default symfony2 routing service.

## Additional Configuration

There is no additional configuration required.

## What interface should I use?

We have two interfaces aviable. The RoutableCmsInterface is useful when you want to have more than one routing per object for example in CMS systems,
where you might want to have diffrent routing for edit, delete object. The Routable FrontInterface is useful for websites when there is only
only one routing per object, but one object might have many routes depends on for example category that object belongs.

## Usage:

### RoutableCmsInterface

```
use Yasiekz\RouterBundle\Service\RoutableCmsInterface

class YourClass implements RoutableCmsIterface
{
    public function getPossibleRoutes()
    {
        // method should return an array of aviable routes as below
        return array(
            'destination1' => 'routingName1',
            'destination2' => 'routingName2'
        );
    }

    public function getRouterParameters($routeName, $destination = null);
    {
        // method should return parameters that is necessary to create routing depend on $destination parameter:
        return array(
            'id' => $this->getId()
        );
    }
}
```

The URL is generated as same as default in symfony2.

From controller:

```
$object = new YourClass();
$url = $this->generateUrl($object, 'edit');
```

The example above generates indirect address to object $object for destination 'edit'

From twig:

```
{{ path(object, 'edit') }}
```

### RoutableFrontInterface

Usage

```
use Yasiekz\RouterBundle\Service\RoutableFrontInterface

class YourClass implements RoutableFrontIterface
{
    public function getRouteName()
    {
        // method should return routeName for given object
        return 'yourclass_detail';
    }

    public function getRouterParameters($routeName, $destination = null);
    {
        // method should return parameters that is necessary to create routing depend on $routeName parameter:

        return array(
            'id' => $this->getId()
        );
    }
}
```

The URL is generated as same as default in symfony2.

From controller:

```
$object = new YourClass();
$paramers = array(); // here might be additional params which be marged to routing
$url = $this->generateUrl($object, $parameters);
```

The example above generates indirect address to object $object without transmission any additional params.
Will be taken only params from getRouterParameters() method from class YourClass.

From Twig:

```
{{ path(object, { 'param1': value1, 'param2': value2 }) }}
```

## Important

There is no possibility that the one class implements both of RoutableFrontInterface and RoutableCmsIterface.

## Contrubution

You are highly encouraged to participate in the development. The terms are the same as the symfony2
http://symfony.com/doc/current/contributing/code/patches.html




