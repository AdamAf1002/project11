<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230502172449 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bloc ALTER codebloc TYPE VARCHAR(20)');
        $this->addSql('ALTER TABLE bloc ALTER filiere TYPE VARCHAR(2)');
        $this->addSql('ALTER TABLE epreuve ALTER typeepreuve TYPE VARCHAR(20)');
        $this->addSql('ALTER TABLE etudiant ALTER codegrp TYPE VARCHAR(50)');
        $this->addSql('ALTER TABLE etudsup ALTER formation TYPE VARCHAR(20)');
        $this->addSql('ALTER TABLE filiere ALTER codefiliere TYPE VARCHAR(2)');
        $this->addSql('ALTER TABLE filiere ALTER nomfiliere TYPE VARCHAR(30)');
        $this->addSql('ALTER TABLE filiere ALTER respfiliere TYPE VARCHAR(50)');
        $this->addSql('ALTER TABLE formation_ant ALTER codef TYPE VARCHAR(20)');
        $this->addSql('ALTER TABLE formation_ant ALTER etablissement TYPE VARCHAR(80)');
        $this->addSql('ALTER TABLE groupe ALTER codegrp TYPE VARCHAR(50)');
        $this->addSql('ALTER TABLE groupe ALTER nomgrp TYPE VARCHAR(50)');
        $this->addSql('ALTER TABLE matiere ALTER periode TYPE VARCHAR(3)');
        $this->addSql('ALTER TABLE specialite ALTER nomspe TYPE VARCHAR(50)');
        $this->addSql('ALTER TABLE unite ALTER bloc TYPE VARCHAR(20)');
        $this->addSql('ALTER TABLE unite ALTER nomunite TYPE VARCHAR(60)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE epreuve ALTER typeepreuve TYPE VARCHAR(10)');
        $this->addSql('ALTER TABLE matiere ALTER periode TYPE VARCHAR(2)');
        $this->addSql('ALTER TABLE unite ALTER bloc TYPE VARCHAR(10)');
        $this->addSql('ALTER TABLE unite ALTER nomunite TYPE VARCHAR(30)');
        $this->addSql('ALTER TABLE etudsup ALTER formation TYPE VARCHAR(10)');
        $this->addSql('ALTER TABLE formation_ant ALTER codef TYPE VARCHAR(10)');
        $this->addSql('ALTER TABLE formation_ant ALTER etablissement TYPE VARCHAR(30)');
        $this->addSql('ALTER TABLE bloc ALTER codebloc TYPE VARCHAR(10)');
        $this->addSql('ALTER TABLE bloc ALTER filiere TYPE VARCHAR(10)');
        $this->addSql('ALTER TABLE specialite ALTER nomspe TYPE VARCHAR(20)');
        $this->addSql('ALTER TABLE groupe ALTER codegrp TYPE VARCHAR(20)');
        $this->addSql('ALTER TABLE groupe ALTER nomgrp TYPE VARCHAR(20)');
        $this->addSql('ALTER TABLE filiere ALTER codefiliere TYPE VARCHAR(10)');
        $this->addSql('ALTER TABLE filiere ALTER nomfiliere TYPE VARCHAR(20)');
        $this->addSql('ALTER TABLE filiere ALTER respfiliere TYPE VARCHAR(30)');
        $this->addSql('ALTER TABLE etudiant ALTER codegrp TYPE VARCHAR(20)');
    }
}
