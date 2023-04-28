<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230428114158 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE unite ADD bloc VARCHAR(10) DEFAULT NULL');
        $this->addSql('ALTER TABLE unite ADD CONSTRAINT FK_1D64C118C778955A FOREIGN KEY (bloc) REFERENCES bloc (codebloc) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_1D64C118C778955A ON unite (bloc)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE unite DROP CONSTRAINT FK_1D64C118C778955A');
        $this->addSql('DROP INDEX IDX_1D64C118C778955A');
        $this->addSql('ALTER TABLE unite DROP bloc');
    }
}
