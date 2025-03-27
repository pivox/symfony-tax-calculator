<?php

namespace App\Tests\Unit;

use App\Domain\Model\SalaryBreakdown;
use PHPUnit\Framework\TestCase;

class SalaryBreakdownTest extends TestCase
{
    public function testCalculationsAreCorrect(): void
    {
        $grossAnnual = 40000.0;
        $netAnnual = 29000.0;
        $taxAnnual = 11000.0;

        $breakdown = new SalaryBreakdown($grossAnnual, $netAnnual, $taxAnnual);

        $this->assertSame(40000.0, $breakdown->getGrossAnnual());
        $this->assertSame(29000.0, $breakdown->getNetAnnual());
        $this->assertSame(11000.0, $breakdown->getTaxAnnual());

        $this->assertSame(3333.33, round($breakdown->getGrossMonthly(), 2));
        $this->assertSame(2416.67, round($breakdown->getNetMonthly(), 2));
        $this->assertSame(916.67, round($breakdown->getMonthlyTax(), 2));
    }

    public function testTaxRatioIsCorrect(): void
    {
        $breakdown = new SalaryBreakdown(40000.0, 29000.0, 11000.0);
        $this->assertSame(0.275, round($breakdown->getTaxRatio(), 3));
    }

    public function testZeroGrossTaxRatioReturnsZero(): void
    {
        $breakdown = new SalaryBreakdown(0.0, 0.0, 1000.0);
        $this->assertSame(0.0, $breakdown->getTaxRatio());
    }
}
