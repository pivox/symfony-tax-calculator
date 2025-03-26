<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250326234418 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE tax_band_entity (id INT AUTO_INCREMENT NOT NULL, from_value DOUBLE PRECISION DEFAULT NULL, to_value DOUBLE PRECISION DEFAULT NULL, rate DOUBLE PRECISION DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);

        $taxBands = [
            ['from' => 0,'to' => 5000, 'rate' => 0],
            ['from' => 5000,'to' => 20000, 'rate' => 20],
            ['from' => 20000,'to' => null, 'rate' => 40],
        ];
        foreach ($taxBands as $band) {
            $from = $band['from'];
            $to = $band['to'] ?? 'NULL';
            $rate = $band['rate'];

            $this->addSql(sprintf(
                "INSERT INTO tax_band_entity (from_value, to_value, rate) VALUES (%f, %s, %f)",
                $from,
                is_null($to) ? 'NULL' : $to,
                $rate
            ));
        }
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            DROP TABLE tax_band_entity
        SQL);
    }
}
