<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220111153139 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE allotment_id INCREMENT BY 1 MINVALUE 1000 START 1000');
        $this->addSql('CREATE SEQUENCE allotment_state_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE contact_id INCREMENT BY 1 MINVALUE 1000 START 1000');
        $this->addSql('CREATE SEQUENCE id INCREMENT BY 1 MINVALUE 1000 START 1000');
        $this->addSql('CREATE SEQUENCE house_brand_id INCREMENT BY 1 MINVALUE 1000 START 1000');
        $this->addSql('CREATE SEQUENCE house_model_id INCREMENT BY 1 MINVALUE 1000 START 1000');
        $this->addSql('CREATE SEQUENCE house_roofing_id INCREMENT BY 1 MINVALUE 1000 START 1000');
        $this->addSql('CREATE SEQUENCE house_style_id INCREMENT BY 1 MINVALUE 1000 START 1000');
        $this->addSql('CREATE SEQUENCE picture_id INCREMENT BY 1 MINVALUE 1000 START 1000');
        $this->addSql('CREATE SEQUENCE plot_id INCREMENT BY 1 MINVALUE 1000 START 1000');
        $this->addSql('CREATE SEQUENCE plot_house_matching_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE sanitation_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE society_id INCREMENT BY 1 MINVALUE 1000 START 1000');
        $this->addSql('CREATE SEQUENCE state_id INCREMENT BY 1 MINVALUE 1000 START 1000');
        $this->addSql('CREATE SEQUENCE tag_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE user_id INCREMENT BY 1 MINVALUE 1000 START 1000');
        $this->addSql('CREATE TABLE allotment (id INT NOT NULL, state_id INT DEFAULT NULL, sanitation_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, postal_code VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, property_limit DOUBLE PRECISION DEFAULT NULL, double_limit BOOLEAN NOT NULL, local_urban_plan_file VARCHAR(255) DEFAULT NULL, regulation_file VARCHAR(255) DEFAULT NULL, is_valid BOOLEAN NOT NULL, allotment_plan_file VARCHAR(255) DEFAULT NULL, notary_fees DOUBLE PRECISION DEFAULT NULL, description TEXT DEFAULT NULL, slug VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B8F53CB5989D9B62 ON allotment (slug)');
        $this->addSql('CREATE INDEX IDX_B8F53CB55D83CC1 ON allotment (state_id)');
        $this->addSql('CREATE INDEX IDX_B8F53CB54BA400F3 ON allotment (sanitation_id)');
        $this->addSql('CREATE TABLE allotment_contact (allotment_id INT NOT NULL, contact_id INT NOT NULL, PRIMARY KEY(allotment_id, contact_id))');
        $this->addSql('CREATE INDEX IDX_AC17DBDF1BF0861F ON allotment_contact (allotment_id)');
        $this->addSql('CREATE INDEX IDX_AC17DBDFE7A1254A ON allotment_contact (contact_id)');
        $this->addSql('CREATE TABLE allotment_house_roofing (allotment_id INT NOT NULL, house_roofing_id INT NOT NULL, PRIMARY KEY(allotment_id, house_roofing_id))');
        $this->addSql('CREATE INDEX IDX_469CF8D31BF0861F ON allotment_house_roofing (allotment_id)');
        $this->addSql('CREATE INDEX IDX_469CF8D324D9B445 ON allotment_house_roofing (house_roofing_id)');
        $this->addSql('CREATE TABLE allotment_tag (allotment_id INT NOT NULL, tag_id INT NOT NULL, PRIMARY KEY(allotment_id, tag_id))');
        $this->addSql('CREATE INDEX IDX_E54E22631BF0861F ON allotment_tag (allotment_id)');
        $this->addSql('CREATE INDEX IDX_E54E2263BAD26311 ON allotment_tag (tag_id)');
        $this->addSql('CREATE TABLE allotment_state (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE contact (id INT NOT NULL, society_id INT DEFAULT NULL, first_name VARCHAR(255) DEFAULT NULL, last_name VARCHAR(255) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, phone_number VARCHAR(255) DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updtated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, note TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_4C62E638E6389D24 ON contact (society_id)');
        $this->addSql('CREATE TABLE house (id INT NOT NULL, house_roofing_id INT DEFAULT NULL, house_brand_id INT DEFAULT NULL, house_model_id INT DEFAULT NULL, house_style_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, living_space DOUBLE PRECISION NOT NULL, annex_surface DOUBLE PRECISION DEFAULT NULL, room_number INT NOT NULL, bathroom_number INT NOT NULL, selling_price_df DOUBLE PRECISION NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, length DOUBLE PRECISION DEFAULT NULL, width DOUBLE PRECISION DEFAULT NULL, height DOUBLE PRECISION DEFAULT NULL, selling_price_ati DOUBLE PRECISION DEFAULT NULL, valid BOOLEAN NOT NULL, plan_filename VARCHAR(255) DEFAULT NULL, slug VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_67D5399D5E237E06 ON house (name)');
        $this->addSql('CREATE INDEX IDX_67D5399D24D9B445 ON house (house_roofing_id)');
        $this->addSql('CREATE INDEX IDX_67D5399D27676B57 ON house (house_brand_id)');
        $this->addSql('CREATE INDEX IDX_67D5399D1AE70CB8 ON house (house_model_id)');
        $this->addSql('CREATE INDEX IDX_67D5399DD95FDB2B ON house (house_style_id)');
        $this->addSql('CREATE TABLE house_brand (id INT NOT NULL, name VARCHAR(255) NOT NULL, url VARCHAR(255) DEFAULT NULL, logo VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE house_model (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE house_roofing (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE house_style (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE picture (id INT NOT NULL, house_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_16DB4F896BB74515 ON picture (house_id)');
        $this->addSql('CREATE TABLE plot (id INT NOT NULL, allotment_id INT NOT NULL, state_id INT DEFAULT NULL, lot VARCHAR(255) NOT NULL, surface DOUBLE PRECISION NOT NULL, facade_width DOUBLE PRECISION DEFAULT NULL, selling_price_ati DOUBLE PRECISION NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, sales_plan VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_BEBB8F891BF0861F ON plot (allotment_id)');
        $this->addSql('CREATE INDEX IDX_BEBB8F895D83CC1 ON plot (state_id)');
        $this->addSql('CREATE TABLE plot_house_matching (id INT NOT NULL, house_id INT NOT NULL, plot_id INT NOT NULL, name VARCHAR(255) NOT NULL, selling_price_ati INT NOT NULL, valid BOOLEAN NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, slug VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_53EC55F86BB74515 ON plot_house_matching (house_id)');
        $this->addSql('CREATE INDEX IDX_53EC55F8680D0B01 ON plot_house_matching (plot_id)');
        $this->addSql('CREATE TABLE sanitation (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE society (id INT NOT NULL, name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, phone_number VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE state (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE tag (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE "user" (id INT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, first_name VARCHAR(255) DEFAULT NULL, last_name VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON "user" (email)');
        $this->addSql('ALTER TABLE allotment ADD CONSTRAINT FK_B8F53CB55D83CC1 FOREIGN KEY (state_id) REFERENCES allotment_state (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE allotment ADD CONSTRAINT FK_B8F53CB54BA400F3 FOREIGN KEY (sanitation_id) REFERENCES sanitation (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE allotment_contact ADD CONSTRAINT FK_AC17DBDF1BF0861F FOREIGN KEY (allotment_id) REFERENCES allotment (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE allotment_contact ADD CONSTRAINT FK_AC17DBDFE7A1254A FOREIGN KEY (contact_id) REFERENCES contact (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE allotment_house_roofing ADD CONSTRAINT FK_469CF8D31BF0861F FOREIGN KEY (allotment_id) REFERENCES allotment (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE allotment_house_roofing ADD CONSTRAINT FK_469CF8D324D9B445 FOREIGN KEY (house_roofing_id) REFERENCES house_roofing (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE allotment_tag ADD CONSTRAINT FK_E54E22631BF0861F FOREIGN KEY (allotment_id) REFERENCES allotment (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE allotment_tag ADD CONSTRAINT FK_E54E2263BAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE contact ADD CONSTRAINT FK_4C62E638E6389D24 FOREIGN KEY (society_id) REFERENCES society (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE house ADD CONSTRAINT FK_67D5399D24D9B445 FOREIGN KEY (house_roofing_id) REFERENCES house_roofing (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE house ADD CONSTRAINT FK_67D5399D27676B57 FOREIGN KEY (house_brand_id) REFERENCES house_brand (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE house ADD CONSTRAINT FK_67D5399D1AE70CB8 FOREIGN KEY (house_model_id) REFERENCES house_model (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE house ADD CONSTRAINT FK_67D5399DD95FDB2B FOREIGN KEY (house_style_id) REFERENCES house_style (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE picture ADD CONSTRAINT FK_16DB4F896BB74515 FOREIGN KEY (house_id) REFERENCES house (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE plot ADD CONSTRAINT FK_BEBB8F891BF0861F FOREIGN KEY (allotment_id) REFERENCES allotment (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE plot ADD CONSTRAINT FK_BEBB8F895D83CC1 FOREIGN KEY (state_id) REFERENCES state (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE plot_house_matching ADD CONSTRAINT FK_53EC55F86BB74515 FOREIGN KEY (house_id) REFERENCES house (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE plot_house_matching ADD CONSTRAINT FK_53EC55F8680D0B01 FOREIGN KEY (plot_id) REFERENCES plot (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE allotment_contact DROP CONSTRAINT FK_AC17DBDF1BF0861F');
        $this->addSql('ALTER TABLE allotment_house_roofing DROP CONSTRAINT FK_469CF8D31BF0861F');
        $this->addSql('ALTER TABLE allotment_tag DROP CONSTRAINT FK_E54E22631BF0861F');
        $this->addSql('ALTER TABLE plot DROP CONSTRAINT FK_BEBB8F891BF0861F');
        $this->addSql('ALTER TABLE allotment DROP CONSTRAINT FK_B8F53CB55D83CC1');
        $this->addSql('ALTER TABLE allotment_contact DROP CONSTRAINT FK_AC17DBDFE7A1254A');
        $this->addSql('ALTER TABLE picture DROP CONSTRAINT FK_16DB4F896BB74515');
        $this->addSql('ALTER TABLE plot_house_matching DROP CONSTRAINT FK_53EC55F86BB74515');
        $this->addSql('ALTER TABLE house DROP CONSTRAINT FK_67D5399D27676B57');
        $this->addSql('ALTER TABLE house DROP CONSTRAINT FK_67D5399D1AE70CB8');
        $this->addSql('ALTER TABLE allotment_house_roofing DROP CONSTRAINT FK_469CF8D324D9B445');
        $this->addSql('ALTER TABLE house DROP CONSTRAINT FK_67D5399D24D9B445');
        $this->addSql('ALTER TABLE house DROP CONSTRAINT FK_67D5399DD95FDB2B');
        $this->addSql('ALTER TABLE plot_house_matching DROP CONSTRAINT FK_53EC55F8680D0B01');
        $this->addSql('ALTER TABLE allotment DROP CONSTRAINT FK_B8F53CB54BA400F3');
        $this->addSql('ALTER TABLE contact DROP CONSTRAINT FK_4C62E638E6389D24');
        $this->addSql('ALTER TABLE plot DROP CONSTRAINT FK_BEBB8F895D83CC1');
        $this->addSql('ALTER TABLE allotment_tag DROP CONSTRAINT FK_E54E2263BAD26311');
        $this->addSql('DROP SEQUENCE allotment_id CASCADE');
        $this->addSql('DROP SEQUENCE allotment_state_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE contact_id CASCADE');
        $this->addSql('DROP SEQUENCE id CASCADE');
        $this->addSql('DROP SEQUENCE house_brand_id CASCADE');
        $this->addSql('DROP SEQUENCE house_model_id CASCADE');
        $this->addSql('DROP SEQUENCE house_roofing_id CASCADE');
        $this->addSql('DROP SEQUENCE house_style_id CASCADE');
        $this->addSql('DROP SEQUENCE picture_id CASCADE');
        $this->addSql('DROP SEQUENCE plot_id CASCADE');
        $this->addSql('DROP SEQUENCE plot_house_matching_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE sanitation_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE society_id CASCADE');
        $this->addSql('DROP SEQUENCE state_id CASCADE');
        $this->addSql('DROP SEQUENCE tag_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE user_id CASCADE');
        $this->addSql('DROP TABLE allotment');
        $this->addSql('DROP TABLE allotment_contact');
        $this->addSql('DROP TABLE allotment_house_roofing');
        $this->addSql('DROP TABLE allotment_tag');
        $this->addSql('DROP TABLE allotment_state');
        $this->addSql('DROP TABLE contact');
        $this->addSql('DROP TABLE house');
        $this->addSql('DROP TABLE house_brand');
        $this->addSql('DROP TABLE house_model');
        $this->addSql('DROP TABLE house_roofing');
        $this->addSql('DROP TABLE house_style');
        $this->addSql('DROP TABLE picture');
        $this->addSql('DROP TABLE plot');
        $this->addSql('DROP TABLE plot_house_matching');
        $this->addSql('DROP TABLE sanitation');
        $this->addSql('DROP TABLE society');
        $this->addSql('DROP TABLE state');
        $this->addSql('DROP TABLE tag');
        $this->addSql('DROP TABLE "user"');
    }
}
