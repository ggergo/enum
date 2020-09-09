<?php

namespace Ggergo\Enum\Mock;

use Ggergo\Enum\Enum;

class SimpleFruitEnum extends Enum
{
    /**
     * Use private constants!
     * Use unique strings as constant values!
     */
    private const APPLE = 'apple';
    private const ORANGE = 'orange';
    /**
     * Start constant names with underscore when defining not unique values, like a default value.
     *
     * Take into account that constant _DEFAULT is not special.
     * Persisting a _DEFAULT instance and loading it back after a possible constant value code change will not keep track with it.
     */
    private const _DEFAULT = self::APPLE;
}