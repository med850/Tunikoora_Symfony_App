<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220424153633 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article ADD date_modif DATETIME DEFAULT NULL');

    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article DROP date_modif');
        $this->addSql('ALTER TABLE livraison DROP FOREIGN KEY FK_A60C9F1FA76ED395');
        $this->addSql('ALTER TABLE livraison CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE livreur DROP FOREIGN KEY FK_EB7A4E6D8E54FB25');
        $this->addSql('ALTER TABLE livreur CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE matchtb CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE panier DROP FOREIGN KEY FK_24CC0DF2A76ED395');
        $this->addSql('ALTER TABLE panier DROP FOREIGN KEY FK_24CC0DF2F347EFB');
        $this->addSql('ALTER TABLE panier CHANGE idPanier idPanier INT NOT NULL');
        $this->addSql('ALTER TABLE panierp DROP FOREIGN KEY FK_D190C18CA76ED395');
        $this->addSql('ALTER TABLE panierp DROP FOREIGN KEY FK_D190C18CF347EFB');
        $this->addSql('ALTER TABLE panierp CHANGE idPanier idPanier INT NOT NULL');
        $this->addSql('ALTER TABLE participation DROP FOREIGN KEY FK_AB55E24F2ABEACD6');
        $this->addSql('ALTER TABLE participation DROP FOREIGN KEY FK_AB55E24F6D861B89');
        $this->addSql('ALTER TABLE participation CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC27A76ED395');
        $this->addSql('ALTER TABLE produit CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE review DROP FOREIGN KEY FK_794381C6A76ED395');
        $this->addSql('ALTER TABLE review DROP FOREIGN KEY FK_794381C67294869C');
        $this->addSql('ALTER TABLE review ADD rating INT DEFAULT NULL, DROP date_review, DROP author');
        $this->addSql('ALTER TABLE ticket DROP FOREIGN KEY FK_97A0ADA32ABEACD6');
        $this->addSql('ALTER TABLE ticket DROP FOREIGN KEY FK_97A0ADA3A76ED395');
        $this->addSql('ALTER TABLE ticket CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE users CHANGE id id INT NOT NULL, CHANGE roles roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin` COMMENT \'(DC2Type:json)\'');
    }
}
