<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220111172157 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE house_id CASCADE');
        $this->addSql('CREATE SEQUENCE id INCREMENT BY 1 MINVALUE 1000 START 1000');
        $this->addSql('ALTER TABLE allotment ADD latitude DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('ALTER TABLE allotment ADD longitude DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('ALTER TABLE allotment ALTER name SET NOT NULL');
        $this->addSql('ALTER TABLE allotment ALTER postal_code SET NOT NULL');
        $this->addSql('ALTER TABLE allotment ALTER city SET NOT NULL');
        $this->addSql('ALTER TABLE allotment ALTER created_at SET NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE id CASCADE');
        $this->addSql('CREATE SEQUENCE house_id INCREMENT BY 1 MINVALUE 1000 START 1000');
        $this->addSql('ALTER TABLE allotment DROP latitude');
        $this->addSql('ALTER TABLE allotment DROP longitude');
        $this->addSql('ALTER TABLE allotment ALTER name DROP NOT NULL');
        $this->addSql('ALTER TABLE allotment ALTER postal_code DROP NOT NULL');
        $this->addSql('ALTER TABLE allotment ALTER city DROP NOT NULL');
        $this->addSql('ALTER TABLE allotment ALTER created_at DROP NOT NULL');
    }
}
