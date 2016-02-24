<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160222015236 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user DROP FOREIGN KEY user_ibfk_1');
        $this->addSql('DROP TABLE role');
        $this->addSql('DROP INDEX idx_start_date ON offer');
        $this->addSql('DROP INDEX idx_end_date ON offer');
        $this->addSql('ALTER TABLE offer DROP start_date, DROP end_date');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_4FBF094FA76ED395 ON company (user_id)');
        $this->addSql('ALTER TABLE campaign ADD start_date DATETIME NOT NULL, ADD end_date DATETIME NOT NULL');
        $this->addSql('CREATE INDEX idx_start_date ON campaign (start_date)');
        $this->addSql('CREATE INDEX idx_end_date ON campaign (end_date)');
        $this->addSql('DROP INDEX fk_role_id ON user');
        $this->addSql('ALTER TABLE user DROP role_id');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE role (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(20) NOT NULL COLLATE utf8_general_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('DROP INDEX idx_start_date ON campaign');
        $this->addSql('DROP INDEX idx_end_date ON campaign');
        $this->addSql('ALTER TABLE campaign DROP start_date, DROP end_date');
        $this->addSql('DROP INDEX UNIQ_4FBF094FA76ED395 ON company');
        $this->addSql('ALTER TABLE offer ADD start_date DATETIME NOT NULL, ADD end_date DATETIME NOT NULL');
        $this->addSql('CREATE INDEX idx_start_date ON offer (start_date)');
        $this->addSql('CREATE INDEX idx_end_date ON offer (end_date)');
        $this->addSql('ALTER TABLE `user` ADD role_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE `user` ADD CONSTRAINT user_ibfk_1 FOREIGN KEY (role_id) REFERENCES role (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX fk_role_id ON `user` (role_id)');
    }
}
