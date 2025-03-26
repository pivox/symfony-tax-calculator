<?php

namespace App\Domain\Model;

class SalaryBreakdown
{
    public function __construct(
        private float $grossAnnual,
        private float $netAnnual,
        private float $taxAnnual
    ) {}

    public function getGrossAnnual(): float
    {
        return $this->grossAnnual;
    }

    public function getNetAnnual(): float
    {
        return $this->netAnnual;
    }

    public function getTaxAnnual(): float
    {
        return $this->taxAnnual;
    }

    public function getGrossMonthly(): float
    {
        return $this->grossAnnual / 12;
    }

    public function getNetMonthly(): float
    {
        return $this->netAnnual / 12;
    }

    public function getMonthlyTax(): float
    {
        return $this->taxAnnual / 12;
    }

    public function getTaxRatio(): float
    {
        if ($this->grossAnnual === 0.0) {
            return 0.0;
        }

        return $this->taxAnnual / $this->grossAnnual;
    }

    public function isTaxFree(): bool
    {
        return $this->taxAnnual === 0.0;
    }

    public function isHighTaxed(float $threshold = 0.3): bool
    {
        return $this->getTaxRatio() >= $threshold;
    }
}
