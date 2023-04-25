<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230424183157 extends AbstractMigration
{
    public function getDescription(): string
    {
        return ''; 
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX `primary` ON event');
        $this->addSql('ALTER TABLE event DROP id');
        $this->addSql('ALTER TABLE event ADD PRIMARY KEY (nom_event)');
        $this->addSql('DROP INDEX `primary` ON salle');
        $this->addSql('ALTER TABLE salle DROP id');
        $this->addSql('ALTER TABLE salle ADD PRIMARY KEY (nbre_salle)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX `PRIMARY` ON event');
        $this->addSql('ALTER TABLE event ADD id INT NOT NULL');
        $this->addSql('ALTER TABLE event ADD PRIMARY KEY (id)');
        $this->addSql('DROP INDEX `PRIMARY` ON salle');
        $this->addSql('ALTER TABLE salle ADD id INT NOT NULL');
        $this->addSql('ALTER TABLE salle ADD PRIMARY KEY (id)');
    }
}
