<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201201202621 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE contact_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE allotment_contact (allotment_id INT NOT NULL, contact_id INT NOT NULL, PRIMARY KEY(allotment_id, contact_id))');
        $this->addSql('CREATE INDEX IDX_AC17DBDF1BF0861F ON allotment_contact (allotment_id)');
        $this->addSql('CREATE INDEX IDX_AC17DBDFE7A1254A ON allotment_contact (contact_id)');
        $this->addSql('CREATE TABLE contact (id INT NOT NULL, society VARCHAR(255) DEFAULT NULL, first_name VARCHAR(255) DEFAULT NULL, last_name VARCHAR(255) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, phone_number VARCHAR(255) DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updtated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, note TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE allotment_contact ADD CONSTRAINT FK_AC17DBDF1BF0861F FOREIGN KEY (allotment_id) REFERENCES allotment (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE allotment_contact ADD CONSTRAINT FK_AC17DBDFE7A1254A FOREIGN KEY (contact_id) REFERENCES contact (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE allotment_contact DROP CONSTRAINT FK_AC17DBDFE7A1254A');
        $this->addSql('DROP SEQUENCE contact_id_seq CASCADE');
        $this->addSql('DROP TABLE allotment_contact');
        $this->addSql('DROP TABLE contact');
    }
}
