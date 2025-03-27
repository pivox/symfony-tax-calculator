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

        $this->assertEquals(40000, $responseData['gross_annual']);
        $this->assertEquals(29000, $responseData['net_annual']);
        $this->assertEquals(11000, $responseData['tax_annual']);

        $this->assertEquals(3333.333, $responseData['gross_monthly']);
        $this->assertEquals(2416.667, $responseData['net_monthly']);
        $this->assertEquals(916.667, $responseData['monthly_tax']);

        $this->assertEquals('27.5%', $responseData['tax_ratio']);
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
