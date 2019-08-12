<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190812195826 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TABLE about (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, heading VARCHAR(255) DEFAULT NULL, description CLOB NOT NULL, year DATE DEFAULT NULL, top BOOLEAN DEFAULT NULL)');
        $this->addSql('DROP INDEX IDX_E8E50A18ED3750EB');
        $this->addSql('CREATE TEMPORARY TABLE __temp__job_experience_role AS SELECT id, job_experience_id, title, description, start_date, end_date, location FROM job_experience_role');
        $this->addSql('DROP TABLE job_experience_role');
        $this->addSql('CREATE TABLE job_experience_role (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, job_experience_id INTEGER NOT NULL, title VARCHAR(255) NOT NULL COLLATE BINARY, description CLOB DEFAULT NULL COLLATE BINARY, start_date DATE NOT NULL, end_date DATE DEFAULT NULL, location VARCHAR(255) NOT NULL COLLATE BINARY, CONSTRAINT FK_E8E50A18ED3750EB FOREIGN KEY (job_experience_id) REFERENCES job_experience (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO job_experience_role (id, job_experience_id, title, description, start_date, end_date, location) SELECT id, job_experience_id, title, description, start_date, end_date, location FROM __temp__job_experience_role');
        $this->addSql('DROP TABLE __temp__job_experience_role');
        $this->addSql('CREATE INDEX IDX_E8E50A18ED3750EB ON job_experience_role (job_experience_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP TABLE about');
        $this->addSql('DROP INDEX IDX_E8E50A18ED3750EB');
        $this->addSql('CREATE TEMPORARY TABLE __temp__job_experience_role AS SELECT id, job_experience_id, title, description, start_date, end_date, location FROM job_experience_role');
        $this->addSql('DROP TABLE job_experience_role');
        $this->addSql('CREATE TABLE job_experience_role (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, job_experience_id INTEGER NOT NULL, title VARCHAR(255) NOT NULL, description CLOB DEFAULT NULL, start_date DATE NOT NULL, end_date DATE DEFAULT NULL, location VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO job_experience_role (id, job_experience_id, title, description, start_date, end_date, location) SELECT id, job_experience_id, title, description, start_date, end_date, location FROM __temp__job_experience_role');
        $this->addSql('DROP TABLE __temp__job_experience_role');
        $this->addSql('CREATE INDEX IDX_E8E50A18ED3750EB ON job_experience_role (job_experience_id)');
    }
}
