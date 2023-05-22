<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230522120438 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE filiere_codefiliere_seq CASCADE');
        $this->addSql('ALTER TABLE bloc ALTER filiere TYPE VARCHAR(20)');
        $this->addSql('ALTER TABLE filiere ALTER codefiliere TYPE VARCHAR(20)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('CREATE SEQUENCE filiere_codefiliere_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('ALTER TABLE filiere ALTER codefiliere TYPE VARCHAR(2)');
        $this->addSql('ALTER TABLE bloc ALTER filiere TYPE VARCHAR(2)');
    }
}
