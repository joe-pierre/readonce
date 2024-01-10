<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240110112725 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add uuid field to readeonce_message table';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__readonce_message AS SELECT id, email, message, created_at, updated_at FROM readonce_message');
        $this->addSql('DROP TABLE readonce_message');
        $this->addSql('CREATE TABLE readonce_message (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, email VARCHAR(255) NOT NULL, message CLOB NOT NULL, created_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , updated_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , uuid BLOB NOT NULL --(DC2Type:uuid)
        )');
        $this->addSql('INSERT INTO readonce_message (id, email, message, created_at, updated_at) SELECT id, email, message, created_at, updated_at FROM __temp__readonce_message');
        $this->addSql('DROP TABLE __temp__readonce_message');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C9CBC364D17F50A6 ON readonce_message (uuid)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__readonce_message AS SELECT id, email, message, created_at, updated_at FROM readonce_message');
        $this->addSql('DROP TABLE readonce_message');
        $this->addSql('CREATE TABLE readonce_message (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, email VARCHAR(255) NOT NULL, message VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , updated_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        )');
        $this->addSql('INSERT INTO readonce_message (id, email, message, created_at, updated_at) SELECT id, email, message, created_at, updated_at FROM __temp__readonce_message');
        $this->addSql('DROP TABLE __temp__readonce_message');
    }
}
