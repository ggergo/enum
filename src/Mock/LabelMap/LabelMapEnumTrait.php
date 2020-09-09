<?php

namespace Ggergo\Enum\Mock\LabelMap;

/**
 * Trait LabelMapEnumTrait
 *
 * @package Ggergo\Enum\LabelMap
 */
trait LabelMapEnumTrait
{
    /**
     * @return string
     */
    final public function getLabel(): string
    {
        return static::$labelMap[$this->getValue()];
    }

    /**
     * @param string $s_label
     *
     * @return bool
     */
    final public static function isValidLabel(string $s_label): bool
    {
        return in_array($s_label, static::$labelMap, true);
    }
}