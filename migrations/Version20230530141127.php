<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230530141127 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE user_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE "users_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE "users" (id INT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, nom VARCHAR(60) NOT NULL, prenom VARCHAR(60) NOT NULL, pseudo VARCHAR(10) DEFAULT NULL, datecreat DATE NOT NULL, sexe VARCHAR(1) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1483A5E9E7927C74 ON "users" (email)');
        $this->addSql('DROP TABLE "user"');
        $this->addSql('ALTER TABLE etudiant ADD filiere VARCHAR(40) DEFAULT NULL');
        $this->addSql('ALTER TABLE etudiant ALTER tel DROP NOT NULL');
        $this->addSql('ALTER TABLE etudiant ALTER derdiplome DROP NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE "users_id_seq" CASCADE');
        $this->addSql('CREATE SEQUENCE user_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE "user" (id INT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, nom VARCHAR(60) NOT NULL, prenom VARCHAR(60) NOT NULL, pseudo VARCHAR(10) DEFAULT NULL, datecreat DATE NOT NULL, sexe VARCHAR(1) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX uniq_8d93d649e7927c74 ON "user" (email)');
        $this->addSql('DROP TABLE "users"');
        $this->addSql('ALTER TABLE etudiant DROP filiere');
        $this->addSql('ALTER TABLE etudiant ALTER tel SET NOT NULL');
        $this->addSql('ALTER TABLE etudiant ALTER derdiplome SET NOT NULL');
    }
}
