<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210105153241 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER SEQUENCE id INCREMENT BY 1');
        $this->addSql('CREATE SEQUENCE plot_house_matching_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE plot_house_matching (id INT NOT NULL, house_id INT NOT NULL, plot_id INT NOT NULL, name VARCHAR(255) NOT NULL, selling_price_ati INT NOT NULL, valid BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_53EC55F86BB74515 ON plot_house_matching (house_id)');
        $this->addSql('CREATE INDEX IDX_53EC55F8680D0B01 ON plot_house_matching (plot_id)');
        $this->addSql('ALTER TABLE plot_house_matching ADD CONSTRAINT FK_53EC55F86BB74515 FOREIGN KEY (house_id) REFERENCES house (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE plot_house_matching ADD CONSTRAINT FK_53EC55F8680D0B01 FOREIGN KEY (plot_id) REFERENCES plot (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER SEQUENCE id INCREMENT BY 1');
        $this->addSql('DROP SEQUENCE plot_house_matching_id_seq CASCADE');
        $this->addSql('DROP TABLE plot_house_matching');
    }
}
