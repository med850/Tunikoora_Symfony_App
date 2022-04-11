<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220403124312 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE dislike RENAME INDEX fk_fe3becaa7294869c TO fk_dislike_article');
        $this->addSql('ALTER TABLE dislike RENAME INDEX fk_fe3becaaa76ed395 TO fk_user_dislike');
        $this->addSql('ALTER TABLE likes RENAME INDEX fk_49ca4e7d7294869c TO fk_like_article');
        $this->addSql('ALTER TABLE likes RENAME INDEX fk_49ca4e7da76ed395 TO fk_user_like');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE dislike RENAME INDEX fk_dislike_article TO FK_FE3BECAA7294869C');
        $this->addSql('ALTER TABLE dislike RENAME INDEX fk_user_dislike TO FK_FE3BECAAA76ED395');
        $this->addSql('ALTER TABLE likes RENAME INDEX fk_like_article TO FK_49CA4E7D7294869C');
        $this->addSql('ALTER TABLE likes RENAME INDEX fk_user_like TO FK_49CA4E7DA76ED395');
    }
}
