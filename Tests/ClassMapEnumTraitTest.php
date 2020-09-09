<?php declare(strict_types=1);

namespace Ggergo\Enum\Tests;

use Ggergo\Enum\Mock\ClassMap\ClassMapEnumInterface;
use Ggergo\Enum\EnumInterface;
use Ggergo\Enum\Mock\Apple;
use Ggergo\Enum\Mock\FruitEnum;
use Ggergo\Enum\Mock\Orange;
use PHPUnit\Framework\TestCase;
use Ggergo\Enum\Enum;

final class ClassMapEnumTraitTest extends TestCase
{
    public function testNewEnumByStaticMagicCall()
    {
        $o_apple = FruitEnum::APPLE();
        $this->assertInstanceOf(Enum::class, $o_apple);
        $this->assertTrue($o_apple instanceof EnumInterface);
        $this->assertInstanceOf(FruitEnum::class, $o_apple);
        $this->assertTrue($o_apple instanceof ClassMapEnumInterface);
    }

    /**
     * @dataProvider provideDataForTestGetClassMap
     */
    public function testGetClassMap($m_expectedResult, EnumInterface $o_enum)
    {
        $this->assertSame($m_expectedResult, $o_enum->getClass());
    }

    public function provideDataForTestGetClassMap()
    {
        return [
                [Apple::class, FruitEnum::APPLE()],
                [Orange::class, FruitEnum::ORANGE()],
        ];
    }
}