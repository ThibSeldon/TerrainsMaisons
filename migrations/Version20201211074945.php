<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201211074945 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE allotment_house_roofing (allotment_id INT NOT NULL, house_roofing_id INT NOT NULL, PRIMARY KEY(allotment_id, house_roofing_id))');
        $this->addSql('CREATE INDEX IDX_469CF8D31BF0861F ON allotment_house_roofing (allotment_id)');
        $this->addSql('CREATE INDEX IDX_469CF8D324D9B445 ON allotment_house_roofing (house_roofing_id)');
        $this->addSql('ALTER TABLE allotment_house_roofing ADD CONSTRAINT FK_469CF8D31BF0861F FOREIGN KEY (allotment_id) REFERENCES allotment (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE allotment_house_roofing ADD CONSTRAINT FK_469CF8D324D9B445 FOREIGN KEY (house_roofing_id) REFERENCES house_roofing (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP TABLE allotment_house_roofing');
    }
}
