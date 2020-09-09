<?php

namespace Ggergo\Enum;

/**
 * Class Enum
 *
 * @package Ggergo\Enum
 */
abstract class Enum implements EnumInterface
{
    /**
     * @var string
     */
    private $s_value;
    /**
     * @var array
     */
    private static $a_reflectionCache = [];
    /**
     * @var array
     */
    private static $a_instanceCache = [];

    /**
     * @param string $s_value
     *
     * @throws \Exception
     */
    final private function __construct(string $s_value)
    {
        if (!self::isValidValue($s_value)) {
            throw new \Exception('Invalid Enum constant value.');
        }

        $this->s_value = $s_value;
    }

    /**
     * @param string $s_name
     * @param array  $a_arguments
     *
     * @return EnumInterface
     * @throws \Exception
     */
    final public static function __callStatic(string $s_name, array $a_arguments): EnumInterface
    {
        return self::createByName($s_name);
    }

    final private static function isUniqueConstantName(string $s_name)
    {
        return '_' !== $s_name[0];
    }

    final private static function isInstanceInCache(string $s_className, string $s_constantName)
    {
        return isset(self::$a_instanceCache[$s_className.'::'.$s_constantName]);
    }

    final private static function getInstance(string $s_className, string $s_constantName)
    {
        if (!self::isInstanceInCache($s_className, $s_constantName)) {
            self::$a_instanceCache[$s_className.'::'.$s_constantName] = new static(static::getConstantNativeValue($s_constantName));
        }

        return self::$a_instanceCache[$s_className.'::'.$s_constantName];
    }

    /**
     * @param string $s_name
     *
     * @return EnumInterface
     * @throws \Exception
     */
    final public static function createByName(string $s_name): EnumInterface
    {
        if (!self::isValidName($s_name)) {
            throw new \Exception('Invalid Enum constant name.');
        }

        if (!self::isUniqueConstantName($s_name)) {
            $s_name = self::getConstantNameByValue(static::getConstantNativeValue($s_name));
        }

        $s_class = get_called_class();
        return self::getInstance($s_class, $s_name);
    }

    /**
     * @param string $s_value
     *
     * @return EnumInterface
     * @throws \Exception
     */
    final public static function createByValue(string $s_value): EnumInterface
    {
        $s_name = static::getConstantNameByValue($s_value);

        return self::createByName($s_name);
    }

    /**
     * @param string $s_search_value
     *
     * @return string
     * @throws \Exception
     */
    final private static function getConstantNameByValue(string $s_search_value, bool $b_skipNotUnique = true): string
    {
        $o_ref = self::getReflection();
        $a_constants = $o_ref->getConstants();

        foreach ($a_constants as $s_name => $s_value) {
            if ((!$b_skipNotUnique || static::isUniqueConstantName($s_name)) && $s_value === $s_search_value) {

                return $s_name;
            }
        }

        throw new \Exception('Invalid Enum constant value.');
    }

    /**
     * @return \ReflectionClass
     * @throws \ReflectionException
     */
    final private static function getReflection(): \ReflectionClass
    {
        $s_class = get_called_class();

        if (!array_key_exists($s_class, self::$a_reflectionCache)) {
            $o_reflect = new \ReflectionClass($s_class);
            self::$a_reflectionCache[$s_class] = $o_reflect;
        }

        return self::$a_reflectionCache[$s_class];
    }

    /**
     * To access a constant inside static Enum context
     */
    final private static function getConstantNativeValue(string $s_name): string
    {
        if (!self::isValidName($s_name)) {
            throw new \Exception('Invalid Enum constant name.');
        }

        // Constanst are private so it is important to access them through a Reflection class
        $o_ref = self::getReflection();

        return $o_ref->getConstant($s_name);
    }

    /**
     * @param string $s_name
     *
     * @return bool
     * @throws \ReflectionException
     */
    final public static function isValidName(string $s_name): bool
    {
        $o_ref = self::getReflection();

        return array_key_exists($s_name, $o_ref->getConstants());
    }

    /**
     * @param string $s_value
     *
     * @return bool
     * @throws \ReflectionException
     */
    final public static function isValidValue(string $s_value): bool
    {
        $o_ref = self::getReflection();
        $a_values = array_values($o_ref->getConstants());

        return in_array($s_value, $a_values, true);
    }

    /**
     * @return string
     */
    final public function getValue(): string
    {
        return $this->s_value;
    }

    /**
     * @param $m_enum
     *
     * @return bool
     */
    final public function isEqual($m_enum): bool
    {
        return $m_enum instanceof EnumInterface && get_class($m_enum) === get_class($this) && $m_enum->getValue() === $this->getValue();
    }
}