<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231116191114 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE album ADD COLUMN type SMALLINT NOT NULL DEFAULT 0');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__album AS SELECT id, artist_id, title, thumbnail, release_date FROM album');
        $this->addSql('DROP TABLE album');
        $this->addSql('CREATE TABLE album (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, artist_id INTEGER NOT NULL, title VARCHAR(255) NOT NULL, thumbnail VARCHAR(255) NOT NULL, release_date DATE NOT NULL, CONSTRAINT FK_39986E43B7970CF8 FOREIGN KEY (artist_id) REFERENCES artist (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO album (id, artist_id, title, thumbnail, release_date) SELECT id, artist_id, title, thumbnail, release_date FROM __temp__album');
        $this->addSql('DROP TABLE __temp__album');
        $this->addSql('CREATE INDEX IDX_39986E43B7970CF8 ON album (artist_id)');
    }
}
