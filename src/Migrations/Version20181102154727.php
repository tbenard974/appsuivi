<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181102154727 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE niveaucompetition_nivcom_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE user_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE nomcompetition_nomcom_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE niveaucompetition (nivcom_id INT NOT NULL, nivcom_name VARCHAR(50) NOT NULL, nivcom_description VARCHAR(200) DEFAULT NULL, nivcom_auteurcreation VARCHAR(50) NOT NULL, nivcom_datecreation TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, nivcom_auteurchangement VARCHAR(50) NOT NULL, nivcom_datechangement TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(nivcom_id))');
        $this->addSql('CREATE TABLE "user" (id INT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON "user" (email)');
        $this->addSql('CREATE TABLE nomcompetition (nomcom_id INT NOT NULL, nomcom_name VARCHAR(50) NOT NULL, nomcom_description VARCHAR(200) DEFAULT NULL, nomcom_auteurcreation VARCHAR(50) NOT NULL, nomcom_datecreation TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, nomcom_auteurchangement VARCHAR(50) NOT NULL, nivcom_datechangement TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(nomcom_id))');
        $this->addSql('ALTER TABLE role ALTER rol_id DROP DEFAULT');
        $this->addSql('ALTER TABLE division ALTER div_id DROP DEFAULT');
        $this->addSql('ALTER TABLE fichier ALTER fic_id DROP DEFAULT');
        $this->addSql('ALTER TABLE fichier ALTER fic_fk_idutilisateur DROP NOT NULL');
        $this->addSql('ALTER TABLE fichier ALTER fic_fk_idtypefichier DROP NOT NULL');
        $this->addSql('ALTER TABLE jointuresport DROP CONSTRAINT fk_jointuresport_epreuve');
        $this->addSql('ALTER TABLE jointuresport DROP CONSTRAINT fk_jointuresport_typesport');
        $this->addSql('DROP INDEX IDX_333FDFF4D81254FE');
        $this->addSql('DROP INDEX IDX_333FDFF479564EF8');
        $this->addSql('ALTER TABLE jointuresport ADD joispo_fk_idniveaucompetition INT DEFAULT NULL');
        $this->addSql('ALTER TABLE jointuresport ADD joispo_fk_idnomcompetition INT DEFAULT NULL');
        $this->addSql('ALTER TABLE jointuresport DROP joispo_fk_idepreuve');
        $this->addSql('ALTER TABLE jointuresport DROP joispo_fk_idtypesport');
        $this->addSql('ALTER TABLE jointuresport ALTER joispo_id DROP DEFAULT');
        $this->addSql('ALTER TABLE jointuresport ALTER joispo_fk_idsport DROP NOT NULL');
        $this->addSql('ALTER TABLE jointuresport ADD CONSTRAINT FK_333FDFF49C8747F0 FOREIGN KEY (joispo_fk_idniveaucompetition) REFERENCES niveaucompetition (nivcom_id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE jointuresport ADD CONSTRAINT FK_333FDFF491ED467B FOREIGN KEY (joispo_fk_idnomcompetition) REFERENCES nomcompetition (nomcom_id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_333FDFF49C8747F0 ON jointuresport (joispo_fk_idniveaucompetition)');
        $this->addSql('CREATE INDEX IDX_333FDFF491ED467B ON jointuresport (joispo_fk_idnomcompetition)');
        $this->addSql('ALTER TABLE typesport ALTER typspo_id DROP DEFAULT');
        $this->addSql('ALTER TABLE epreuve ALTER epr_id DROP DEFAULT');
        $this->addSql('ALTER TABLE absence ALTER abs_id DROP DEFAULT');
        $this->addSql('ALTER TABLE absence ALTER abs_fk_idutilisateur DROP NOT NULL');
        $this->addSql('ALTER TABLE absence ALTER abs_fk_idstatusabsence DROP NOT NULL');
        $this->addSql('ALTER TABLE absence ALTER abs_fk_idmotifabsence DROP NOT NULL');
        $this->addSql('ALTER TABLE sport ADD spo_fk_idtypesport INT DEFAULT NULL');
        $this->addSql('ALTER TABLE sport ALTER spo_id DROP DEFAULT');
        $this->addSql('ALTER TABLE sport ADD CONSTRAINT FK_1A85EFD21B02A3C1 FOREIGN KEY (spo_fk_idtypesport) REFERENCES typesport (typspo_id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_1A85EFD21B02A3C1 ON sport (spo_fk_idtypesport)');
        $this->addSql('ALTER TABLE categorie ALTER cat_id DROP DEFAULT');
        $this->addSql('ALTER TABLE utilisateur ALTER uti_id DROP DEFAULT');
        $this->addSql('ALTER TABLE utilisateur ALTER uti_fk_idsport DROP NOT NULL');
        $this->addSql('ALTER TABLE utilisateur ALTER uti_fk_idrole DROP NOT NULL');
        $this->addSql('ALTER TABLE utilisateur ALTER uti_fk_iddepartement DROP NOT NULL');
        $this->addSql('ALTER TABLE utilisateur ALTER uti_fk_idniveaulisteministerielle DROP NOT NULL');
        $this->addSql('ALTER TABLE competition ALTER com_id DROP DEFAULT');
        $this->addSql('ALTER TABLE jointurecompetition ALTER joicom_id DROP DEFAULT');
        $this->addSql('ALTER TABLE jointurecompetition ALTER joicom_fk_idjointuresport DROP NOT NULL');
        $this->addSql('ALTER TABLE jointurecompetition ALTER joicom_fk_idcompetition DROP NOT NULL');
        $this->addSql('ALTER TABLE jointurecompetition ALTER joicom_fk_iddivision DROP NOT NULL');
        $this->addSql('ALTER TABLE jointurecompetition ALTER joicom_fk_idcategorie DROP NOT NULL');
        $this->addSql('ALTER TABLE niveaulisteministerielle ALTER nivlismin_id DROP DEFAULT');
        $this->addSql('ALTER TABLE motifabsence ALTER motabs_id DROP DEFAULT');
        $this->addSql('ALTER TABLE departement ALTER dep_id DROP DEFAULT');
        $this->addSql('ALTER TABLE classement ALTER cla_id DROP DEFAULT');
        $this->addSql('ALTER TABLE typefichier ALTER typfic_id DROP DEFAULT');
        $this->addSql('ALTER TABLE statusabsence ALTER staabs_id DROP DEFAULT');
        $this->addSql('ALTER TABLE performance DROP CONSTRAINT fk_performance_jointurecompetition');
        $this->addSql('DROP INDEX IDX_82D79681601402E2');
        $this->addSql('ALTER TABLE performance ADD per_fk_idjointuresport INT DEFAULT NULL');
        $this->addSql('ALTER TABLE performance DROP per_fk_idjointurecompetition');
        $this->addSql('ALTER TABLE performance ALTER per_id DROP DEFAULT');
        $this->addSql('ALTER TABLE performance ALTER per_fk_idutilisateur DROP NOT NULL');
        $this->addSql('ALTER TABLE performance ALTER per_fk_idclassement DROP NOT NULL');
        $this->addSql('ALTER TABLE performance ADD CONSTRAINT FK_82D7968141C19AA6 FOREIGN KEY (per_fk_idjointuresport) REFERENCES jointuresport (joispo_id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_82D7968141C19AA6 ON performance (per_fk_idjointuresport)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE jointuresport DROP CONSTRAINT FK_333FDFF49C8747F0');
        $this->addSql('ALTER TABLE jointuresport DROP CONSTRAINT FK_333FDFF491ED467B');
        $this->addSql('DROP SEQUENCE niveaucompetition_nivcom_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE user_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE nomcompetition_nomcom_id_seq CASCADE');
        $this->addSql('DROP TABLE niveaucompetition');
        $this->addSql('DROP TABLE "user"');
        $this->addSql('DROP TABLE nomcompetition');
        $this->addSql('CREATE SEQUENCE categorie_cat_id_seq');
        $this->addSql('SELECT setval(\'categorie_cat_id_seq\', (SELECT MAX(cat_id) FROM categorie))');
        $this->addSql('ALTER TABLE categorie ALTER cat_id SET DEFAULT nextval(\'categorie_cat_id_seq\')');
        $this->addSql('CREATE SEQUENCE competition_com_id_seq');
        $this->addSql('SELECT setval(\'competition_com_id_seq\', (SELECT MAX(com_id) FROM competition))');
        $this->addSql('ALTER TABLE competition ALTER com_id SET DEFAULT nextval(\'competition_com_id_seq\')');
        $this->addSql('CREATE SEQUENCE classement_cla_id_seq');
        $this->addSql('SELECT setval(\'classement_cla_id_seq\', (SELECT MAX(cla_id) FROM classement))');
        $this->addSql('ALTER TABLE classement ALTER cla_id SET DEFAULT nextval(\'classement_cla_id_seq\')');
        $this->addSql('CREATE SEQUENCE epreuve_epr_id_seq');
        $this->addSql('SELECT setval(\'epreuve_epr_id_seq\', (SELECT MAX(epr_id) FROM epreuve))');
        $this->addSql('ALTER TABLE epreuve ALTER epr_id SET DEFAULT nextval(\'epreuve_epr_id_seq\')');
        $this->addSql('CREATE SEQUENCE jointurecompetition_joicom_id_seq');
        $this->addSql('SELECT setval(\'jointurecompetition_joicom_id_seq\', (SELECT MAX(joicom_id) FROM jointurecompetition))');
        $this->addSql('ALTER TABLE jointurecompetition ALTER joicom_id SET DEFAULT nextval(\'jointurecompetition_joicom_id_seq\')');
        $this->addSql('ALTER TABLE jointurecompetition ALTER joicom_fk_idcategorie SET NOT NULL');
        $this->addSql('ALTER TABLE jointurecompetition ALTER joicom_fk_idcompetition SET NOT NULL');
        $this->addSql('ALTER TABLE jointurecompetition ALTER joicom_fk_iddivision SET NOT NULL');
        $this->addSql('ALTER TABLE jointurecompetition ALTER joicom_fk_idjointuresport SET NOT NULL');
        $this->addSql('CREATE SEQUENCE typefichier_typfic_id_seq');
        $this->addSql('SELECT setval(\'typefichier_typfic_id_seq\', (SELECT MAX(typfic_id) FROM typefichier))');
        $this->addSql('ALTER TABLE typefichier ALTER typfic_id SET DEFAULT nextval(\'typefichier_typfic_id_seq\')');
        $this->addSql('CREATE SEQUENCE motifabsence_motabs_id_seq');
        $this->addSql('SELECT setval(\'motifabsence_motabs_id_seq\', (SELECT MAX(motabs_id) FROM motifabsence))');
        $this->addSql('ALTER TABLE motifabsence ALTER motabs_id SET DEFAULT nextval(\'motifabsence_motabs_id_seq\')');
        $this->addSql('CREATE SEQUENCE niveaulisteministerielle_nivlismin_id_seq');
        $this->addSql('SELECT setval(\'niveaulisteministerielle_nivlismin_id_seq\', (SELECT MAX(nivlismin_id) FROM niveaulisteministerielle))');
        $this->addSql('ALTER TABLE niveaulisteministerielle ALTER nivlismin_id SET DEFAULT nextval(\'niveaulisteministerielle_nivlismin_id_seq\')');
        $this->addSql('CREATE SEQUENCE fichier_fic_id_seq');
        $this->addSql('SELECT setval(\'fichier_fic_id_seq\', (SELECT MAX(fic_id) FROM fichier))');
        $this->addSql('ALTER TABLE fichier ALTER fic_id SET DEFAULT nextval(\'fichier_fic_id_seq\')');
        $this->addSql('ALTER TABLE fichier ALTER fic_fk_idtypefichier SET NOT NULL');
        $this->addSql('ALTER TABLE fichier ALTER fic_fk_idutilisateur SET NOT NULL');
        $this->addSql('CREATE SEQUENCE statusabsence_staabs_id_seq');
        $this->addSql('SELECT setval(\'statusabsence_staabs_id_seq\', (SELECT MAX(staabs_id) FROM statusabsence))');
        $this->addSql('ALTER TABLE statusabsence ALTER staabs_id SET DEFAULT nextval(\'statusabsence_staabs_id_seq\')');
        $this->addSql('CREATE SEQUENCE role_rol_id_seq');
        $this->addSql('SELECT setval(\'role_rol_id_seq\', (SELECT MAX(rol_id) FROM role))');
        $this->addSql('ALTER TABLE role ALTER rol_id SET DEFAULT nextval(\'role_rol_id_seq\')');
        $this->addSql('CREATE SEQUENCE absence_abs_id_seq');
        $this->addSql('SELECT setval(\'absence_abs_id_seq\', (SELECT MAX(abs_id) FROM absence))');
        $this->addSql('ALTER TABLE absence ALTER abs_id SET DEFAULT nextval(\'absence_abs_id_seq\')');
        $this->addSql('ALTER TABLE absence ALTER abs_fk_idmotifabsence SET NOT NULL');
        $this->addSql('ALTER TABLE absence ALTER abs_fk_idstatusabsence SET NOT NULL');
        $this->addSql('ALTER TABLE absence ALTER abs_fk_idutilisateur SET NOT NULL');
        $this->addSql('ALTER TABLE sport DROP CONSTRAINT FK_1A85EFD21B02A3C1');
        $this->addSql('DROP INDEX IDX_1A85EFD21B02A3C1');
        $this->addSql('ALTER TABLE sport DROP spo_fk_idtypesport');
        $this->addSql('CREATE SEQUENCE sport_spo_id_seq');
        $this->addSql('SELECT setval(\'sport_spo_id_seq\', (SELECT MAX(spo_id) FROM sport))');
        $this->addSql('ALTER TABLE sport ALTER spo_id SET DEFAULT nextval(\'sport_spo_id_seq\')');
        $this->addSql('ALTER TABLE performance DROP CONSTRAINT FK_82D7968141C19AA6');
        $this->addSql('DROP INDEX IDX_82D7968141C19AA6');
        $this->addSql('ALTER TABLE performance ADD per_fk_idjointurecompetition INT NOT NULL');
        $this->addSql('ALTER TABLE performance DROP per_fk_idjointuresport');
        $this->addSql('CREATE SEQUENCE performance_per_id_seq');
        $this->addSql('SELECT setval(\'performance_per_id_seq\', (SELECT MAX(per_id) FROM performance))');
        $this->addSql('ALTER TABLE performance ALTER per_id SET DEFAULT nextval(\'performance_per_id_seq\')');
        $this->addSql('ALTER TABLE performance ALTER per_fk_idclassement SET NOT NULL');
        $this->addSql('ALTER TABLE performance ALTER per_fk_idutilisateur SET NOT NULL');
        $this->addSql('ALTER TABLE performance ADD CONSTRAINT fk_performance_jointurecompetition FOREIGN KEY (per_fk_idjointurecompetition) REFERENCES jointurecompetition (joicom_id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_82D79681601402E2 ON performance (per_fk_idjointurecompetition)');
        $this->addSql('CREATE SEQUENCE division_div_id_seq');
        $this->addSql('SELECT setval(\'division_div_id_seq\', (SELECT MAX(div_id) FROM division))');
        $this->addSql('ALTER TABLE division ALTER div_id SET DEFAULT nextval(\'division_div_id_seq\')');
        $this->addSql('CREATE SEQUENCE typesport_typspo_id_seq');
        $this->addSql('SELECT setval(\'typesport_typspo_id_seq\', (SELECT MAX(typspo_id) FROM typesport))');
        $this->addSql('ALTER TABLE typesport ALTER typspo_id SET DEFAULT nextval(\'typesport_typspo_id_seq\')');
        $this->addSql('DROP INDEX IDX_333FDFF49C8747F0');
        $this->addSql('DROP INDEX IDX_333FDFF491ED467B');
        $this->addSql('ALTER TABLE jointuresport ADD joispo_fk_idepreuve INT NOT NULL');
        $this->addSql('ALTER TABLE jointuresport ADD joispo_fk_idtypesport INT NOT NULL');
        $this->addSql('ALTER TABLE jointuresport DROP joispo_fk_idniveaucompetition');
        $this->addSql('ALTER TABLE jointuresport DROP joispo_fk_idnomcompetition');
        $this->addSql('CREATE SEQUENCE jointuresport_joispo_id_seq');
        $this->addSql('SELECT setval(\'jointuresport_joispo_id_seq\', (SELECT MAX(joispo_id) FROM jointuresport))');
        $this->addSql('ALTER TABLE jointuresport ALTER joispo_id SET DEFAULT nextval(\'jointuresport_joispo_id_seq\')');
        $this->addSql('ALTER TABLE jointuresport ALTER joispo_fk_idsport SET NOT NULL');
        $this->addSql('ALTER TABLE jointuresport ADD CONSTRAINT fk_jointuresport_epreuve FOREIGN KEY (joispo_fk_idepreuve) REFERENCES epreuve (epr_id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE jointuresport ADD CONSTRAINT fk_jointuresport_typesport FOREIGN KEY (joispo_fk_idtypesport) REFERENCES typesport (typspo_id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_333FDFF4D81254FE ON jointuresport (joispo_fk_idepreuve)');
        $this->addSql('CREATE INDEX IDX_333FDFF479564EF8 ON jointuresport (joispo_fk_idtypesport)');
        $this->addSql('CREATE SEQUENCE departement_dep_id_seq');
        $this->addSql('SELECT setval(\'departement_dep_id_seq\', (SELECT MAX(dep_id) FROM departement))');
        $this->addSql('ALTER TABLE departement ALTER dep_id SET DEFAULT nextval(\'departement_dep_id_seq\')');
        $this->addSql('CREATE SEQUENCE utilisateur_uti_id_seq');
        $this->addSql('SELECT setval(\'utilisateur_uti_id_seq\', (SELECT MAX(uti_id) FROM utilisateur))');
        $this->addSql('ALTER TABLE utilisateur ALTER uti_id SET DEFAULT nextval(\'utilisateur_uti_id_seq\')');
        $this->addSql('ALTER TABLE utilisateur ALTER uti_fk_iddepartement SET NOT NULL');
        $this->addSql('ALTER TABLE utilisateur ALTER uti_fk_idniveaulisteministerielle SET NOT NULL');
        $this->addSql('ALTER TABLE utilisateur ALTER uti_fk_idrole SET NOT NULL');
        $this->addSql('ALTER TABLE utilisateur ALTER uti_fk_idsport SET NOT NULL');
    }
}
