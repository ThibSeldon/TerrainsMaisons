<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201202153707 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE picture_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE house_picture (house_id INT NOT NULL, picture_id INT NOT NULL, PRIMARY KEY(house_id, picture_id))');
        $this->addSql('CREATE INDEX IDX_820CC9946BB74515 ON house_picture (house_id)');
        $this->addSql('CREATE INDEX IDX_820CC994EE45BDBF ON house_picture (picture_id)');
        $this->addSql('CREATE TABLE picture (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE house_picture ADD CONSTRAINT FK_820CC9946BB74515 FOREIGN KEY (house_id) REFERENCES house (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE house_picture ADD CONSTRAINT FK_820CC994EE45BDBF FOREIGN KEY (picture_id) REFERENCES picture (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE house_picture DROP CONSTRAINT FK_820CC994EE45BDBF');
        $this->addSql('DROP SEQUENCE picture_id_seq CASCADE');
        $this->addSql('DROP TABLE house_picture');
        $this->addSql('DROP TABLE picture');
    }
}
