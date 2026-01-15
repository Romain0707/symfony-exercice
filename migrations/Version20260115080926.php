<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260115080926 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE pate (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE pizza ADD pate_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE pizza ADD CONSTRAINT FK_CFDD826F2B068EB6 FOREIGN KEY (pate_id) REFERENCES pate (id)');
        $this->addSql('CREATE INDEX IDX_CFDD826F2B068EB6 ON pizza (pate_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE pate');
        $this->addSql('ALTER TABLE pizza DROP FOREIGN KEY FK_CFDD826F2B068EB6');
        $this->addSql('DROP INDEX IDX_CFDD826F2B068EB6 ON pizza');
        $this->addSql('ALTER TABLE pizza DROP pate_id');
    }
}
