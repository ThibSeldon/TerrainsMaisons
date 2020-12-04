<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201204092549 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE house_style_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE house_style (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE house ADD house_style_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE house ADD CONSTRAINT FK_67D5399DD95FDB2B FOREIGN KEY (house_style_id) REFERENCES house_style (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_67D5399DD95FDB2B ON house (house_style_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE house DROP CONSTRAINT FK_67D5399DD95FDB2B');
        $this->addSql('DROP SEQUENCE house_style_id_seq CASCADE');
        $this->addSql('DROP TABLE house_style');
        $this->addSql('DROP INDEX IDX_67D5399DD95FDB2B');
        $this->addSql('ALTER TABLE house DROP house_style_id');
    }
}
