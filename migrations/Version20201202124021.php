<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201202124021 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE society_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE society (id INT NOT NULL, name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, phone_number VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE contact ADD society_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE contact DROP society');
        $this->addSql('ALTER TABLE contact ADD CONSTRAINT FK_4C62E638E6389D24 FOREIGN KEY (society_id) REFERENCES society (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_4C62E638E6389D24 ON contact (society_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE contact DROP CONSTRAINT FK_4C62E638E6389D24');
        $this->addSql('DROP SEQUENCE society_id_seq CASCADE');
        $this->addSql('DROP TABLE society');
        $this->addSql('DROP INDEX IDX_4C62E638E6389D24');
        $this->addSql('ALTER TABLE contact ADD society VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE contact DROP society_id');
    }
}
