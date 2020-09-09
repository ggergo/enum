<?php

namespace Ggergo\Enum\Mock;

use Ggergo\Enum\Enum;
use Ggergo\Enum\Mock\ClassMap\ClassMapEnumInterface;
use Ggergo\Enum\Mock\ClassMap\ClassMapEnumTrait;
use Ggergo\Enum\Mock\LabelMap\LabelMapEnumInterface;
use Ggergo\Enum\Mock\LabelMap\LabelMapEnumTrait;

/**
 * Validate Enum implementation by Interfaces
 */
class FruitEnum extends Enum implements ClassMapEnumInterface, LabelMapEnumInterface
{
    /**
     * Use Traits to avoid the reimplementation of functions in every Enum implementation
     */
    use ClassMapEnumTrait;
    use LabelMapEnumTrait;

    /**
     * Use private constants!
     * Use unique strings as constant values!
     */
    private const APPLE = 'apple';
    private const ORANGE = 'orange';
    /**
     * Start constant names with underscore when defining repeated values.
     */
    private const _DEFAULT = self::APPLE;

    private static $classMap = [
            self::APPLE => Apple::class,
            self::ORANGE => Orange::class,
    ];

    private static $labelMap = [
            self::APPLE => 'My apple enum',
            self::ORANGE => 'My orange enum',
    ];
}