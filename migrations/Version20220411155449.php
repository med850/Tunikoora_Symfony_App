<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220411155449 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY fk_article_user');
        $this->addSql('ALTER TABLE article CHANGE user_id user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E66A76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE dislike DROP FOREIGN KEY fk_dislike_article');
        $this->addSql('ALTER TABLE dislike DROP FOREIGN KEY fk_dislike_user');
        $this->addSql('ALTER TABLE dislike CHANGE user_id user_id INT DEFAULT NULL, CHANGE article_id article_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE dislike ADD CONSTRAINT FK_FE3BECAA7294869C FOREIGN KEY (article_id) REFERENCES article (id)');
        $this->addSql('ALTER TABLE dislike ADD CONSTRAINT FK_FE3BECAAA76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE joueur DROP FOREIGN KEY fk_joueur_equipe');
        $this->addSql('ALTER TABLE joueur CHANGE equipe_id equipe_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE joueur ADD CONSTRAINT FK_FD71A9C56D861B89 FOREIGN KEY (equipe_id) REFERENCES equipe (id)');
        $this->addSql('ALTER TABLE ligne_commande_produit DROP FOREIGN KEY fk_produit_commande');
        $this->addSql('ALTER TABLE ligne_commande_produit DROP FOREIGN KEY fk_produit_livraison');
        $this->addSql('ALTER TABLE ligne_commande_produit CHANGE id_livraison id_livraison INT DEFAULT NULL, CHANGE id_produit id_produit INT DEFAULT NULL');
        $this->addSql('ALTER TABLE ligne_commande_produit ADD CONSTRAINT FK_5BAB3E38F7384557 FOREIGN KEY (id_produit) REFERENCES produit (id)');
        $this->addSql('ALTER TABLE ligne_commande_produit ADD CONSTRAINT FK_5BAB3E3826392338 FOREIGN KEY (id_livraison) REFERENCES livraison (id)');
        $this->addSql('ALTER TABLE ligne_commande_ticket DROP FOREIGN KEY fk_livraison1_commande');
        $this->addSql('ALTER TABLE ligne_commande_ticket DROP FOREIGN KEY fk_ticket_commande');
        $this->addSql('ALTER TABLE ligne_commande_ticket CHANGE id_livraison id_livraison INT DEFAULT NULL, CHANGE id_ticket id_ticket INT DEFAULT NULL');
        $this->addSql('ALTER TABLE ligne_commande_ticket ADD CONSTRAINT FK_9E15376526392338 FOREIGN KEY (id_livraison) REFERENCES livraison (id)');
        $this->addSql('ALTER TABLE ligne_commande_ticket ADD CONSTRAINT FK_9E153765B197184E FOREIGN KEY (id_ticket) REFERENCES ticket (id)');
        $this->addSql('ALTER TABLE likes DROP FOREIGN KEY fk_likes_article');
        $this->addSql('ALTER TABLE likes DROP FOREIGN KEY fk_likes_users');
        $this->addSql('ALTER TABLE likes CHANGE user_id user_id INT DEFAULT NULL, CHANGE article_id article_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE likes ADD CONSTRAINT FK_49CA4E7D7294869C FOREIGN KEY (article_id) REFERENCES article (id)');
        $this->addSql('ALTER TABLE likes ADD CONSTRAINT FK_49CA4E7DA76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE livraison DROP FOREIGN KEY fk_livraison_user');
        $this->addSql('ALTER TABLE livraison CHANGE user_id user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE livraison ADD CONSTRAINT FK_A60C9F1FA76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE livreur DROP FOREIGN KEY fk_livraison_livreur');
        $this->addSql('ALTER TABLE livreur CHANGE livraison_id livraison_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE livreur ADD CONSTRAINT FK_EB7A4E6D8E54FB25 FOREIGN KEY (livraison_id) REFERENCES livraison (id)');
        $this->addSql('ALTER TABLE panier DROP FOREIGN KEY fk_panier_tiket');
        $this->addSql('ALTER TABLE panier DROP FOREIGN KEY fk_panier_user');
        $this->addSql('ALTER TABLE panier CHANGE user_id user_id INT DEFAULT NULL, CHANGE produit_id produit_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE panier ADD CONSTRAINT FK_24CC0DF2F347EFB FOREIGN KEY (produit_id) REFERENCES ticket (id)');
        $this->addSql('ALTER TABLE panier ADD CONSTRAINT FK_24CC0DF2A76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE panierp DROP FOREIGN KEY fk_panier_produit');
        $this->addSql('ALTER TABLE panierp DROP FOREIGN KEY fk_panier_user1');
        $this->addSql('ALTER TABLE panierp CHANGE user_id user_id INT DEFAULT NULL, CHANGE produit_id produit_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE panierp ADD CONSTRAINT FK_D190C18CF347EFB FOREIGN KEY (produit_id) REFERENCES produit (id)');
        $this->addSql('ALTER TABLE panierp ADD CONSTRAINT FK_D190C18CA76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE participation DROP FOREIGN KEY fk_participation_equipe');
        $this->addSql('ALTER TABLE participation DROP FOREIGN KEY fk_participation_match');
        $this->addSql('ALTER TABLE participation CHANGE match_id match_id INT DEFAULT NULL, CHANGE equipe_id equipe_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE participation ADD CONSTRAINT FK_AB55E24F6D861B89 FOREIGN KEY (equipe_id) REFERENCES equipe (id)');
        $this->addSql('ALTER TABLE participation ADD CONSTRAINT FK_AB55E24F2ABEACD6 FOREIGN KEY (match_id) REFERENCES matchtb (id)');
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY fk_produit_user');
        $this->addSql('ALTER TABLE produit CHANGE user_id user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC27A76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE review DROP FOREIGN KEY fk_article_review');
        $this->addSql('ALTER TABLE review DROP FOREIGN KEY fk_user_review');
        $this->addSql('ALTER TABLE review CHANGE article_id article_id INT DEFAULT NULL, CHANGE user_id user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE review ADD CONSTRAINT FK_794381C67294869C FOREIGN KEY (article_id) REFERENCES article (id)');
        $this->addSql('ALTER TABLE review ADD CONSTRAINT FK_794381C6A76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE ticket DROP FOREIGN KEY fk_ticket_match');
        $this->addSql('ALTER TABLE ticket DROP FOREIGN KEY fk_ticket_user');
        $this->addSql('ALTER TABLE ticket CHANGE match_id match_id INT DEFAULT NULL, CHANGE user_id user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE ticket ADD CONSTRAINT FK_97A0ADA32ABEACD6 FOREIGN KEY (match_id) REFERENCES matchtb (id)');
        $this->addSql('ALTER TABLE ticket ADD CONSTRAINT FK_97A0ADA3A76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE users CHANGE password password TINYTEXT NOT NULL, CHANGE repeatPassword repeatPassword TINYTEXT NOT NULL, CHANGE typeUser typeUser VARCHAR(7) DEFAULT \'client\' NOT NULL, CHANGE nom username VARCHAR(20) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E66A76ED395');
        $this->addSql('ALTER TABLE article CHANGE user_id user_id INT NOT NULL');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT fk_article_user FOREIGN KEY (user_id) REFERENCES users (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE dislike DROP FOREIGN KEY FK_FE3BECAA7294869C');
        $this->addSql('ALTER TABLE dislike DROP FOREIGN KEY FK_FE3BECAAA76ED395');
        $this->addSql('ALTER TABLE dislike CHANGE article_id article_id INT NOT NULL, CHANGE user_id user_id INT NOT NULL');
        $this->addSql('ALTER TABLE dislike ADD CONSTRAINT fk_dislike_article FOREIGN KEY (article_id) REFERENCES article (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE dislike ADD CONSTRAINT fk_dislike_user FOREIGN KEY (user_id) REFERENCES users (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE joueur DROP FOREIGN KEY FK_FD71A9C56D861B89');
        $this->addSql('ALTER TABLE joueur CHANGE equipe_id equipe_id INT NOT NULL');
        $this->addSql('ALTER TABLE joueur ADD CONSTRAINT fk_joueur_equipe FOREIGN KEY (equipe_id) REFERENCES equipe (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ligne_commande_produit DROP FOREIGN KEY FK_5BAB3E38F7384557');
        $this->addSql('ALTER TABLE ligne_commande_produit DROP FOREIGN KEY FK_5BAB3E3826392338');
        $this->addSql('ALTER TABLE ligne_commande_produit CHANGE id_produit id_produit INT NOT NULL, CHANGE id_livraison id_livraison INT NOT NULL');
        $this->addSql('ALTER TABLE ligne_commande_produit ADD CONSTRAINT fk_produit_commande FOREIGN KEY (id_produit) REFERENCES produit (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ligne_commande_produit ADD CONSTRAINT fk_produit_livraison FOREIGN KEY (id_livraison) REFERENCES livraison (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ligne_commande_ticket DROP FOREIGN KEY FK_9E15376526392338');
        $this->addSql('ALTER TABLE ligne_commande_ticket DROP FOREIGN KEY FK_9E153765B197184E');
        $this->addSql('ALTER TABLE ligne_commande_ticket CHANGE id_livraison id_livraison INT NOT NULL, CHANGE id_ticket id_ticket INT NOT NULL');
        $this->addSql('ALTER TABLE ligne_commande_ticket ADD CONSTRAINT fk_livraison1_commande FOREIGN KEY (id_livraison) REFERENCES livraison (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ligne_commande_ticket ADD CONSTRAINT fk_ticket_commande FOREIGN KEY (id_ticket) REFERENCES ticket (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE likes DROP FOREIGN KEY FK_49CA4E7D7294869C');
        $this->addSql('ALTER TABLE likes DROP FOREIGN KEY FK_49CA4E7DA76ED395');
        $this->addSql('ALTER TABLE likes CHANGE article_id article_id INT NOT NULL, CHANGE user_id user_id INT NOT NULL');
        $this->addSql('ALTER TABLE likes ADD CONSTRAINT fk_likes_article FOREIGN KEY (article_id) REFERENCES article (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE likes ADD CONSTRAINT fk_likes_users FOREIGN KEY (user_id) REFERENCES users (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE livraison DROP FOREIGN KEY FK_A60C9F1FA76ED395');
        $this->addSql('ALTER TABLE livraison CHANGE user_id user_id INT NOT NULL');
        $this->addSql('ALTER TABLE livraison ADD CONSTRAINT fk_livraison_user FOREIGN KEY (user_id) REFERENCES users (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE livreur DROP FOREIGN KEY FK_EB7A4E6D8E54FB25');
        $this->addSql('ALTER TABLE livreur CHANGE livraison_id livraison_id INT NOT NULL');
        $this->addSql('ALTER TABLE livreur ADD CONSTRAINT fk_livraison_livreur FOREIGN KEY (livraison_id) REFERENCES livraison (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE panier DROP FOREIGN KEY FK_24CC0DF2F347EFB');
        $this->addSql('ALTER TABLE panier DROP FOREIGN KEY FK_24CC0DF2A76ED395');
        $this->addSql('ALTER TABLE panier CHANGE produit_id produit_id INT NOT NULL, CHANGE user_id user_id INT NOT NULL');
        $this->addSql('ALTER TABLE panier ADD CONSTRAINT fk_panier_tiket FOREIGN KEY (produit_id) REFERENCES ticket (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE panier ADD CONSTRAINT fk_panier_user FOREIGN KEY (user_id) REFERENCES users (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE panierp DROP FOREIGN KEY FK_D190C18CF347EFB');
        $this->addSql('ALTER TABLE panierp DROP FOREIGN KEY FK_D190C18CA76ED395');
        $this->addSql('ALTER TABLE panierp CHANGE produit_id produit_id INT NOT NULL, CHANGE user_id user_id INT NOT NULL');
        $this->addSql('ALTER TABLE panierp ADD CONSTRAINT fk_panier_produit FOREIGN KEY (produit_id) REFERENCES produit (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE panierp ADD CONSTRAINT fk_panier_user1 FOREIGN KEY (user_id) REFERENCES users (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE participation DROP FOREIGN KEY FK_AB55E24F6D861B89');
        $this->addSql('ALTER TABLE participation DROP FOREIGN KEY FK_AB55E24F2ABEACD6');
        $this->addSql('ALTER TABLE participation CHANGE equipe_id equipe_id INT NOT NULL, CHANGE match_id match_id INT NOT NULL');
        $this->addSql('ALTER TABLE participation ADD CONSTRAINT fk_participation_equipe FOREIGN KEY (equipe_id) REFERENCES equipe (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE participation ADD CONSTRAINT fk_participation_match FOREIGN KEY (match_id) REFERENCES matchtb (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC27A76ED395');
        $this->addSql('ALTER TABLE produit CHANGE user_id user_id INT NOT NULL');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT fk_produit_user FOREIGN KEY (user_id) REFERENCES users (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE review DROP FOREIGN KEY FK_794381C67294869C');
        $this->addSql('ALTER TABLE review DROP FOREIGN KEY FK_794381C6A76ED395');
        $this->addSql('ALTER TABLE review CHANGE article_id article_id INT NOT NULL, CHANGE user_id user_id INT NOT NULL');
        $this->addSql('ALTER TABLE review ADD CONSTRAINT fk_article_review FOREIGN KEY (article_id) REFERENCES article (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE review ADD CONSTRAINT fk_user_review FOREIGN KEY (user_id) REFERENCES users (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ticket DROP FOREIGN KEY FK_97A0ADA32ABEACD6');
        $this->addSql('ALTER TABLE ticket DROP FOREIGN KEY FK_97A0ADA3A76ED395');
        $this->addSql('ALTER TABLE ticket CHANGE match_id match_id INT NOT NULL, CHANGE user_id user_id INT NOT NULL');
        $this->addSql('ALTER TABLE ticket ADD CONSTRAINT fk_ticket_match FOREIGN KEY (match_id) REFERENCES matchtb (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ticket ADD CONSTRAINT fk_ticket_user FOREIGN KEY (user_id) REFERENCES users (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE users CHANGE password password VARCHAR(30) NOT NULL, CHANGE repeatPassword repeatPassword VARCHAR(30) NOT NULL, CHANGE typeUser typeUser VARCHAR(7) NOT NULL, CHANGE username nom VARCHAR(20) NOT NULL');
    }
}
