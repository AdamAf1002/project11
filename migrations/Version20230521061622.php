<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230521061622 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bac ALTER libele DROP NOT NULL');
        $this->addSql('ALTER TABLE note ALTER note DROP NOT NULL');
        $this->addSql('ALTER TABLE resultatbac ALTER moyennebac DROP NOT NULL');
        $this->addSql('ALTER TABLE resultatbac ALTER depbac DROP NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE bac ALTER libele SET NOT NULL');
        $this->addSql('ALTER TABLE resultatbac ALTER moyennebac SET NOT NULL');
        $this->addSql('ALTER TABLE resultatbac ALTER depbac SET NOT NULL');
        $this->addSql('ALTER TABLE note ALTER note SET NOT NULL');
    }
}
