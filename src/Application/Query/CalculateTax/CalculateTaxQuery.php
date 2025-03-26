<?php

namespace App\Application\Query\CalculateTax;

class CalculateTaxQuery
{
    public function __construct(public readonly float $salary) {}
}
