<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180506192553 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP INDEX IDX_4D7E6854A76ED395');
        $this->addSql('CREATE TEMPORARY TABLE __temp__apartment AS SELECT id, user_id, move_in_date, street, post_code, town, country, contact_email FROM apartment');
        $this->addSql('DROP TABLE apartment');
        $this->addSql('CREATE TABLE apartment (id INTEGER NOT NULL, user_id INTEGER DEFAULT NULL, move_in_date DATETIME NOT NULL, street VARCHAR(255) NOT NULL COLLATE BINARY, post_code INTEGER NOT NULL, town VARCHAR(255) NOT NULL COLLATE BINARY, country VARCHAR(255) NOT NULL COLLATE BINARY, contact_email VARCHAR(255) NOT NULL COLLATE BINARY, PRIMARY KEY(id), CONSTRAINT FK_4D7E6854A76ED395 FOREIGN KEY (user_id) REFERENCES users (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO apartment (id, user_id, move_in_date, street, post_code, town, country, contact_email) SELECT id, user_id, move_in_date, street, post_code, town, country, contact_email FROM __temp__apartment');
        $this->addSql('DROP TABLE __temp__apartment');
        $this->addSql('CREATE INDEX IDX_4D7E6854A76ED395 ON apartment (user_id)');
        $this->addSql('ALTER TABLE users ADD COLUMN token CLOB DEFAULT NULL');
        $this->addSql('ALTER TABLE users ADD COLUMN role VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP INDEX IDX_4D7E6854A76ED395');
        $this->addSql('CREATE TEMPORARY TABLE __temp__apartment AS SELECT id, user_id, move_in_date, street, post_code, town, country, contact_email FROM apartment');
        $this->addSql('DROP TABLE apartment');
        $this->addSql('CREATE TABLE apartment (id INTEGER NOT NULL, user_id INTEGER DEFAULT NULL, move_in_date DATETIME NOT NULL, street VARCHAR(255) NOT NULL, post_code INTEGER NOT NULL, town VARCHAR(255) NOT NULL, country VARCHAR(255) NOT NULL, contact_email VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('INSERT INTO apartment (id, user_id, move_in_date, street, post_code, town, country, contact_email) SELECT id, user_id, move_in_date, street, post_code, town, country, contact_email FROM __temp__apartment');
        $this->addSql('DROP TABLE __temp__apartment');
        $this->addSql('CREATE INDEX IDX_4D7E6854A76ED395 ON apartment (user_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__users AS SELECT id, name, contact_number, contact_email, password FROM users');
        $this->addSql('DROP TABLE users');
        $this->addSql('CREATE TABLE users (id INTEGER NOT NULL, name VARCHAR(255) NOT NULL, contact_number INTEGER NOT NULL, contact_email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('INSERT INTO users (id, name, contact_number, contact_email, password) SELECT id, name, contact_number, contact_email, password FROM __temp__users');
        $this->addSql('DROP TABLE __temp__users');
    }
}
