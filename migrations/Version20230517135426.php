<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230517135426 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bac DROP etabbac');
        $this->addSql('ALTER TABLE bac RENAME COLUMN depbac TO libele');
        $this->addSql('ALTER TABLE resultatbac ADD etabbac VARCHAR(20) DEFAULT NULL');
        $this->addSql('ALTER TABLE resultatbac ADD depbac VARCHAR(20) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE bac ADD etabbac VARCHAR(20) DEFAULT NULL');
        $this->addSql('ALTER TABLE bac RENAME COLUMN libele TO depbac');
        $this->addSql('ALTER TABLE resultatbac DROP etabbac');
        $this->addSql('ALTER TABLE resultatbac DROP depbac');
    }
}
