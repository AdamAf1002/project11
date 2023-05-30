<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230530130700 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE etudiant ADD filiere VARCHAR(40) DEFAULT NULL');
        $this->addSql('ALTER TABLE etudiant ALTER tel DROP NOT NULL');
        $this->addSql('ALTER TABLE etudiant ALTER derdiplome DROP NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE etudiant DROP filiere');
        $this->addSql('ALTER TABLE etudiant ALTER tel SET NOT NULL');
        $this->addSql('ALTER TABLE etudiant ALTER derdiplome SET NOT NULL');
    }
}
