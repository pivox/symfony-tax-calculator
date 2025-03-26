<?php

namespace App\Application\Query\CalculateTax;

use App\Domain\Model\SalaryBreakdown;
use App\Domain\Model\TaxCalculationEngine;
use App\Domain\Repository\TaxBandRepositoryInterface;

class CalculateTaxHandler
{
    public function __construct(
        private TaxBandRepositoryInterface $repository,
        private TaxCalculationEngine $calculator
    ) {}

    public function __invoke(CalculateTaxQuery $query): SalaryBreakdown
    {
        $bands = $this->repository->findAll();
        return $this->calculator->compute($bands, $query->salary);
    }
}
