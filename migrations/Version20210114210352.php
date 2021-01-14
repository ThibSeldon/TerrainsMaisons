<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210114210352 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER SEQUENCE id INCREMENT BY 1');
        $this->addSql('ALTER TABLE house ADD slug VARCHAR(255)');
        $this->addSql("UPDATE house SET slug=(LOWER(name))");
        $this->addSql('ALTER TABLE house ALTER COLUMN slug SET NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER SEQUENCE id INCREMENT BY 1');
        $this->addSql('ALTER TABLE house DROP slug');
    }
}
