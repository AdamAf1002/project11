<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230428114845 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE epreuve ADD matiere VARCHAR(20) DEFAULT NULL');
        $this->addSql('ALTER TABLE epreuve ADD CONSTRAINT FK_D6ADE47F9014574A FOREIGN KEY (matiere) REFERENCES matiere (codemat) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_D6ADE47F9014574A ON epreuve (matiere)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE epreuve DROP CONSTRAINT FK_D6ADE47F9014574A');
        $this->addSql('DROP INDEX IDX_D6ADE47F9014574A');
        $this->addSql('ALTER TABLE epreuve DROP matiere');
    }
}
