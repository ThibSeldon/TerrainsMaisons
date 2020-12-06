<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201206161634 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE state_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE state (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE plot ADD state_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE plot ADD CONSTRAINT FK_BEBB8F895D83CC1 FOREIGN KEY (state_id) REFERENCES state (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_BEBB8F895D83CC1 ON plot (state_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE plot DROP CONSTRAINT FK_BEBB8F895D83CC1');
        $this->addSql('DROP SEQUENCE state_id_seq CASCADE');
        $this->addSql('DROP TABLE state');
        $this->addSql('DROP INDEX IDX_BEBB8F895D83CC1');
        $this->addSql('ALTER TABLE plot DROP state_id');
    }
}
