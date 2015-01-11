# README

[![Build Status](https://travis-ci.org/yasiekz/router-bundle.svg)](https://travis-ci.org/yasiekz/router-bundle)
[![Latest Stable Version](https://poser.pugx.org/yasiekz/router-bundle/v/stable.svg)](https://packagist.org/packages/yasiekz/router-bundle)
[![Total Downloads](https://poser.pugx.org/yasiekz/router-bundle/downloads.svg)](https://packagist.org/packages/yasiekz/router-bundle)
[![Latest Unstable Version](https://poser.pugx.org/yasiekz/router-bundle/v/unstable.svg)](https://packagist.org/packages/yasiekz/router-bundle) [![License](https://poser.pugx.org/yasiekz/router-bundle/license.svg)](https://packagist.org/packages/yasiekz/router-bundle)

Bundle umozliwiajacy renderowanie adresów URL do konkretnych obiektów zamiast podawania nazwy pliku i parametrów

## Instalacja

Po zaciągnieciu repo przez composera nalezy dodac je w AppKernel.php

```
$bundles = array(
                new Zstudio\RouterBundle\ZstudioRouterBundle(),
            )
```

Bundel z automatu nadpisuje domyślny routing symfony 2.

## Dodatkowa konfiguracja

Nie jest wymagana żadna dodatkowa konfiguracja

## Jakiego interfejsu powinienem użyć ?

Mamy do dyspozycji dwa interfejsy. RoutableCmsInterface jest uzyteczny dla wszelkiego rodzaju systemów CMS, gdzie do każdego obiektu można dodać kilka routingów np do edycji, czy usuwania.
RoutableFrontInterface jest użyteczny dla serwisów www, gdzie do każdego obiektu potrzebny jest tylko jeden routing, ale zależy on od różnych czynników np. artykuł może mieć różny routing w zależności od kategorii do której należy.

## Przykłady zastosowania:

### RoutableCmsInterface

Zastosowanie

```
use Zstudio\RouterBundle\Service\RoutableCmsInterface

class YourClass implements RoutableCmsIterface
{
    public function getPossibleRoutes()
    {
        // metoda powinna zwrocic tablice dostepnych routingow w postaci
        return array(
            'destination1' => 'routingName1',
            'destination2' => 'routingName2'
        );
    }

    public function getRouterParameters($routeName, $destination = null);
    {
        // metoda powinna zwrocic parametry niezbedne do stworzenia routingu w zaleznosci od podanego parametry $destination np:

        return array(
            'id' => $this->getId()
        );
    }
}
```

Generowanie urla odbywa się w taki sam sposób jak domyślnie w symfony2.

Z poziomu kontrolera:

```
$object = new YourClass();
$url = $this->generateUrl($object, 'edit');
```

Powyzszy przyklad wygeneruje pośredni adres dla obiektu dla celu "edit".

Z poziomu twiga:

```
{{ path(object, 'edit') }}
```

### RoutableFrontInterface

Zastosowanie

```
use Zstudio\RouterBundle\Service\RoutableFrontInterface

class YourClass implements RoutableFrontIterface
{
    public function getRouteName()
    {
        // metoda powinna nazwe routingu dla podanego obiektu
        return 'yourclass_detail';
    }

    public function getRouterParameters($routeName, $destination = null);
    {
        // metoda powinna zwrocic parametry niezbedne do stworzenia routingu w zaleznosci od podanego parametry $destination np:

        return array(
            'id' => $this->getId()
        );
    }
}
```

Generowanie urla odbywa się w taki sam sposób jak domyślnie w symfony2.

Z poziomu kontrolera:

```
$object = new YourClass();
$paramers = array(); // tutaj moga byc dodatkowe parametry ktore zostana zmergowane do routingu
$url = $this->generateUrl($object, $parameters);
```

Powyzszy przyklad wygeneruje pośredni adres dla obiektu bez przekazywania dodatkowych parametrow.
Zostana wziete tylko te z metody getRouterParameters() z klasy YourClass.

Z poziomu twiga:

```
{{ path(object, { 'param1': value1, 'param2': value2 }) }}
```

## Ważne

Nie ma możliwości, aby obiekt implementował oba interfejsy jednocześnie. Zostanie wybrany routing dla RoutableCmsInterface.

## Contrubution

Czuj się swobodnie przy przesyłaniu wszelkiego rodzaju pull requestów. Wymagania są identyczne jak dla symfony: http://symfony.com/doc/current/contributing/code/patches.html
