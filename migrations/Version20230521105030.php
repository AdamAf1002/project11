<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230521105030 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE etudiant DROP CONSTRAINT FK_717E22E3BE4E55D8');
        $this->addSql('ALTER TABLE etudiant ADD CONSTRAINT FK_717E22E3BE4E55D8 FOREIGN KEY (codegrp) REFERENCES groupe (codegrp) ON DELETE SET NULL NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE etudiant DROP CONSTRAINT fk_717e22e3be4e55d8');
        $this->addSql('ALTER TABLE etudiant ADD CONSTRAINT fk_717e22e3be4e55d8 FOREIGN KEY (codegrp) REFERENCES groupe (codegrp) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }
}
