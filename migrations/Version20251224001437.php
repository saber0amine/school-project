<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251224001437 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE medecin (id INT AUTO_INCREMENT NOT NULL, license_number VARCHAR(10) NOT NULL, first_name VARCHAR(50) NOT NULL, last_name VARCHAR(50) NOT NULL, specialization VARCHAR(100) NOT NULL, phone VARCHAR(15) DEFAULT NULL, email VARCHAR(100) DEFAULT NULL, date_of_birth DATE DEFAULT NULL, license_issue_date DATE NOT NULL, license_expiry_date DATE DEFAULT NULL, address VARCHAR(100) NOT NULL, city VARCHAR(50) NOT NULL, postal_code VARCHAR(10) NOT NULL, country VARCHAR(50) NOT NULL, is_active TINYINT(1) DEFAULT 1 NOT NULL, biography LONGTEXT DEFAULT NULL, consultation_fee NUMERIC(5, 2) DEFAULT NULL, nationality VARCHAR(50) DEFAULT NULL, gender VARCHAR(20) DEFAULT NULL, UNIQUE INDEX UNIQ_1BDA53C6EC7E7152 (license_number), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE medecin');
    }
}
