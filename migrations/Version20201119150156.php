<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201119150156 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE house DROP CONSTRAINT fk_67d5399d519b0a8e');
        $this->addSql('DROP SEQUENCE house_type_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE house_model_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE house_model (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('DROP TABLE house_type');
        $this->addSql('DROP INDEX idx_67d5399d519b0a8e');
        $this->addSql('ALTER TABLE house RENAME COLUMN house_type_id TO house_model_id');
        $this->addSql('ALTER TABLE house ADD CONSTRAINT FK_67D5399D1AE70CB8 FOREIGN KEY (house_model_id) REFERENCES house_model (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_67D5399D1AE70CB8 ON house (house_model_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE house DROP CONSTRAINT FK_67D5399D1AE70CB8');
        $this->addSql('DROP SEQUENCE house_model_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE house_type_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE house_type (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('DROP TABLE house_model');
        $this->addSql('DROP INDEX IDX_67D5399D1AE70CB8');
        $this->addSql('ALTER TABLE house RENAME COLUMN house_model_id TO house_type_id');
        $this->addSql('ALTER TABLE house ADD CONSTRAINT fk_67d5399d519b0a8e FOREIGN KEY (house_type_id) REFERENCES house_type (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_67d5399d519b0a8e ON house (house_type_id)');
    }
}
