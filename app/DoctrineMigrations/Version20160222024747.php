<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160222024747 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE campaign_location (campaign_id INT NOT NULL, location_id INT NOT NULL, INDEX IDX_6CEE5FB4F639F774 (campaign_id), INDEX IDX_6CEE5FB464D218E (location_id), PRIMARY KEY(campaign_id, location_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE campaign_location ADD CONSTRAINT FK_6CEE5FB4F639F774 FOREIGN KEY (campaign_id) REFERENCES campaign (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE campaign_location ADD CONSTRAINT FK_6CEE5FB464D218E FOREIGN KEY (location_id) REFERENCES location (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE campaign ADD active TINYINT(1) NOT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE campaign_location');
        $this->addSql('ALTER TABLE campaign DROP active');
    }
}
