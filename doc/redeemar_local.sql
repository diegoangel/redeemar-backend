CREATE TABLE validator_user_log (id INT AUTO_INCREMENT NOT NULL, offer_id INT NOT NULL, user_id INT NOT NULL, amount NUMERIC(10, 2) NOT NULL, location_id INT NOT NULL, date DATETIME NOT NULL, INDEX idx_location_id (location_id), INDEX idx_date (date), INDEX idx_offer_id (offer_id), INDEX idx_user_id (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;
CREATE TABLE location (id INT AUTO_INCREMENT NOT NULL, company_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, address VARCHAR(100) NOT NULL, phone VARCHAR(25) NOT NULL, contact VARCHAR(100) NOT NULL, active TINYINT(1) NOT NULL, longitude DOUBLE PRECISION NOT NULL, latitude DOUBLE PRECISION NOT NULL, created DATETIME NOT NULL, modified DATETIME NOT NULL, INDEX fk_company_id (company_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;
CREATE TABLE offer (id INT AUTO_INCREMENT NOT NULL, campaign_name VARCHAR(255) NOT NULL, start_date DATETIME NOT NULL, end_date DATETIME NOT NULL, image_path VARCHAR(255) NOT NULL, prepay TINYINT(1) NOT NULL, pay_on_validate TINYINT(1) NOT NULL, fixed_amount NUMERIC(10, 2) NOT NULL, percentage SMALLINT NOT NULL, redeemars_for_validation INT NOT NULL, redeemar_price NUMERIC(10, 2) NOT NULL, redeemars_used INT NOT NULL, INDEX idx_campaign_name (campaign_name), INDEX idx_start_date (start_date), INDEX idx_end_date (end_date), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;
CREATE TABLE invoice (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, reference_number VARCHAR(255) NOT NULL, invoice_date DATETIME NOT NULL, status_id INT NOT NULL, total_amount NUMERIC(10, 2) NOT NULL, INDEX fk_user_id (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;
CREATE TABLE role (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(20) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;
CREATE TABLE company (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, category_id INT DEFAULT NULL, logo_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, website VARCHAR(100) NOT NULL, description TEXT NOT NULL, address VARCHAR(255) NOT NULL, video TEXT NOT NULL, INDEX fk_user_id (user_id), INDEX fk_category_id (category_id), INDEX fk_logo_id (logo_id), UNIQUE INDEX uidx_name (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;
CREATE TABLE campaign (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(150) NOT NULL, INDEX idx_name (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;
CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(150) NOT NULL, INDEX idx_name (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;
CREATE TABLE validator_user (id INT AUTO_INCREMENT NOT NULL, company_id INT DEFAULT NULL, name VARCHAR(100) NOT NULL, email VARCHAR(100) NOT NULL, phone VARCHAR(50) NOT NULL, ipad VARCHAR(50) NOT NULL, charge VARCHAR(100) NOT NULL, active TINYINT(1) NOT NULL, INDEX fk_company_id (company_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;
CREATE TABLE logo (id INT AUTO_INCREMENT NOT NULL, company_name VARCHAR(100) NOT NULL, path VARCHAR(255) NOT NULL, UNIQUE INDEX uidx_company_name (company_name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;
CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, role_id INT DEFAULT NULL, username VARCHAR(255) NOT NULL, username_canonical VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, email_canonical VARCHAR(255) NOT NULL, enabled TINYINT(1) NOT NULL, salt VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, last_login DATETIME DEFAULT NULL, locked TINYINT(1) NOT NULL, expired TINYINT(1) NOT NULL, expires_at DATETIME DEFAULT NULL, confirmation_token VARCHAR(255) DEFAULT NULL, password_requested_at DATETIME DEFAULT NULL, roles LONGTEXT NOT NULL COMMENT '(DC2Type:array)', credentials_expired TINYINT(1) NOT NULL, credentials_expire_at DATETIME DEFAULT NULL, name VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D64992FC23A8 (username_canonical), UNIQUE INDEX UNIQ_8D93D649A0D96FBF (email_canonical), INDEX fk_role_id (role_id), UNIQUE INDEX uidx_username (username), UNIQUE INDEX uidx_email (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;
ALTER TABLE location ADD CONSTRAINT FK_5E9E89CB979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id);
ALTER TABLE invoice ADD CONSTRAINT FK_90651744A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id);
ALTER TABLE company ADD CONSTRAINT FK_4FBF094FA76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id);
ALTER TABLE company ADD CONSTRAINT FK_4FBF094F12469DE2 FOREIGN KEY (category_id) REFERENCES category (id);
ALTER TABLE company ADD CONSTRAINT FK_4FBF094FF98F144A FOREIGN KEY (logo_id) REFERENCES logo (id);
ALTER TABLE validator_user ADD CONSTRAINT FK_803C64D5979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id);
ALTER TABLE `user` ADD CONSTRAINT FK_8D93D649D60322AC FOREIGN KEY (role_id) REFERENCES role (id);
