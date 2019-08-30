<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190830102201 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TABLE setting (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, category VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, value CLOB NOT NULL --(DC2Type:json)
        )');
        $this->addSql('DROP INDEX IDX_E8E50A18ED3750EB');
        $this->addSql('CREATE TEMPORARY TABLE __temp__job_experience_role AS SELECT id, job_experience_id, title, description, start_date, end_date, location FROM job_experience_role');
        $this->addSql('DROP TABLE job_experience_role');
        $this->addSql('CREATE TABLE job_experience_role (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, job_experience_id INTEGER NOT NULL, title VARCHAR(255) NOT NULL COLLATE BINARY, description CLOB DEFAULT NULL COLLATE BINARY, start_date DATE NOT NULL, end_date DATE DEFAULT NULL, location VARCHAR(255) NOT NULL COLLATE BINARY, CONSTRAINT FK_E8E50A18ED3750EB FOREIGN KEY (job_experience_id) REFERENCES job_experience (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO job_experience_role (id, job_experience_id, title, description, start_date, end_date, location) SELECT id, job_experience_id, title, description, start_date, end_date, location FROM __temp__job_experience_role');
        $this->addSql('DROP TABLE __temp__job_experience_role');
        $this->addSql('CREATE INDEX IDX_E8E50A18ED3750EB ON job_experience_role (job_experience_id)');
        $this->addSql('DROP INDEX IDX_C0E0E4ED087DB59');
        $this->addSql('CREATE TEMPORARY TABLE __temp__about_item AS SELECT id, about_id, year, header, content FROM about_item');
        $this->addSql('DROP TABLE about_item');
        $this->addSql('CREATE TABLE about_item (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, about_id INTEGER NOT NULL, year DATETIME NOT NULL, header VARCHAR(255) NOT NULL COLLATE BINARY, content CLOB NOT NULL COLLATE BINARY, CONSTRAINT FK_C0E0E4ED087DB59 FOREIGN KEY (about_id) REFERENCES about (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO about_item (id, about_id, year, header, content) SELECT id, about_id, year, header, content FROM __temp__about_item');
        $this->addSql('DROP TABLE __temp__about_item');
        $this->addSql('CREATE INDEX IDX_C0E0E4ED087DB59 ON about_item (about_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP TABLE setting');
        $this->addSql('DROP INDEX IDX_C0E0E4ED087DB59');
        $this->addSql('CREATE TEMPORARY TABLE __temp__about_item AS SELECT id, about_id, year, header, content FROM about_item');
        $this->addSql('DROP TABLE about_item');
        $this->addSql('CREATE TABLE about_item (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, about_id INTEGER NOT NULL, year DATETIME NOT NULL, header VARCHAR(255) NOT NULL, content CLOB NOT NULL)');
        $this->addSql('INSERT INTO about_item (id, about_id, year, header, content) SELECT id, about_id, year, header, content FROM __temp__about_item');
        $this->addSql('DROP TABLE __temp__about_item');
        $this->addSql('CREATE INDEX IDX_C0E0E4ED087DB59 ON about_item (about_id)');
        $this->addSql('DROP INDEX IDX_E8E50A18ED3750EB');
        $this->addSql('CREATE TEMPORARY TABLE __temp__job_experience_role AS SELECT id, job_experience_id, title, description, start_date, end_date, location FROM job_experience_role');
        $this->addSql('DROP TABLE job_experience_role');
        $this->addSql('CREATE TABLE job_experience_role (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, job_experience_id INTEGER NOT NULL, title VARCHAR(255) NOT NULL, description CLOB DEFAULT NULL, start_date DATE NOT NULL, end_date DATE DEFAULT NULL, location VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO job_experience_role (id, job_experience_id, title, description, start_date, end_date, location) SELECT id, job_experience_id, title, description, start_date, end_date, location FROM __temp__job_experience_role');
        $this->addSql('DROP TABLE __temp__job_experience_role');
        $this->addSql('CREATE INDEX IDX_E8E50A18ED3750EB ON job_experience_role (job_experience_id)');
    }
}
