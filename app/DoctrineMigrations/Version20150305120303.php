<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20150305120303 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');
        
        $this->addSql('CREATE TABLE player_sports_skills (id INT AUTO_INCREMENT NOT NULL, skilllevels_id INT DEFAULT NULL, sports_id INT DEFAULT NULL, INDEX IDX_F68EB6F4C3F412B7 (skilllevels_id), INDEX IDX_F68EB6F454BBBFB7 (sports_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE player_sports_skills ADD CONSTRAINT FK_F68EB6F4C3F412B7 FOREIGN KEY (skilllevels_id) REFERENCES skill_levels (id)');
        $this->addSql('ALTER TABLE player_sports_skills ADD CONSTRAINT FK_F68EB6F454BBBFB7 FOREIGN KEY (sports_id) REFERENCES sports (id)');
        $this->addSql('DROP TABLE bubu');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');
        
        $this->addSql('CREATE TABLE bubu (id INT DEFAULT NULL) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('DROP TABLE player_sports_skills');
    }
}
