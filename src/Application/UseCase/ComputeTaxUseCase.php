<?php

namespace App\Application\UseCase;

use App\Domain\Repository\TaxBandRepositoryInterface;
use App\Domain\Model\TaxCalculationEngine;
use App\Domain\Model\SalaryBreakdown;

class ComputeTaxUseCase
{
    public function __construct(
        private TaxBandRepositoryInterface $repository,
        private TaxCalculationEngine $calculator
    ) {}

    public function handle(float $salary): SalaryBreakdown
    {
        $bands = $this->repository->findAll();

        return $this->calculator->compute($bands, $salary);
    }
}
