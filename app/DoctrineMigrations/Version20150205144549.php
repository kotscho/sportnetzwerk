<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20150205144549 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');
        
        $this->addSql('CREATE TABLE locations_sports (id INT AUTO_INCREMENT NOT NULL, locations_id INT DEFAULT NULL, sports_id INT DEFAULT NULL, INDEX IDX_CA667A22ED775E23 (locations_id), INDEX IDX_CA667A2254BBBFB7 (sports_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE locations_sports ADD CONSTRAINT FK_CA667A22ED775E23 FOREIGN KEY (locations_id) REFERENCES locations (id)');
        $this->addSql('ALTER TABLE locations_sports ADD CONSTRAINT FK_CA667A2254BBBFB7 FOREIGN KEY (sports_id) REFERENCES sports (id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');
        
        $this->addSql('DROP TABLE locations_sports');
    }
}
