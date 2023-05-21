<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230521141058 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE bloc_codebloc_seq CASCADE');
        $this->addSql('DROP SEQUENCE epreuve_codeepreuve_seq CASCADE');
        $this->addSql('DROP SEQUENCE matiere_codemat_seq CASCADE');
        $this->addSql('DROP SEQUENCE unite_codeunite_seq CASCADE');
        $this->addSql('ALTER TABLE unite ALTER coeficient DROP NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('CREATE SEQUENCE bloc_codebloc_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE epreuve_codeepreuve_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE matiere_codemat_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE unite_codeunite_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('ALTER TABLE unite ALTER coeficient SET NOT NULL');
    }
}
