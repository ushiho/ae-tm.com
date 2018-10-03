<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181003113117 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE allocate (id INT AUTO_INCREMENT NOT NULL, supplier_id INT NOT NULL, car_id INT NOT NULL, start_date DATE NOT NULL, end_date DATE NOT NULL, period SMALLINT NOT NULL, price NUMERIC(50, 2) NOT NULL, with_driver TINYINT(1) NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_472CA6BF2ADD6D8C (supplier_id), UNIQUE INDEX UNIQ_472CA6BFC3C6F69F (car_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE payment (id INT AUTO_INCREMENT NOT NULL, mission_id INT NOT NULL, total_amount_to_pay NUMERIC(50, 2) NOT NULL, total_amount_paid NUMERIC(50, 2) NOT NULL, remaining_amount NUMERIC(50, 2) NOT NULL, created_at DATETIME NOT NULL, UNIQUE INDEX UNIQ_6D28840DBE6CAE90 (mission_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE department (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, phone_number VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE projet (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, end_date DATE NOT NULL, start_date DATE NOT NULL, budget NUMERIC(50, 2) NOT NULL, owner VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE payment_driver (id INT AUTO_INCREMENT NOT NULL, driver_id INT NOT NULL, payment_id INT DEFAULT NULL, amount NUMERIC(50, 2) NOT NULL, period SMALLINT NOT NULL, date_payment DATE NOT NULL, total_amount NUMERIC(50, 2) NOT NULL, total_amount_paid NUMERIC(50, 2) NOT NULL, created_at DATETIME NOT NULL, UNIQUE INDEX UNIQ_345EE74FC3423909 (driver_id), INDEX IDX_345EE74F4C3A3BB (payment_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE driver (id INT AUTO_INCREMENT NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, cin VARCHAR(30) NOT NULL, address VARCHAR(255) DEFAULT NULL, birth_day DATE DEFAULT NULL, phone_number VARCHAR(255) DEFAULT NULL, license_number VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE supplier (id INT AUTO_INCREMENT NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, email VARCHAR(255) DEFAULT NULL, phone_number VARCHAR(255) DEFAULT NULL, address VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE payment_supplier (id INT AUTO_INCREMENT NOT NULL, supplier_id INT NOT NULL, car_id INT NOT NULL, payment_id INT DEFAULT NULL, date_payment DATE NOT NULL, price NUMERIC(50, 2) NOT NULL, period SMALLINT NOT NULL, total_amount_paid NUMERIC(50, 2) NOT NULL, total_amount_to_pay NUMERIC(50, 2) NOT NULL, remaining_amount NUMERIC(50, 2) NOT NULL, created_at DATETIME NOT NULL, UNIQUE INDEX UNIQ_DBEC2E162ADD6D8C (supplier_id), UNIQUE INDEX UNIQ_DBEC2E16C3C6F69F (car_id), INDEX IDX_DBEC2E164C3A3BB (payment_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mission (id INT AUTO_INCREMENT NOT NULL, driver_id INT NOT NULL, department_id INT NOT NULL, allocate_id INT NOT NULL, start_date DATE NOT NULL, end_date DATE NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_9067F23CC3423909 (driver_id), UNIQUE INDEX UNIQ_9067F23CAE80F5DF (department_id), UNIQUE INDEX UNIQ_9067F23C62C60BD6 (allocate_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, phone_number VARCHAR(255) DEFAULT NULL, role SMALLINT NOT NULL, gender SMALLINT NOT NULL, country VARCHAR(255) DEFAULT NULL, birth_day DATE DEFAULT NULL, created_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE car (id INT AUTO_INCREMENT NOT NULL, car_reg VARCHAR(255) NOT NULL, mileage VARCHAR(255) DEFAULT NULL, type VARCHAR(255) DEFAULT NULL, brand VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE allocate ADD CONSTRAINT FK_472CA6BF2ADD6D8C FOREIGN KEY (supplier_id) REFERENCES supplier (id)');
        $this->addSql('ALTER TABLE allocate ADD CONSTRAINT FK_472CA6BFC3C6F69F FOREIGN KEY (car_id) REFERENCES car (id)');
        $this->addSql('ALTER TABLE payment ADD CONSTRAINT FK_6D28840DBE6CAE90 FOREIGN KEY (mission_id) REFERENCES mission (id)');
        $this->addSql('ALTER TABLE payment_driver ADD CONSTRAINT FK_345EE74FC3423909 FOREIGN KEY (driver_id) REFERENCES driver (id)');
        $this->addSql('ALTER TABLE payment_driver ADD CONSTRAINT FK_345EE74F4C3A3BB FOREIGN KEY (payment_id) REFERENCES payment (id)');
        $this->addSql('ALTER TABLE payment_supplier ADD CONSTRAINT FK_DBEC2E162ADD6D8C FOREIGN KEY (supplier_id) REFERENCES supplier (id)');
        $this->addSql('ALTER TABLE payment_supplier ADD CONSTRAINT FK_DBEC2E16C3C6F69F FOREIGN KEY (car_id) REFERENCES car (id)');
        $this->addSql('ALTER TABLE payment_supplier ADD CONSTRAINT FK_DBEC2E164C3A3BB FOREIGN KEY (payment_id) REFERENCES payment (id)');
        $this->addSql('ALTER TABLE mission ADD CONSTRAINT FK_9067F23CC3423909 FOREIGN KEY (driver_id) REFERENCES driver (id)');
        $this->addSql('ALTER TABLE mission ADD CONSTRAINT FK_9067F23CAE80F5DF FOREIGN KEY (department_id) REFERENCES department (id)');
        $this->addSql('ALTER TABLE mission ADD CONSTRAINT FK_9067F23C62C60BD6 FOREIGN KEY (allocate_id) REFERENCES allocate (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE mission DROP FOREIGN KEY FK_9067F23C62C60BD6');
        $this->addSql('ALTER TABLE payment_driver DROP FOREIGN KEY FK_345EE74F4C3A3BB');
        $this->addSql('ALTER TABLE payment_supplier DROP FOREIGN KEY FK_DBEC2E164C3A3BB');
        $this->addSql('ALTER TABLE mission DROP FOREIGN KEY FK_9067F23CAE80F5DF');
        $this->addSql('ALTER TABLE payment_driver DROP FOREIGN KEY FK_345EE74FC3423909');
        $this->addSql('ALTER TABLE mission DROP FOREIGN KEY FK_9067F23CC3423909');
        $this->addSql('ALTER TABLE allocate DROP FOREIGN KEY FK_472CA6BF2ADD6D8C');
        $this->addSql('ALTER TABLE payment_supplier DROP FOREIGN KEY FK_DBEC2E162ADD6D8C');
        $this->addSql('ALTER TABLE payment DROP FOREIGN KEY FK_6D28840DBE6CAE90');
        $this->addSql('ALTER TABLE allocate DROP FOREIGN KEY FK_472CA6BFC3C6F69F');
        $this->addSql('ALTER TABLE payment_supplier DROP FOREIGN KEY FK_DBEC2E16C3C6F69F');
        $this->addSql('DROP TABLE allocate');
        $this->addSql('DROP TABLE payment');
        $this->addSql('DROP TABLE department');
        $this->addSql('DROP TABLE projet');
        $this->addSql('DROP TABLE payment_driver');
        $this->addSql('DROP TABLE driver');
        $this->addSql('DROP TABLE supplier');
        $this->addSql('DROP TABLE payment_supplier');
        $this->addSql('DROP TABLE mission');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE car');
    }
}
