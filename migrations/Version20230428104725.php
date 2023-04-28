<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230428104725 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE bac_idbac_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE bloc_codebloc_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE epreuve_codeepreuve_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE filiere_codefiliere_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE formation_ant_codef_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE matiere_codemat_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE specialite_codespe_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE unite_codeunite_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE annee_universitaire (annee INT NOT NULL, PRIMARY KEY(annee))');
        $this->addSql('CREATE TABLE bac (idbac INT NOT NULL, typebac VARCHAR(20) NOT NULL, depbac VARCHAR(20) NOT NULL, etabbac VARCHAR(20) DEFAULT NULL, PRIMARY KEY(idbac))');
        $this->addSql('CREATE TABLE bloc (codebloc VARCHAR(10) NOT NULL, nombloc VARCHAR(20) NOT NULL, noteplancher INT NOT NULL, PRIMARY KEY(codebloc))');
        $this->addSql('CREATE TABLE element (codeelt VARCHAR(20) NOT NULL, PRIMARY KEY(codeelt))');
        $this->addSql('CREATE TABLE epreuve (codeepreuve VARCHAR(20) NOT NULL, numchance INT NOT NULL, annee INT NOT NULL, typeepreuve VARCHAR(10) NOT NULL, salle VARCHAR(20) DEFAULT NULL, duree INT DEFAULT NULL, PRIMARY KEY(codeepreuve))');
        $this->addSql('CREATE TABLE etudiant (numetd VARCHAR(20) NOT NULL, nom VARCHAR(30) NOT NULL, prenom VARCHAR(50) NOT NULL, email VARCHAR(60) NOT NULL, sexe VARCHAR(1) NOT NULL, adresse VARCHAR(70) NOT NULL, tel VARCHAR(40) NOT NULL, datnaiss DATE NOT NULL, depnaiss VARCHAR(40) DEFAULT NULL, villnaiss VARCHAR(40) DEFAULT NULL, paysnaiss VARCHAR(40) DEFAULT NULL, nationalite VARCHAR(50) DEFAULT NULL, sports VARCHAR(80) DEFAULT NULL, handicape VARCHAR(80) DEFAULT NULL, derdiplome VARCHAR(50) NOT NULL, dateinsc DATE NOT NULL, registre VARCHAR(30) DEFAULT NULL, statut VARCHAR(30) NOT NULL, PRIMARY KEY(numetd))');
        $this->addSql('CREATE TABLE filiere (codefiliere VARCHAR(10) NOT NULL, nomfiliere VARCHAR(20) NOT NULL, respfiliere VARCHAR(30) DEFAULT NULL, PRIMARY KEY(codefiliere))');
        $this->addSql('CREATE TABLE formation_ant (codef VARCHAR(10) NOT NULL, nomf VARCHAR(50) NOT NULL, etablissement VARCHAR(30) DEFAULT NULL, diplome VARCHAR(10) DEFAULT NULL, PRIMARY KEY(codef))');
        $this->addSql('CREATE TABLE groupe (codegrp VARCHAR(20) NOT NULL, nomgrp INT NOT NULL, nbetds INT NOT NULL, capacite INT NOT NULL, PRIMARY KEY(codegrp))');
        $this->addSql('CREATE TABLE matiere (codemat VARCHAR(20) NOT NULL, nommat VARCHAR(40) NOT NULL, periode VARCHAR(2) NOT NULL, PRIMARY KEY(codemat))');
        $this->addSql('CREATE TABLE specialite (codespe VARCHAR(10) NOT NULL, nomspe VARCHAR(20) NOT NULL, PRIMARY KEY(codespe))');
        $this->addSql('CREATE TABLE unite (codeunite VARCHAR(20) NOT NULL, nomunite VARCHAR(30) NOT NULL, coeficient INT NOT NULL, respunite VARCHAR(50) DEFAULT NULL, PRIMARY KEY(codeunite))');
        $this->addSql('CREATE TABLE messenger_messages (id BIGSERIAL NOT NULL, body TEXT NOT NULL, headers TEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, available_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, delivered_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
        $this->addSql('CREATE OR REPLACE FUNCTION notify_messenger_messages() RETURNS TRIGGER AS $$
            BEGIN
                PERFORM pg_notify(\'messenger_messages\', NEW.queue_name::text);
                RETURN NEW;
            END;
        $$ LANGUAGE plpgsql;');
        $this->addSql('DROP TRIGGER IF EXISTS notify_trigger ON messenger_messages;');
        $this->addSql('CREATE TRIGGER notify_trigger AFTER INSERT OR UPDATE ON messenger_messages FOR EACH ROW EXECUTE PROCEDURE notify_messenger_messages();');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE bac_idbac_seq CASCADE');
        $this->addSql('DROP SEQUENCE bloc_codebloc_seq CASCADE');
        $this->addSql('DROP SEQUENCE epreuve_codeepreuve_seq CASCADE');
        $this->addSql('DROP SEQUENCE filiere_codefiliere_seq CASCADE');
        $this->addSql('DROP SEQUENCE formation_ant_codef_seq CASCADE');
        $this->addSql('DROP SEQUENCE matiere_codemat_seq CASCADE');
        $this->addSql('DROP SEQUENCE specialite_codespe_seq CASCADE');
        $this->addSql('DROP SEQUENCE unite_codeunite_seq CASCADE');
        $this->addSql('DROP TABLE annee_universitaire');
        $this->addSql('DROP TABLE bac');
        $this->addSql('DROP TABLE bloc');
        $this->addSql('DROP TABLE element');
        $this->addSql('DROP TABLE epreuve');
        $this->addSql('DROP TABLE etudiant');
        $this->addSql('DROP TABLE filiere');
        $this->addSql('DROP TABLE formation_ant');
        $this->addSql('DROP TABLE groupe');
        $this->addSql('DROP TABLE matiere');
        $this->addSql('DROP TABLE specialite');
        $this->addSql('DROP TABLE unite');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
