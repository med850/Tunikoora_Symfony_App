<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220415084743 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs

    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article CHANGE titre titre VARCHAR(30) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, CHANGE description description TEXT CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, CHANGE image image VARCHAR(300) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`');
        $this->addSql('ALTER TABLE equipe CHANGE nom nom VARCHAR(30) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`');
        $this->addSql('ALTER TABLE joueur CHANGE nom nom VARCHAR(30) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, CHANGE prenom prenom VARCHAR(30) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, CHANGE poste poste VARCHAR(30) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`');
        $this->addSql('ALTER TABLE livraison CHANGE ref ref VARCHAR(10) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, CHANGE localisation localisation VARCHAR(50) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, CHANGE etat etat VARCHAR(10) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`');
        $this->addSql('ALTER TABLE livreur CHANGE nom nom VARCHAR(30) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, CHANGE prenom prenom VARCHAR(30) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`');
        $this->addSql('ALTER TABLE matchtb CHANGE localisation localisation VARCHAR(50) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, CHANGE arbitrePrincipale arbitrePrincipale VARCHAR(50) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, CHANGE tour tour VARCHAR(50) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`');
        $this->addSql('ALTER TABLE produit CHANGE nom nom VARCHAR(30) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, CHANGE description description TEXT CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, CHANGE image image VARCHAR(50) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`');
        $this->addSql('ALTER TABLE review CHANGE commentaire commentaire TEXT CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`');
        $this->addSql('ALTER TABLE ticket CHANGE equipeA equipeA VARCHAR(30) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, CHANGE equipeB equipeB VARCHAR(30) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`');
        $this->addSql('ALTER TABLE users CHANGE prenom prenom VARCHAR(30) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, CHANGE email email VARCHAR(30) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, CHANGE password password TINYTEXT CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, CHANGE repeatPassword repeatPassword TINYTEXT CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, CHANGE typeUser typeUser VARCHAR(7) CHARACTER SET utf8 DEFAULT \'client\' NOT NULL COLLATE `utf8_general_ci`, CHANGE username username VARCHAR(20) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, CHANGE roles roles LONGTEXT CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci` COMMENT \'(DC2Type:json)\'');
    }
}
