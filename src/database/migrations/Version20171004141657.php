<?php

namespace Database\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema as Schema;

class Version20171004141657 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE clients (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', name VARCHAR(255) NOT NULL, createdAt DATETIME NOT NULL, updatedAt DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE projects (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', clientId CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, createdAt DATETIME NOT NULL, updatedAt DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE project_owners (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', forename VARCHAR(255) NOT NULL, surname VARCHAR(255) NOT NULL, createdAt DATETIME NOT NULL, updatedAt DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE projects_has_project_owners (project_id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', project_owner_id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', INDEX IDX_981F3C71166D1F9C (project_id), INDEX IDX_981F3C714372EA22 (project_owner_id), PRIMARY KEY(project_id, project_owner_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE projects_has_project_owners ADD CONSTRAINT FK_981F3C71166D1F9C FOREIGN KEY (project_id) REFERENCES project_owners (id)');
        $this->addSql('ALTER TABLE projects_has_project_owners ADD CONSTRAINT FK_981F3C714372EA22 FOREIGN KEY (project_owner_id) REFERENCES projects (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE projects_has_project_owners DROP FOREIGN KEY FK_981F3C714372EA22');
        $this->addSql('ALTER TABLE projects_has_project_owners DROP FOREIGN KEY FK_981F3C71166D1F9C');
        $this->addSql('DROP TABLE clients');
        $this->addSql('DROP TABLE projects');
        $this->addSql('DROP TABLE project_owners');
        $this->addSql('DROP TABLE projects_has_project_owners');
    }
}
