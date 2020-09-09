# Enum
## Goals
To handle Enum arguments
```
function(MyEnumInterface $myEnum)
{
}
```

To always work with instances rather strings
```
$myEnum = MyEnum::MY_CONSTANT();

// won't work if you use private constants
$myEnum = MyEnum::MY_CONSTANT;
```

Comparison
```
$myEnum.isEqual(MyEnum::MY_CONSTANT());
```

To avoid the reimplementation of functions in every Enum implementation
```
...
class MyEnum extends Enum implements ClassMapEnumInterface, LabelMapEnumInterface
{
    use ClassMapEnumTrait;
    use LabelMapEnumTrait;
...
```

To make DEFAULT not special
```
// Start constant names with underscore when defining not unique values, like a default value.
private const _DEFAULT = self::APPLE;
```

To access the native value in case of transformation
```
$myEnum->getValue();
``` 
 
To create an instance from a native value in case of a reverse transformation
```
$myEnum = MyEnum::createByValue($myValue);
```

To use a cache per Enum abstraction to save memory and to speed up accessing constants and serving Enum instances. 

## Example implementation
Take a look at src/Mock/SimpleFruitEnum.php for a simple implementation.

Take a look at src/Mock/FruitEnum.php to see how to extend the functionality.

## Installing

Require with composer, ie.:

```
{
    "require": {
        "ggergo/enum": "*"
    }
}
```
