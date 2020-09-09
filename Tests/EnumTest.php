<?php declare(strict_types=1);

namespace Ggergo\Enum\Tests;

use Ggergo\Enum\EnumInterface;
use Ggergo\Enum\Mock\FruitEnum;
use PHPUnit\Framework\TestCase;
use Ggergo\Enum\Enum;
use Ggergo\Enum\Mock\SimpleFruitEnum;

final class EnumTest extends TestCase
{
    // final private function __construct(string $s_value)
    public function testNewEnumByPublicConstructor()
    {
        $this->expectException(\Error::class);

        new SimpleFruitEnum();
    }

    // private const APPLE = 'apple';
    public function testAccessPrivateConst()
    {
        $this->expectException(\Error::class);

        SimpleFruitEnum::APPLE;
    }

    // public static function __callStatic(string $s_name, array $a_arguments): EnumInterface
    public function test__callStatic()
    {
        $o_apple = SimpleFruitEnum::APPLE();
        $this->assertInstanceOf(Enum::class, $o_apple);
        $this->assertTrue($o_apple instanceof EnumInterface);
        $this->assertInstanceOf(SimpleFruitEnum::class, $o_apple);
    }

    // public static function createByName(string $s_name): EnumInterface
    /**
     * @dataProvider provideDataForTestCreateByName
     */
    public function testCreateByName($m_expectedResult, bool $b_expectException, string $s_value)
    {
        if ($b_expectException) {
            $this->expectException(\Exception::class);
        }

        $o_apple = SimpleFruitEnum::APPLE();
        $this->assertSame($m_expectedResult, $o_apple->isEqual(SimpleFruitEnum::createByName($s_value)));
    }

    public function provideDataForTestCreateByName()
    {
        return [
                [true, false, 'APPLE'],
                [false, false, 'ORANGE'],
                [false, true, 'PEAR'],
                [true, false, '_DEFAULT'],
        ];
    }

    // public static function createByValue(string $s_value): EnumInterface
    /**
     * @dataProvider provideDataForTestCreateByValue
     */
    public function testCreateByValue($m_expectedResult, bool $b_expectException, string $s_value)
    {
        if ($b_expectException) {
            $this->expectException(\Exception::class);
        }

        $o_apple = SimpleFruitEnum::APPLE();
        $this->assertSame($m_expectedResult, $o_apple->isEqual(SimpleFruitEnum::createByValue($s_value)));
    }

    public function provideDataForTestCreateByValue()
    {
        return [
                [true, false, 'apple'],
                [false, false, 'orange'],
                [false, true, 'pear'],
        ];
    }

    // public static function isValidName(string $s_name): bool
    /**
     * @dataProvider provideDataForTestIsValidName
     */
    public function testIsValidName($m_expectedResult, string $s_name)
    {
        $this->assertSame($m_expectedResult, SimpleFruitEnum::isValidName($s_name));
    }

    public function provideDataForTestIsValidName()
    {
        return [
                [true, 'APPLE'],
                [true, 'ORANGE'],
                [false, 'PEAR'],
                [true, '_DEFAULT'],
        ];
    }

    // public static function isValidValue(string $s_value): bool
    /**
     * @dataProvider provideDataForTestIsValidValue
     */
    public function testIsValidValue($m_expectedResult, string $s_value)
    {
        $this->assertSame($m_expectedResult, SimpleFruitEnum::isValidValue($s_value));
    }

    public function provideDataForTestIsValidValue()
    {
        return [
                [true, 'apple'],
                [true, 'orange'],
                [false, 'pear'],
        ];
    }

    // public function getValue(): string
    /**
     * @dataProvider provideDataForTestGetValue
     */
    public function testGetValue($m_expectedResult, EnumInterface $o_enum)
    {
        $this->assertSame($m_expectedResult, $o_enum->getValue());
    }

    public function provideDataForTestGetValue()
    {
        return [
                ['apple', SimpleFruitEnum::APPLE()],
                ['orange', SimpleFruitEnum::ORANGE()],
                ['apple', SimpleFruitEnum::_DEFAULT()],
        ];
    }

    // public function isEqual($m_enum): bool
    /**
     * @dataProvider provideDataForTestIsEqual
     */
    public function testIsEqual($m_expectedResult, $m_compareTo)
    {
        $o_apple = SimpleFruitEnum::APPLE();
        $this->assertSame($m_expectedResult, $o_apple->isEqual($m_compareTo));
    }

    public function provideDataForTestIsEqual()
    {
        return [
                [true, SimpleFruitEnum::APPLE()],
                [false, SimpleFruitEnum::ORANGE()],
                [true, SimpleFruitEnum::_DEFAULT()],
                [false, null],
                [false, 'apple'],
                [false, 'APPLE'],
        ];
    }

    // getClass is not available
    public function testGetClass()
    {
        $this->expectException(\Error::class);

        $o_apple = SimpleFruitEnum::APPLE();
        $o_apple->getClass();
    }

    // getLabel is not available
    public function testGetLabel()
    {
        $this->expectException(\Error::class);

        $o_apple = SimpleFruitEnum::APPLE();
        $o_apple->getLabel();
    }
}