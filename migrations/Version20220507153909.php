<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220507153909 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E66A76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE dislike ADD CONSTRAINT FK_FE3BECAA7294869C FOREIGN KEY (article_id) REFERENCES article (id)');
        $this->addSql('ALTER TABLE participation ADD longitude DOUBLE PRECISION DEFAULT NULL, ADD latitude DOUBLE PRECISION DEFAULT NULL, ADD date DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', CHANGE stade_id equipe_id2 INT DEFAULT NULL');
        $this->addSql('ALTER TABLE participation ADD CONSTRAINT FK_AB55E24F8EDC0392 FOREIGN KEY (equipe_id2) REFERENCES equipe (id)');
        $this->addSql('CREATE INDEX IDX_AB55E24F8EDC0392 ON participation (equipe_id2)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E66A76ED395');
        $this->addSql('ALTER TABLE dislike DROP FOREIGN KEY FK_FE3BECAA7294869C');
        $this->addSql('ALTER TABLE participation DROP FOREIGN KEY FK_AB55E24F8EDC0392');
        $this->addSql('DROP INDEX IDX_AB55E24F8EDC0392 ON participation');
        $this->addSql('ALTER TABLE participation DROP longitude, DROP latitude, DROP date, CHANGE equipe_id2 stade_id INT DEFAULT NULL');
    }
}
