<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210114132005 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER SEQUENCE id INCREMENT BY 1');
        $this->addSql('ALTER TABLE plot_house_matching ADD slug VARCHAR(255)');
        $this->addSql("UPDATE plot_house_matching SET slug=CONCAT(LOWER(name), '-', selling_price_ati)");
        $this->addSql('ALTER TABLE plot_house_matching ALTER COLUMN slug SET NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER SEQUENCE id INCREMENT BY 1');
        $this->addSql('ALTER TABLE plot_house_matching DROP slug');
    }
}
