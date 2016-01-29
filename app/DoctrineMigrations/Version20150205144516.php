<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20150205144516 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');
        
        $this->addSql('ALTER TABLE locations_sports CHANGE locations_id locations_id INT DEFAULT NULL, CHANGE sports_id sports_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE locations_sports ADD CONSTRAINT FK_CA667A22ED775E23 FOREIGN KEY (locations_id) REFERENCES locations (id)');
        $this->addSql('ALTER TABLE locations_sports ADD CONSTRAINT FK_CA667A2254BBBFB7 FOREIGN KEY (sports_id) REFERENCES sports (id)');
        $this->addSql('CREATE INDEX IDX_CA667A22ED775E23 ON locations_sports (locations_id)');
        $this->addSql('CREATE INDEX IDX_CA667A2254BBBFB7 ON locations_sports (sports_id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');
        
        $this->addSql('ALTER TABLE locations_sports DROP FOREIGN KEY FK_CA667A22ED775E23');
        $this->addSql('ALTER TABLE locations_sports DROP FOREIGN KEY FK_CA667A2254BBBFB7');
        $this->addSql('DROP INDEX IDX_CA667A22ED775E23 ON locations_sports');
        $this->addSql('DROP INDEX IDX_CA667A2254BBBFB7 ON locations_sports');
        $this->addSql('ALTER TABLE locations_sports CHANGE locations_id locations_id INT NOT NULL, CHANGE sports_id sports_id INT NOT NULL');
    }
}
