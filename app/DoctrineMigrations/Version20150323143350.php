<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20150323143350 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');
        
        $this->addSql('CREATE TABLE player_events (id INT AUTO_INCREMENT NOT NULL, player INT DEFAULT NULL, event INT DEFAULT NULL, INDEX IDX_CC87C19498197A65 (player), INDEX IDX_CC87C1943BAE0AA7 (event), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE player_events ADD CONSTRAINT FK_CC87C19498197A65 FOREIGN KEY (player) REFERENCES player (id)');
        $this->addSql('ALTER TABLE player_events ADD CONSTRAINT FK_CC87C1943BAE0AA7 FOREIGN KEY (event) REFERENCES events (id)');
        $this->addSql('ALTER TABLE events ADD initiator INT NOT NULL');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');
        
        $this->addSql('DROP TABLE player_events');
        $this->addSql('ALTER TABLE events DROP initiator');
    }
}
