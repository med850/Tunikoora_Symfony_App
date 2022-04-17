<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220411173446 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
       


        // this down() migration is auto-generated, please modify it to your needs
       // $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E66A76ED395');
      
        $this->addSql('ALTER TABLE users CHANGE roles roles JSON NOT NULL');

    }

    public function down(Schema $schema): void
    {




         // this up() migration is auto-generated, please modify it to your needs
         

         $this->addSql('ALTER TABLE users CHANGE roles roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\'');

    }
}
