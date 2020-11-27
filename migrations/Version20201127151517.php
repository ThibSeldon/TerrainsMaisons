<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201127151517 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE allotment_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE plot_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE allotment (id INT NOT NULL, name VARCHAR(255) NOT NULL, postal_code INT NOT NULL, city VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE plot (id INT NOT NULL, allotment_id INT NOT NULL, lot INT NOT NULL, surface DOUBLE PRECISION NOT NULL, facade_width DOUBLE PRECISION DEFAULT NULL, selling_price_ati DOUBLE PRECISION NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_BEBB8F891BF0861F ON plot (allotment_id)');
        $this->addSql('ALTER TABLE plot ADD CONSTRAINT FK_BEBB8F891BF0861F FOREIGN KEY (allotment_id) REFERENCES allotment (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE plot DROP CONSTRAINT FK_BEBB8F891BF0861F');
        $this->addSql('DROP SEQUENCE allotment_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE plot_id_seq CASCADE');
        $this->addSql('DROP TABLE allotment');
        $this->addSql('DROP TABLE plot');
    }
}
