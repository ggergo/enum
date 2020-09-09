<?php declare(strict_types=1);

namespace Ggergo\Enum\Tests;

use Ggergo\Enum\Mock\LabelMap\LabelMapEnumInterface;
use Ggergo\Enum\EnumInterface;
use Ggergo\Enum\Mock\FruitEnum;
use PHPUnit\Framework\TestCase;
use Ggergo\Enum\Enum;

final class LabelMapEnumTraitTest extends TestCase
{
    public function testNewEnumByStaticMagicCall()
    {
        $o_apple = FruitEnum::APPLE();
        $this->assertInstanceOf(Enum::class, $o_apple);
        $this->assertTrue($o_apple instanceof EnumInterface);
        $this->assertInstanceOf(FruitEnum::class, $o_apple);
        $this->assertTrue($o_apple instanceof LabelMapEnumInterface);
    }

    /**
     * @dataProvider provideDataForTestGetLabelMap
     */
    public function testGetLabelMap($m_expectedResult, EnumInterface $o_enum)
    {
        $this->assertSame($m_expectedResult, $o_enum->getLabel());
    }

    public function provideDataForTestGetLabelMap()
    {
        return [
                ['My apple enum', FruitEnum::APPLE()],
                ['My orange enum', FruitEnum::ORANGE()],
        ];
    }
}