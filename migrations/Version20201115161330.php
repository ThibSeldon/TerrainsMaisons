<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201115161330 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE house ADD type VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE house ADD living_space DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE house ADD annex_surface DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('ALTER TABLE house ADD room_number INT NOT NULL');
        $this->addSql('ALTER TABLE house ADD bathroom_number INT NOT NULL');
        $this->addSql('ALTER TABLE house ADD selling_price_df DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE house ADD created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL');
        $this->addSql('ALTER TABLE house ADD updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL');
        $this->addSql('ALTER TABLE house ADD brand VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE house ADD roofing VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE house ADD length DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('ALTER TABLE house ADD width DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('ALTER TABLE house ADD height DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_67D5399D5E237E06 ON house (name)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP INDEX UNIQ_67D5399D5E237E06');
        $this->addSql('ALTER TABLE house DROP type');
        $this->addSql('ALTER TABLE house DROP living_space');
        $this->addSql('ALTER TABLE house DROP annex_surface');
        $this->addSql('ALTER TABLE house DROP room_number');
        $this->addSql('ALTER TABLE house DROP bathroom_number');
        $this->addSql('ALTER TABLE house DROP selling_price_df');
        $this->addSql('ALTER TABLE house DROP created_at');
        $this->addSql('ALTER TABLE house DROP updated_at');
        $this->addSql('ALTER TABLE house DROP brand');
        $this->addSql('ALTER TABLE house DROP roofing');
        $this->addSql('ALTER TABLE house DROP length');
        $this->addSql('ALTER TABLE house DROP width');
        $this->addSql('ALTER TABLE house DROP height');
    }
}
