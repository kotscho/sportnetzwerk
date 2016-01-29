<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20150305151012 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');
        
        $this->addSql('ALTER TABLE player_sports_skills ADD player_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE player_sports_skills ADD CONSTRAINT FK_F68EB6F499E6F5DF FOREIGN KEY (player_id) REFERENCES player (id)');
        $this->addSql('CREATE INDEX IDX_F68EB6F499E6F5DF ON player_sports_skills (player_id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');
        
        $this->addSql('ALTER TABLE player_sports_skills DROP FOREIGN KEY FK_F68EB6F499E6F5DF');
        $this->addSql('DROP INDEX IDX_F68EB6F499E6F5DF ON player_sports_skills');
        $this->addSql('ALTER TABLE player_sports_skills DROP player_id');
    }
}
