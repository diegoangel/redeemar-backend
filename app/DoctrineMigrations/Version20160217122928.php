<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160217122928 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP INDEX idx_campaign_name ON offer');
        $this->addSql('ALTER TABLE offer ADD campaign_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE offer ADD CONSTRAINT FK_29D6873EF639F774 FOREIGN KEY (campaign_id) REFERENCES campaign (id)');
        $this->addSql('CREATE INDEX fk_campaign_id ON offer (campaign_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE offer DROP FOREIGN KEY FK_29D6873EF639F774');
        $this->addSql('DROP INDEX fk_campaign_id ON offer');
        $this->addSql('ALTER TABLE offer DROP campaign_id');
        $this->addSql('CREATE INDEX idx_campaign_name ON offer (campaign_name)');
    }
}
