<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160220183315 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE company_billing_information (id INT AUTO_INCREMENT NOT NULL, company_id INT DEFAULT NULL, address VARCHAR(255) DEFAULT NULL, number INT DEFAULT NULL, apartment VARCHAR(10) DEFAULT NULL, city VARCHAR(255) DEFAULT NULL, state VARCHAR(255) DEFAULT NULL, zip VARCHAR(10) DEFAULT NULL, country VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_F59048C4979B1AD6 (company_id), INDEX fk_company_id (company_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE company_billing_information ADD CONSTRAINT FK_F59048C4979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE company_billing_information');
    }
}
