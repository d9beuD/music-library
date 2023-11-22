<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231122101840 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE track_artist (track_id INTEGER NOT NULL, artist_id INTEGER NOT NULL, PRIMARY KEY(track_id, artist_id), CONSTRAINT FK_499B576E5ED23C43 FOREIGN KEY (track_id) REFERENCES track (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_499B576EB7970CF8 FOREIGN KEY (artist_id) REFERENCES artist (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_499B576E5ED23C43 ON track_artist (track_id)');
        $this->addSql('CREATE INDEX IDX_499B576EB7970CF8 ON track_artist (artist_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE track_artist');
    }
}
