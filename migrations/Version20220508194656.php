<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220508194656 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
       
        $this->addSql('ALTER TABLE livraison CHANGE user_id user_id INT DEFAULT NULL, CHANGE datesortie datesortie VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE matchtb CHANGE localisation localisation VARCHAR(25) NOT NULL, CHANGE arbitrePrincipale arbitreprincipale VARCHAR(25) NOT NULL, CHANGE tour tour VARCHAR(25) NOT NULL');
        $this->addSql('ALTER TABLE participation ADD equipe_id2 INT DEFAULT NULL, ADD date DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE participation ADD CONSTRAINT FK_AB55E24F8EDC0392 FOREIGN KEY (equipe_id2) REFERENCES equipe (id)');
        $this->addSql('CREATE INDEX IDX_AB55E24F8EDC0392 ON participation (equipe_id2)');
        $this->addSql('ALTER TABLE produit CHANGE prix prix INT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE profanities');
        $this->addSql('ALTER TABLE joueur DROP nb_but, DROP image');
        $this->addSql('ALTER TABLE livraison CHANGE user_id user_id INT NOT NULL, CHANGE datesortie datesortie DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE matchtb CHANGE localisation localisation VARCHAR(50) NOT NULL, CHANGE arbitreprincipale arbitrePrincipale VARCHAR(50) NOT NULL, CHANGE tour tour VARCHAR(50) NOT NULL');
        $this->addSql('ALTER TABLE participation DROP FOREIGN KEY FK_AB55E24F8EDC0392');
        $this->addSql('DROP INDEX IDX_AB55E24F8EDC0392 ON participation');
        $this->addSql('ALTER TABLE participation DROP equipe_id2, DROP date');
        $this->addSql('ALTER TABLE produit CHANGE prix prix INT NOT NULL');
    }
}
