<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20150203171735 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');
        
        $this->addSql('ALTER TABLE locations_sports DROP FOREIGN KEY FK_CA667A2299BEF582');
        $this->addSql('ALTER TABLE locations_sports DROP FOREIGN KEY FK_CA667A22B613A921');
        $this->addSql('DROP INDEX IDX_CA667A22B613A921 ON locations_sports');
        $this->addSql('DROP INDEX IDX_CA667A2299BEF582 ON locations_sports');
        $this->addSql('ALTER TABLE locations_sports ADD locations_id INT NOT NULL, ADD sports_id INT NOT NULL, DROP sports_id_id, DROP locations_id_id');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');
        
        $this->addSql('ALTER TABLE locations_sports ADD sports_id_id INT DEFAULT NULL, ADD locations_id_id INT DEFAULT NULL, DROP locations_id, DROP sports_id');
        $this->addSql('ALTER TABLE locations_sports ADD CONSTRAINT FK_CA667A2299BEF582 FOREIGN KEY (sports_id_id) REFERENCES sports (id)');
        $this->addSql('ALTER TABLE locations_sports ADD CONSTRAINT FK_CA667A22B613A921 FOREIGN KEY (locations_id_id) REFERENCES locations (id)');
        $this->addSql('CREATE INDEX IDX_CA667A22B613A921 ON locations_sports (locations_id_id)');
        $this->addSql('CREATE INDEX IDX_CA667A2299BEF582 ON locations_sports (sports_id_id)');
    }
}
