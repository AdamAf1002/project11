<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230428131310 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE etudsup (formation VARCHAR(10) NOT NULL, etudiant VARCHAR(20) NOT NULL, anneedeb INT DEFAULT NULL, PRIMARY KEY(formation, etudiant))');
        $this->addSql('CREATE INDEX IDX_5DDD686404021BF ON etudsup (formation)');
        $this->addSql('CREATE INDEX IDX_5DDD686717E22E3 ON etudsup (etudiant)');
        $this->addSql('ALTER TABLE etudsup ADD CONSTRAINT FK_5DDD686404021BF FOREIGN KEY (formation) REFERENCES formation_ant (codef) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE etudsup ADD CONSTRAINT FK_5DDD686717E22E3 FOREIGN KEY (etudiant) REFERENCES etudiant (numetd) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE etudsup DROP CONSTRAINT FK_5DDD686404021BF');
        $this->addSql('ALTER TABLE etudsup DROP CONSTRAINT FK_5DDD686717E22E3');
        $this->addSql('DROP TABLE etudsup');
    }
}
