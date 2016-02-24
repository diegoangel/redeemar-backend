<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160220214004 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE company DROP FOREIGN KEY company_ibfk_4');
        $this->addSql('DROP INDEX fk_logo_id ON company');
        $this->addSql('ALTER TABLE company DROP logo_id');
        $this->addSql('ALTER TABLE campaign ADD company_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE campaign ADD CONSTRAINT FK_1F1512DD979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id)');
        $this->addSql('CREATE INDEX IDX_1F1512DD979B1AD6 ON campaign (company_id)');
        $this->addSql('DROP INDEX uidx_company_name ON logo');
        $this->addSql('ALTER TABLE logo ADD company_id INT DEFAULT NULL, ADD description VARCHAR(255) NOT NULL, DROP company_name');
        $this->addSql('ALTER TABLE logo ADD CONSTRAINT FK_E48E9A13979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id)');
        $this->addSql('CREATE INDEX IDX_E48E9A13979B1AD6 ON logo (company_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE campaign DROP FOREIGN KEY FK_1F1512DD979B1AD6');
        $this->addSql('DROP INDEX IDX_1F1512DD979B1AD6 ON campaign');
        $this->addSql('ALTER TABLE campaign DROP company_id');
        $this->addSql('ALTER TABLE company ADD logo_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE company ADD CONSTRAINT company_ibfk_4 FOREIGN KEY (logo_id) REFERENCES logo (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX fk_logo_id ON company (logo_id)');
        $this->addSql('ALTER TABLE logo DROP FOREIGN KEY FK_E48E9A13979B1AD6');
        $this->addSql('DROP INDEX IDX_E48E9A13979B1AD6 ON logo');
        $this->addSql('ALTER TABLE logo ADD company_name VARCHAR(100) NOT NULL COLLATE utf8_general_ci, DROP company_id, DROP description');
        $this->addSql('CREATE UNIQUE INDEX uidx_company_name ON logo (company_name)');
    }
}
