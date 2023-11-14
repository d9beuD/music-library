<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231114210941 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE album (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, artist_id INTEGER NOT NULL, title VARCHAR(255) NOT NULL, thumbnail VARCHAR(255) NOT NULL, release_date DATE NOT NULL, CONSTRAINT FK_39986E43B7970CF8 FOREIGN KEY (artist_id) REFERENCES artist (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_39986E43B7970CF8 ON album (artist_id)');
        $this->addSql('CREATE TABLE artist (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(40) NOT NULL, thumbnail VARCHAR(255) NOT NULL, bio CLOB NOT NULL)');
        $this->addSql('CREATE TABLE track (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, album_id INTEGER NOT NULL, title VARCHAR(255) NOT NULL, duration INTEGER NOT NULL, CONSTRAINT FK_D6E3F8A61137ABCF FOREIGN KEY (album_id) REFERENCES album (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_D6E3F8A61137ABCF ON track (album_id)');
        $this->addSql('CREATE TABLE messenger_messages (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, body CLOB NOT NULL, headers CLOB NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , available_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , delivered_at DATETIME DEFAULT NULL --(DC2Type:datetime_immutable)
        )');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE album');
        $this->addSql('DROP TABLE artist');
        $this->addSql('DROP TABLE track');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
