<?php

namespace App\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TaxApiTest extends WebTestCase
{
    public function testPostTaxCalculation(): void
    {
        $client = static::createClient();

        $client->request(
            'POST',
            'api/tax',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode(['salary' => 40000])
        );

        $this->assertResponseIsSuccessful();

        $responseData = json_decode($client->getResponse()->getContent(), true);

        $this->assertArrayHasKey('gross_annual', $responseData);
        $this->assertArrayHasKey('net_annual', $responseData);
        $this->assertArrayHasKey('tax_annual', $responseData);
        $this->assertArrayHasKey('net_monthly', $responseData);
        $this->assertArrayHasKey('monthly_tax', $responseData);
    }

    public function testEnvVariableIsLoaded(): void
    {
        $this->assertNotEmpty(getenv('DATABASE_URL'), 'DATABASE_URL is not loaded');
        $this->assertTrue(extension_loaded('pdo_mysql'), 'pdo_mysql not loaded');
    }

    public function testEnvAccess(): void
    {
        $this->assertNotEmpty($_ENV['DATABASE_URL'], '$_ENV[DATABASE_URL] is not set');
    }

}
