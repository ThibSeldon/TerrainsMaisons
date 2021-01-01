<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210101193545 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER SEQUENCE id INCREMENT BY 1');
        $this->addSql('CREATE SEQUENCE allotment_id INCREMENT BY 1 MINVALUE 1000 START 1000');
        $this->addSql('CREATE SEQUENCE contact_id INCREMENT BY 1 MINVALUE 1000 START 1000');
        $this->addSql('CREATE SEQUENCE house_brand_id INCREMENT BY 1 MINVALUE 1000 START 1000');
        $this->addSql('CREATE SEQUENCE house_model_id INCREMENT BY 1 MINVALUE 1000 START 1000');
        $this->addSql('CREATE SEQUENCE house_roofing_id INCREMENT BY 1 MINVALUE 1000 START 1000');
        $this->addSql('CREATE SEQUENCE house_style_id INCREMENT BY 1 MINVALUE 1000 START 1000');
        $this->addSql('CREATE SEQUENCE picture_id INCREMENT BY 1 MINVALUE 1000 START 1000');
        $this->addSql('CREATE SEQUENCE plot_id INCREMENT BY 1 MINVALUE 1000 START 1000');
        $this->addSql('CREATE SEQUENCE society_id INCREMENT BY 1 MINVALUE 1000 START 1000');
        $this->addSql('CREATE SEQUENCE state_id INCREMENT BY 1 MINVALUE 1000 START 1000');
        $this->addSql('CREATE SEQUENCE user_id INCREMENT BY 1 MINVALUE 1000 START 1000');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER SEQUENCE id INCREMENT BY 1');
        $this->addSql('DROP SEQUENCE allotment_id CASCADE');
        $this->addSql('DROP SEQUENCE contact_id CASCADE');
        $this->addSql('DROP SEQUENCE house_brand_id CASCADE');
        $this->addSql('DROP SEQUENCE house_model_id CASCADE');
        $this->addSql('DROP SEQUENCE house_roofing_id CASCADE');
        $this->addSql('DROP SEQUENCE house_style_id CASCADE');
        $this->addSql('DROP SEQUENCE picture_id CASCADE');
        $this->addSql('DROP SEQUENCE plot_id CASCADE');
        $this->addSql('DROP SEQUENCE society_id CASCADE');
        $this->addSql('DROP SEQUENCE state_id CASCADE');
        $this->addSql('DROP SEQUENCE user_id CASCADE');
    }
}
