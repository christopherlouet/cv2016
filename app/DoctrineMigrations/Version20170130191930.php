<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170130191930 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE profil_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE experience_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE formation_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE competence_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE domaine_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE activite_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE profil (id INT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, age VARCHAR(255) NOT NULL, permis VARCHAR(255) DEFAULT NULL, statut VARCHAR(255) DEFAULT NULL, adresse VARCHAR(255) NOT NULL, code_postal VARCHAR(255) NOT NULL, ville VARCHAR(255) NOT NULL, telephone VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE experience (id INT NOT NULL, tag VARCHAR(100) NOT NULL, poste VARCHAR(255) NOT NULL, entreprise VARCHAR(255) NOT NULL, debut VARCHAR(255) NOT NULL, fin VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE formation (id INT NOT NULL, tag VARCHAR(100) NOT NULL, ecole VARCHAR(255) NOT NULL, debut VARCHAR(255) NOT NULL, fin VARCHAR(255) NOT NULL, intitule VARCHAR(255) NOT NULL, validation VARCHAR(255) DEFAULT NULL, niveau VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE competence (id INT NOT NULL, domaine INT NOT NULL, libelle VARCHAR(255) NOT NULL, niveau VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_94D4687F78AF0ACC ON competence (domaine)');
        $this->addSql('CREATE TABLE domaine (id INT NOT NULL, tag VARCHAR(100) NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE activite (id INT NOT NULL, experience INT NOT NULL, libelle TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_B8755515590C103 ON activite (experience)');
        $this->addSql('ALTER TABLE competence ADD CONSTRAINT FK_94D4687F78AF0ACC FOREIGN KEY (domaine) REFERENCES domaine (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE activite ADD CONSTRAINT FK_B8755515590C103 FOREIGN KEY (experience) REFERENCES experience (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE activite DROP CONSTRAINT FK_B8755515590C103');
        $this->addSql('ALTER TABLE competence DROP CONSTRAINT FK_94D4687F78AF0ACC');
        $this->addSql('DROP SEQUENCE profil_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE experience_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE formation_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE competence_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE domaine_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE activite_id_seq CASCADE');
        $this->addSql('DROP TABLE profil');
        $this->addSql('DROP TABLE experience');
        $this->addSql('DROP TABLE formation');
        $this->addSql('DROP TABLE competence');
        $this->addSql('DROP TABLE domaine');
        $this->addSql('DROP TABLE activite');
    }
}
