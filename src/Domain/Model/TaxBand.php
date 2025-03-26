<?php

namespace App\Domain\Model;

class TaxBand
{
    public function __construct(
        public readonly float $from,
        public readonly ?float $to,
        public readonly float $rate
    ) {}

    public function isInRange(float $salary): bool
    {
        return $salary > $this->from;
    }

    public function getApplicableAmount(float $salary): float
    {
        $upper = $this->to ?? $salary;
        return max(0, min($salary, $upper) - $this->from);
    }
}
