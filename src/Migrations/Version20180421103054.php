<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180421103054 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TABLE apartment (id INTEGER NOT NULL, name VARCHAR(255) NOT NULL, move_in_date DATETIME NOT NULL, street VARCHAR(255) NOT NULL, post_code INTEGER NOT NULL, town VARCHAR(255) NOT NULL, country VARCHAR(255) NOT NULL, contact_email VARCHAR(255) NOT NULL, user_id INTEGER NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE users (id INTEGER NOT NULL, name VARCHAR(255) NOT NULL, contact_number INTEGER NOT NULL, contact_email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP TABLE apartment');
        $this->addSql('DROP TABLE users');
    }
}
