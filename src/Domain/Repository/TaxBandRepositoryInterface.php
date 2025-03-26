<?php

namespace App\Domain\Repository;

use App\Domain\Model\TaxBand;

interface TaxBandRepositoryInterface
{
    /**
     * @return TaxBand[]
     */
    public function findAll(): array;
}
