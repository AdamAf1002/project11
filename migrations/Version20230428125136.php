<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230428125136 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE choix (specialite VARCHAR(10) NOT NULL, etudiant VARCHAR(20) NOT NULL, enterminale BOOLEAN NOT NULL, PRIMARY KEY(specialite, etudiant))');
        $this->addSql('CREATE INDEX IDX_4F488091E7D6FCC1 ON choix (specialite)');
        $this->addSql('CREATE INDEX IDX_4F488091717E22E3 ON choix (etudiant)');
        $this->addSql('ALTER TABLE choix ADD CONSTRAINT FK_4F488091E7D6FCC1 FOREIGN KEY (specialite) REFERENCES specialite (codespe) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE choix ADD CONSTRAINT FK_4F488091717E22E3 FOREIGN KEY (etudiant) REFERENCES etudiant (numetd) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE choix DROP CONSTRAINT FK_4F488091E7D6FCC1');
        $this->addSql('ALTER TABLE choix DROP CONSTRAINT FK_4F488091717E22E3');
        $this->addSql('DROP TABLE choix');
    }
}
