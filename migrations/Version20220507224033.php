<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220507224033 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY fk_article_user');
        $this->addSql('ALTER TABLE article ADD image VARCHAR(300) NOT NULL, ADD date DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT fk_article_user FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE dislike DROP FOREIGN KEY fk_dislike_article');
        $this->addSql('ALTER TABLE dislike ADD CONSTRAINT fk_dislike_article FOREIGN KEY (article_id) REFERENCES article (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E66A76ED395');
        $this->addSql('ALTER TABLE article DROP image, DROP date');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT fk_article_user FOREIGN KEY (user_id) REFERENCES users (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE dislike DROP FOREIGN KEY FK_FE3BECAA7294869C');
        $this->addSql('ALTER TABLE dislike ADD CONSTRAINT fk_dislike_article FOREIGN KEY (article_id) REFERENCES article (id) ON UPDATE CASCADE ON DELETE CASCADE');
    }
}
