<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230428121617 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE unite ADD element VARCHAR(20) DEFAULT NULL');
        $this->addSql('ALTER TABLE unite ADD CONSTRAINT FK_1D64C11841405E39 FOREIGN KEY (element) REFERENCES element (codeelt) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1D64C11841405E39 ON unite (element)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE unite DROP CONSTRAINT FK_1D64C11841405E39');
        $this->addSql('DROP INDEX UNIQ_1D64C11841405E39');
        $this->addSql('ALTER TABLE unite DROP element');
    }
}
