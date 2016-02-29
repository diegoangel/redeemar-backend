<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160228182505 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(255) NOT NULL, username_canonical VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, email_canonical VARCHAR(255) NOT NULL, enabled TINYINT(1) NOT NULL, salt VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, last_login DATETIME DEFAULT NULL, locked TINYINT(1) NOT NULL, expired TINYINT(1) NOT NULL, expires_at DATETIME DEFAULT NULL, confirmation_token VARCHAR(255) DEFAULT NULL, password_requested_at DATETIME DEFAULT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', credentials_expired TINYINT(1) NOT NULL, credentials_expire_at DATETIME DEFAULT NULL, name VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D64992FC23A8 (username_canonical), UNIQUE INDEX UNIQ_8D93D649A0D96FBF (email_canonical), UNIQUE INDEX uidx_username (username), UNIQUE INDEX uidx_email (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE validator_user_log (id INT AUTO_INCREMENT NOT NULL, offer_id INT NOT NULL, user_id INT NOT NULL, amount NUMERIC(10, 2) NOT NULL, location_id INT NOT NULL, date DATETIME NOT NULL, INDEX idx_location_id (location_id), INDEX idx_date (date), INDEX idx_offer_id (offer_id), INDEX idx_user_id (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE location (id INT AUTO_INCREMENT NOT NULL, company_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, address VARCHAR(100) NOT NULL, phone VARCHAR(25) NOT NULL, contact VARCHAR(100) NOT NULL, active TINYINT(1) NOT NULL, longitude DOUBLE PRECISION NOT NULL, latitude DOUBLE PRECISION NOT NULL, INDEX fk_company_id (company_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE offer (id INT AUTO_INCREMENT NOT NULL, campaign_id INT DEFAULT NULL, image_path VARCHAR(255) NOT NULL, prepay TINYINT(1) NOT NULL, pay_on_validate TINYINT(1) NOT NULL, fixed_amount NUMERIC(10, 2) NOT NULL, percentage SMALLINT NOT NULL, redeemars_for_validation INT NOT NULL, redeemar_price NUMERIC(10, 2) NOT NULL, redeemars_used INT NOT NULL, active TINYINT(1) NOT NULL, start_date DATETIME DEFAULT NULL, end_date DATETIME DEFAULT NULL, highlighted TINYINT(1) NOT NULL, rating NUMERIC(1, 1) DEFAULT NULL, INDEX fk_campaign_id (campaign_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE company_billing_information (id INT AUTO_INCREMENT NOT NULL, company_id INT DEFAULT NULL, address VARCHAR(255) DEFAULT NULL, number INT DEFAULT NULL, apartment VARCHAR(10) DEFAULT NULL, city VARCHAR(255) DEFAULT NULL, state VARCHAR(255) DEFAULT NULL, zip VARCHAR(10) DEFAULT NULL, country VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_F59048C4979B1AD6 (company_id), INDEX fk_company_id (company_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE invoice (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, reference_number VARCHAR(255) NOT NULL, invoice_date DATETIME NOT NULL, status_id INT NOT NULL, total_amount NUMERIC(10, 2) NOT NULL, INDEX fk_user_id (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE company (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, category_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, website VARCHAR(100) NOT NULL, description TEXT NOT NULL, address VARCHAR(255) NOT NULL, video TEXT NOT NULL, UNIQUE INDEX UNIQ_4FBF094FA76ED395 (user_id), INDEX fk_user_id (user_id), INDEX fk_category_id (category_id), UNIQUE INDEX uidx_name (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE campaign (id INT AUTO_INCREMENT NOT NULL, company_id INT DEFAULT NULL, name VARCHAR(150) NOT NULL, start_date DATETIME NOT NULL, end_date DATETIME NOT NULL, active TINYINT(1) NOT NULL, INDEX IDX_1F1512DD979B1AD6 (company_id), INDEX idx_name (name), INDEX idx_start_date (start_date), INDEX idx_end_date (end_date), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE campaign_location (campaign_id INT NOT NULL, location_id INT NOT NULL, INDEX IDX_6CEE5FB4F639F774 (campaign_id), INDEX IDX_6CEE5FB464D218E (location_id), PRIMARY KEY(campaign_id, location_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(150) NOT NULL, INDEX idx_name (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE validator_user (id INT AUTO_INCREMENT NOT NULL, company_id INT DEFAULT NULL, name VARCHAR(100) NOT NULL, email VARCHAR(100) NOT NULL, phone VARCHAR(50) NOT NULL, ipad VARCHAR(50) NOT NULL, charge VARCHAR(100) NOT NULL, active TINYINT(1) NOT NULL, INDEX fk_company_id (company_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE logo (id INT AUTO_INCREMENT NOT NULL, company_id INT DEFAULT NULL, description VARCHAR(255) NOT NULL, path VARCHAR(255) NOT NULL, INDEX IDX_E48E9A13979B1AD6 (company_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE location ADD CONSTRAINT FK_5E9E89CB979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id)');
        $this->addSql('ALTER TABLE offer ADD CONSTRAINT FK_29D6873EF639F774 FOREIGN KEY (campaign_id) REFERENCES campaign (id)');
        $this->addSql('ALTER TABLE company_billing_information ADD CONSTRAINT FK_F59048C4979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id)');
        $this->addSql('ALTER TABLE invoice ADD CONSTRAINT FK_90651744A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE company ADD CONSTRAINT FK_4FBF094FA76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE company ADD CONSTRAINT FK_4FBF094F12469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE campaign ADD CONSTRAINT FK_1F1512DD979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id)');
        $this->addSql('ALTER TABLE campaign_location ADD CONSTRAINT FK_6CEE5FB4F639F774 FOREIGN KEY (campaign_id) REFERENCES campaign (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE campaign_location ADD CONSTRAINT FK_6CEE5FB464D218E FOREIGN KEY (location_id) REFERENCES location (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE validator_user ADD CONSTRAINT FK_803C64D5979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id)');
        $this->addSql('ALTER TABLE logo ADD CONSTRAINT FK_E48E9A13979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE invoice DROP FOREIGN KEY FK_90651744A76ED395');
        $this->addSql('ALTER TABLE company DROP FOREIGN KEY FK_4FBF094FA76ED395');
        $this->addSql('ALTER TABLE campaign_location DROP FOREIGN KEY FK_6CEE5FB464D218E');
        $this->addSql('ALTER TABLE location DROP FOREIGN KEY FK_5E9E89CB979B1AD6');
        $this->addSql('ALTER TABLE company_billing_information DROP FOREIGN KEY FK_F59048C4979B1AD6');
        $this->addSql('ALTER TABLE campaign DROP FOREIGN KEY FK_1F1512DD979B1AD6');
        $this->addSql('ALTER TABLE validator_user DROP FOREIGN KEY FK_803C64D5979B1AD6');
        $this->addSql('ALTER TABLE logo DROP FOREIGN KEY FK_E48E9A13979B1AD6');
        $this->addSql('ALTER TABLE offer DROP FOREIGN KEY FK_29D6873EF639F774');
        $this->addSql('ALTER TABLE campaign_location DROP FOREIGN KEY FK_6CEE5FB4F639F774');
        $this->addSql('ALTER TABLE company DROP FOREIGN KEY FK_4FBF094F12469DE2');
        $this->addSql('DROP TABLE `user`');
        $this->addSql('DROP TABLE validator_user_log');
        $this->addSql('DROP TABLE location');
        $this->addSql('DROP TABLE offer');
        $this->addSql('DROP TABLE company_billing_information');
        $this->addSql('DROP TABLE invoice');
        $this->addSql('DROP TABLE company');
        $this->addSql('DROP TABLE campaign');
        $this->addSql('DROP TABLE campaign_location');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE validator_user');
        $this->addSql('DROP TABLE logo');
    }
}
