<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230428130309 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE resultatbac (bac INT NOT NULL, etudiant VARCHAR(20) NOT NULL, anneebac INT NOT NULL, mention VARCHAR(20) DEFAULT NULL, moyennebac DOUBLE PRECISION NOT NULL, PRIMARY KEY(bac, etudiant))');
        $this->addSql('CREATE INDEX IDX_A83D80341C4FAC58 ON resultatbac (bac)');
        $this->addSql('CREATE INDEX IDX_A83D8034717E22E3 ON resultatbac (etudiant)');
        $this->addSql('ALTER TABLE resultatbac ADD CONSTRAINT FK_A83D80341C4FAC58 FOREIGN KEY (bac) REFERENCES bac (idbac) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE resultatbac ADD CONSTRAINT FK_A83D8034717E22E3 FOREIGN KEY (etudiant) REFERENCES etudiant (numetd) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE resultatbac DROP CONSTRAINT FK_A83D80341C4FAC58');
        $this->addSql('ALTER TABLE resultatbac DROP CONSTRAINT FK_A83D8034717E22E3');
        $this->addSql('DROP TABLE resultatbac');
    }
}
