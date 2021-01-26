<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210126172441 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER SEQUENCE id INCREMENT BY 1');
        $this->addSql('CREATE SEQUENCE allotment_state_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE tag_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE allotment_tag (allotment_id INT NOT NULL, tag_id INT NOT NULL, PRIMARY KEY(allotment_id, tag_id))');
        $this->addSql('CREATE INDEX IDX_E54E22631BF0861F ON allotment_tag (allotment_id)');
        $this->addSql('CREATE INDEX IDX_E54E2263BAD26311 ON allotment_tag (tag_id)');
        $this->addSql('CREATE TABLE allotment_state (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE tag (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE allotment_tag ADD CONSTRAINT FK_E54E22631BF0861F FOREIGN KEY (allotment_id) REFERENCES allotment (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE allotment_tag ADD CONSTRAINT FK_E54E2263BAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE allotment ADD state_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE allotment ADD notary_fees DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('ALTER TABLE allotment ADD description TEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE allotment ADD CONSTRAINT FK_B8F53CB55D83CC1 FOREIGN KEY (state_id) REFERENCES allotment_state (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_B8F53CB55D83CC1 ON allotment (state_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE allotment DROP CONSTRAINT FK_B8F53CB55D83CC1');
        $this->addSql('ALTER TABLE allotment_tag DROP CONSTRAINT FK_E54E2263BAD26311');
        $this->addSql('ALTER SEQUENCE id INCREMENT BY 1');
        $this->addSql('DROP SEQUENCE allotment_state_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE tag_id_seq CASCADE');
        $this->addSql('DROP TABLE allotment_tag');
        $this->addSql('DROP TABLE allotment_state');
        $this->addSql('DROP TABLE tag');
        $this->addSql('DROP INDEX IDX_B8F53CB55D83CC1');
        $this->addSql('ALTER TABLE allotment DROP state_id');
        $this->addSql('ALTER TABLE allotment DROP notary_fees');
        $this->addSql('ALTER TABLE allotment DROP description');
    }
}
