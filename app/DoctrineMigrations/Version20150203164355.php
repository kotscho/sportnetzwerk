<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20150203164355 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');
        
        $this->addSql('CREATE TABLE locations_sports (id INT AUTO_INCREMENT NOT NULL, locations_id_id INT DEFAULT NULL, sports_id_id INT DEFAULT NULL, INDEX IDX_CA667A22B613A921 (locations_id_id), INDEX IDX_CA667A2299BEF582 (sports_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE locations_sports ADD CONSTRAINT FK_CA667A22B613A921 FOREIGN KEY (locations_id_id) REFERENCES locations (id)');
        $this->addSql('ALTER TABLE locations_sports ADD CONSTRAINT FK_CA667A2299BEF582 FOREIGN KEY (sports_id_id) REFERENCES sports (id)');
        $this->addSql('ALTER TABLE locations DROP FOREIGN KEY FK_17E64ABA54BBBFB7');
        $this->addSql('DROP INDEX IDX_17E64ABA54BBBFB7 ON locations');
        $this->addSql('ALTER TABLE locations DROP sports_id');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');
        
        $this->addSql('DROP TABLE locations_sports');
        $this->addSql('ALTER TABLE locations ADD sports_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE locations ADD CONSTRAINT FK_17E64ABA54BBBFB7 FOREIGN KEY (sports_id) REFERENCES sports (id)');
        $this->addSql('CREATE INDEX IDX_17E64ABA54BBBFB7 ON locations (sports_id)');
    }
}
