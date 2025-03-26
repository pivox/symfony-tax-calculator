<?php

namespace App\Domain\Model;

class TaxCalculationEngine
{
    /**
     * @param TaxBand[] $bands
     */
    public function compute(array $bands, float $salary): SalaryBreakdown
    {
        $tax = 0.0;

        foreach ($bands as $band) {
            if (!$band instanceof TaxBand) {
                continue;
            }

            if ($band->isInRange($salary)) {
                $amount = $band->getApplicableAmount($salary);
                $tax += $amount * ($band->rate / 100);
            }
        }

        $net = $salary - $tax;

        return new SalaryBreakdown($salary, $net, $tax);
    }
}
