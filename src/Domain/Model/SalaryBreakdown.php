<?php

    namespace App\Domain\Model;

    readonly class SalaryBreakdown
    {
        public function __construct(
            private float $grossAnnual,
            private float $netAnnual,
            private float $taxAnnual
        ) {}

        public function getGrossAnnual(): float
        {
            return round($this->grossAnnual, 3);
        }

        public function getNetAnnual(): float
        {
            return round($this->netAnnual, 3);
        }

        public function getTaxAnnual(): float
        {
            return round($this->taxAnnual, 3);
        }

        public function getGrossMonthly(): float
        {
            return round($this->grossAnnual / 12, 3);
        }

        public function getNetMonthly(): float
        {
            return round($this->netAnnual / 12, 3);
        }

        public function getMonthlyTax(): float
        {
            return round($this->taxAnnual / 12, 3);
        }

        public function getTaxRatio(): float
        {
            if ($this->grossAnnual === 0.0) {
                return 0.0;
            }

            return round($this->taxAnnual / $this->grossAnnual, 3);
        }
    }
