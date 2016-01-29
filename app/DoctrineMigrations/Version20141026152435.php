<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20141026152435 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');
        
        $this->addSql('ALTER TABLE relate_message_to DROP FOREIGN KEY fk_message_id');
        $this->addSql('DROP TABLE messages');
        $this->addSql('DROP TABLE relate_message_to');
        $this->addSql('ALTER TABLE player DROP FOREIGN KEY fk_gender_id');
        $this->addSql('ALTER TABLE player DROP FOREIGN KEY fk_player_status_id');
        $this->addSql('DROP INDEX username_UNIQUE ON player');
        $this->addSql('DROP INDEX fk_gender_id_idx ON player');
        $this->addSql('DROP INDEX fk_player_status_id_idx ON player');
        $this->addSql('ALTER TABLE player DROP image, CHANGE playerstatus playerstatus INT NOT NULL, CHANGE zipcode zipcode VARCHAR(8) NOT NULL, CHANGE evaluate evaluate VARCHAR(2) NOT NULL, CHANGE activityradius activityradius INT NOT NULL, CHANGE popularity popularity VARCHAR(2) NOT NULL, CHANGE created created INT NOT NULL, CHANGE skills skills VARCHAR(200) NOT NULL');
        $this->addSql('DROP INDEX id_player_status_UNIQUE ON player_status');
        $this->addSql('ALTER TABLE sports DROP FOREIGN KEY fk_sports_category');
        $this->addSql('DROP INDEX id_sports_UNIQUE ON sports');
        $this->addSql('DROP INDEX fk_sports_category_idx ON sports');
        $this->addSql('ALTER TABLE sports CHANGE name name VARCHAR(20) NOT NULL');
        $this->addSql('DROP INDEX id_locations_UNIQUE ON locations');
        $this->addSql('DROP INDEX id_sports_categories_UNIQUE ON sports_categories');
        $this->addSql('ALTER TABLE skill_levels CHANGE name name VARCHAR(20) NOT NULL');
        $this->addSql('ALTER TABLE events DROP FOREIGN KEY fk_events_gender_id');
        $this->addSql('ALTER TABLE events DROP FOREIGN KEY fk_events_locations_id');
        $this->addSql('ALTER TABLE events DROP FOREIGN KEY fk_events_skill_levels_id');
        $this->addSql('ALTER TABLE events DROP FOREIGN KEY fk_events_sports_id');
        $this->addSql('ALTER TABLE events DROP FOREIGN KEY fk_events_status_id');
        $this->addSql('DROP INDEX fk_sports_id_idx ON events');
        $this->addSql('DROP INDEX fk_locations_id_idx ON events');
        $this->addSql('DROP INDEX fk_skill_levels_id_idx ON events');
        $this->addSql('DROP INDEX fk_gender_id_idx ON events');
        $this->addSql('DROP INDEX fk_event_status_id_idx ON events');
        $this->addSql('ALTER TABLE events CHANGE gender gender INT NOT NULL, CHANGE skill_levels_id skill_levels_id INT NOT NULL, CHANGE zip_area zip_area VARCHAR(10) NOT NULL');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');
        
        $this->addSql('CREATE TABLE messages (id INT AUTO_INCREMENT NOT NULL, `from` INT NOT NULL, subject VARCHAR(256) DEFAULT NULL, body LONGTEXT DEFAULT NULL, INDEX fk_from_idx (`from`), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE relate_message_to (message_id INT NOT NULL, user_id INT NOT NULL, sent INT NOT NULL, `read` INT NOT NULL, deleted INT NOT NULL, INDEX fk_relate_to_user_id (user_id), INDEX IDX_D5D297E3537A1329 (message_id), PRIMARY KEY(message_id, user_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE messages ADD CONSTRAINT fk_from FOREIGN KEY (`from`) REFERENCES player (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE relate_message_to ADD CONSTRAINT fk_message_id FOREIGN KEY (message_id) REFERENCES messages (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE relate_message_to ADD CONSTRAINT fk_relate_to_user_id FOREIGN KEY (user_id) REFERENCES player (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE events ADD CONSTRAINT fk_events_gender_id FOREIGN KEY (gender) REFERENCES gender (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE events ADD CONSTRAINT fk_events_locations_id FOREIGN KEY (locations_id) REFERENCES locations (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE events ADD CONSTRAINT fk_events_skill_levels_id FOREIGN KEY (skill_levels_id) REFERENCES skill_levels (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE events ADD CONSTRAINT fk_events_sports_id FOREIGN KEY (sports_id) REFERENCES sports (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE events ADD CONSTRAINT fk_events_status_id FOREIGN KEY (event_status) REFERENCES event_status (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('CREATE INDEX fk_sports_id_idx ON events (sports_id)');
        $this->addSql('CREATE INDEX fk_locations_id_idx ON events (locations_id)');
        $this->addSql('CREATE INDEX fk_skill_levels_id_idx ON events (skill_levels_id)');
        $this->addSql('CREATE INDEX fk_gender_id_idx ON events (gender)');
        $this->addSql('CREATE INDEX fk_event_status_id_idx ON events (event_status)');
        $this->addSql('CREATE UNIQUE INDEX id_locations_UNIQUE ON locations (id)');
        $this->addSql('ALTER TABLE player ADD image VARCHAR(90) NOT NULL, CHANGE zipcode zipcode VARCHAR(8) DEFAULT NULL, CHANGE activityradius activityradius INT DEFAULT NULL, CHANGE created created INT DEFAULT NULL, CHANGE popularity popularity VARCHAR(2) DEFAULT NULL, CHANGE evaluate evaluate VARCHAR(2) DEFAULT NULL');
        $this->addSql('ALTER TABLE player ADD CONSTRAINT fk_gender_id FOREIGN KEY (gender) REFERENCES gender (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE player ADD CONSTRAINT fk_player_status_id FOREIGN KEY (playerstatus) REFERENCES player_status (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('CREATE UNIQUE INDEX username_UNIQUE ON player (username)');
        $this->addSql('CREATE INDEX fk_gender_id_idx ON player (gender)');
        $this->addSql('CREATE INDEX fk_player_status_id_idx ON player (playerstatus)');
        $this->addSql('CREATE UNIQUE INDEX id_player_status_UNIQUE ON player_status (id)');
        $this->addSql('ALTER TABLE skill_levels CHANGE name name VARCHAR(45) NOT NULL');
        $this->addSql('ALTER TABLE sports CHANGE name name VARCHAR(45) NOT NULL');
        $this->addSql('ALTER TABLE sports ADD CONSTRAINT fk_sports_category FOREIGN KEY (sports_category) REFERENCES sports_categories (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('CREATE UNIQUE INDEX id_sports_UNIQUE ON sports (id)');
        $this->addSql('CREATE INDEX fk_sports_category_idx ON sports (sports_category)');
        $this->addSql('CREATE UNIQUE INDEX id_sports_categories_UNIQUE ON sports_categories (id)');
    }
}
