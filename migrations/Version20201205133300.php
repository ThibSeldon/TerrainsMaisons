<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201205133300 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE house_picture');
        $this->addSql('ALTER TABLE picture ADD house_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE picture ADD CONSTRAINT FK_16DB4F896BB74515 FOREIGN KEY (house_id) REFERENCES house (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_16DB4F896BB74515 ON picture (house_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('CREATE TABLE house_picture (house_id INT NOT NULL, picture_id INT NOT NULL, PRIMARY KEY(house_id, picture_id))');
        $this->addSql('CREATE INDEX idx_820cc994ee45bdbf ON house_picture (picture_id)');
        $this->addSql('CREATE INDEX idx_820cc9946bb74515 ON house_picture (house_id)');
        $this->addSql('ALTER TABLE house_picture ADD CONSTRAINT fk_820cc9946bb74515 FOREIGN KEY (house_id) REFERENCES house (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE house_picture ADD CONSTRAINT fk_820cc994ee45bdbf FOREIGN KEY (picture_id) REFERENCES picture (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE picture DROP CONSTRAINT FK_16DB4F896BB74515');
        $this->addSql('DROP INDEX IDX_16DB4F896BB74515');
        $this->addSql('ALTER TABLE picture DROP house_id');
    }
}
