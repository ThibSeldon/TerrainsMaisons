<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201119152329 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE house DROP type');
        $this->addSql('ALTER TABLE house DROP brand');
        $this->addSql('ALTER TABLE house DROP roofing');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE house ADD type VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE house ADD brand VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE house ADD roofing VARCHAR(255) DEFAULT NULL');
    }
}
