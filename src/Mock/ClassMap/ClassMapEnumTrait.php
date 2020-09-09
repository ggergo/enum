<?php

namespace Ggergo\Enum\Mock\ClassMap;

/**
 * Trait ClassMapEnumTrait
 *
 * @package Ggergo\Enum\ClassMap
 */
trait ClassMapEnumTrait
{
    /**
     * @return string
     */
    final public function getClass(): string
    {
        return self::$classMap[$this->getValue()];
    }

    /**
     * @param string $s_class
     *
     * @return bool
     */
    final public static function isValidClass(string $s_class): bool
    {
        return in_array($s_class, self::$classMap, true);
    }
}