<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201121083312 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE house_id_seq INCREMENT BY 1 MINVALUE 1 START 200');
        $this->addSql('CREATE SEQUENCE house_brand_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE house_model_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE house_roofing_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE "user_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE house (id INT NOT NULL, house_roofing_id INT DEFAULT NULL, house_brand_id INT DEFAULT NULL, house_model_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, living_space DOUBLE PRECISION NOT NULL, annex_surface DOUBLE PRECISION DEFAULT NULL, room_number INT NOT NULL, bathroom_number INT NOT NULL, selling_price_df DOUBLE PRECISION NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, length DOUBLE PRECISION DEFAULT NULL, width DOUBLE PRECISION DEFAULT NULL, height DOUBLE PRECISION DEFAULT NULL, selling_price_ati DOUBLE PRECISION DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_67D5399D5E237E06 ON house (name)');
        $this->addSql('CREATE INDEX IDX_67D5399D24D9B445 ON house (house_roofing_id)');
        $this->addSql('CREATE INDEX IDX_67D5399D27676B57 ON house (house_brand_id)');
        $this->addSql('CREATE INDEX IDX_67D5399D1AE70CB8 ON house (house_model_id)');
        $this->addSql('CREATE TABLE house_brand (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE house_model (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE house_roofing (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE "user" (id INT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON "user" (email)');
        $this->addSql('ALTER TABLE house ADD CONSTRAINT FK_67D5399D24D9B445 FOREIGN KEY (house_roofing_id) REFERENCES house_roofing (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE house ADD CONSTRAINT FK_67D5399D27676B57 FOREIGN KEY (house_brand_id) REFERENCES house_brand (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE house ADD CONSTRAINT FK_67D5399D1AE70CB8 FOREIGN KEY (house_model_id) REFERENCES house_model (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : voi
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE house DROP CONSTRAINT FK_67D5399D27676B57');
        $this->addSql('ALTER TABLE house DROP CONSTRAINT FK_67D5399D1AE70CB8');
        $this->addSql('ALTER TABLE house DROP CONSTRAINT FK_67D5399D24D9B445');
        $this->addSql('DROP SEQUENCE house_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE house_brand_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE house_model_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE house_roofing_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE "user_id_seq" CASCADE');
        $this->addSql('DROP TABLE house');
        $this->addSql('DROP TABLE house_brand');
        $this->addSql('DROP TABLE house_model');
        $this->addSql('DROP TABLE house_roofing');
        $this->addSql('DROP TABLE "user"');
    }
}
