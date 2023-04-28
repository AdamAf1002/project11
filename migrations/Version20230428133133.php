<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230428133133 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE note (anneeuniversitaire INT NOT NULL, etudiant VARCHAR(20) NOT NULL, element VARCHAR(20) NOT NULL, note DOUBLE PRECISION NOT NULL, PRIMARY KEY(anneeuniversitaire, etudiant, element))');
        $this->addSql('CREATE INDEX IDX_CFBDFA1469D43CC0 ON note (anneeuniversitaire)');
        $this->addSql('CREATE INDEX IDX_CFBDFA14717E22E3 ON note (etudiant)');
        $this->addSql('CREATE INDEX IDX_CFBDFA1441405E39 ON note (element)');
        $this->addSql('ALTER TABLE note ADD CONSTRAINT FK_CFBDFA1469D43CC0 FOREIGN KEY (anneeuniversitaire) REFERENCES annee_universitaire (annee) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE note ADD CONSTRAINT FK_CFBDFA14717E22E3 FOREIGN KEY (etudiant) REFERENCES etudiant (numetd) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE note ADD CONSTRAINT FK_CFBDFA1441405E39 FOREIGN KEY (element) REFERENCES element (codeelt) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE note DROP CONSTRAINT FK_CFBDFA1469D43CC0');
        $this->addSql('ALTER TABLE note DROP CONSTRAINT FK_CFBDFA14717E22E3');
        $this->addSql('ALTER TABLE note DROP CONSTRAINT FK_CFBDFA1441405E39');
        $this->addSql('DROP TABLE note');
    }
}
