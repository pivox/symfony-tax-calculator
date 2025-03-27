<?php

namespace App\Infrastructure\Controller;

use App\Application\Query\CalculateTax\CalculateTaxHandler;
use App\Application\Query\CalculateTax\CalculateTaxQuery;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class TaxController extends AbstractController
{
    #[Route('/api/tax/{salary}', name: 'calculate_tax_get', methods: ['GET'])]
    public function calculateFromGet(float $salary, CalculateTaxHandler $handler): JsonResponse
    {
        $query = new CalculateTaxQuery($salary);
        $result = $handler($query);

        return new JsonResponse([
            'gross_annual' => $result->getGrossAnnual(),
            'net_annual' => $result->getNetAnnual(),
            'tax_annual' => $result->getTaxAnnual(),
            'gross_monthly' => $result->getGrossMonthly(),
            'net_monthly' => $result->getNetMonthly(),
            'monthly_tax' => $result->getMonthlyTax(),
            'tax_ratio' => round($result->getTaxRatio() * 100, 2) . '%',
        ]);
    }
}
