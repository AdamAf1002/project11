<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230512233721 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE choix ALTER etudiant TYPE VARCHAR(8)');
        $this->addSql('ALTER TABLE etudiant ALTER numetd TYPE VARCHAR(8)');
        $this->addSql('ALTER TABLE etudiant ALTER nom TYPE VARCHAR(50)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_717E22E3E7927C74 ON etudiant (email)');
        $this->addSql('ALTER TABLE etudsup ALTER etudiant TYPE VARCHAR(8)');
        $this->addSql('ALTER TABLE note ALTER etudiant TYPE VARCHAR(8)');
        $this->addSql('ALTER TABLE resultatbac ALTER etudiant TYPE VARCHAR(8)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE note ALTER etudiant TYPE VARCHAR(20)');
        $this->addSql('ALTER TABLE etudsup ALTER etudiant TYPE VARCHAR(20)');
        $this->addSql('ALTER TABLE resultatbac ALTER etudiant TYPE VARCHAR(20)');
        $this->addSql('ALTER TABLE choix ALTER etudiant TYPE VARCHAR(20)');
        $this->addSql('DROP INDEX UNIQ_717E22E3E7927C74');
        $this->addSql('ALTER TABLE etudiant ALTER numetd TYPE VARCHAR(20)');
        $this->addSql('ALTER TABLE etudiant ALTER nom TYPE VARCHAR(30)');
    }
}
