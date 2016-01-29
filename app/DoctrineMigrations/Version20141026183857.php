<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20141026183857 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');
        
        $this->addSql('ALTER TABLE sports CHANGE sports_category sports_category INT DEFAULT NULL');
        $this->addSql('ALTER TABLE sports ADD CONSTRAINT FK_73C9F91C566F4792 FOREIGN KEY (sports_category) REFERENCES sports_categories (id)');
        $this->addSql('CREATE INDEX IDX_73C9F91C566F4792 ON sports (sports_category)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');
        
        $this->addSql('ALTER TABLE sports DROP FOREIGN KEY FK_73C9F91C566F4792');
        $this->addSql('DROP INDEX IDX_73C9F91C566F4792 ON sports');
        $this->addSql('ALTER TABLE sports CHANGE sports_category sports_category INT NOT NULL');
    }
}
