<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210120094404 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE image (id INT AUTO_INCREMENT NOT NULL, image_path VARCHAR(255) NOT NULL, image_date DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE imprimante (id INT AUTO_INCREMENT NOT NULL, impri_name VARCHAR(255) NOT NULL, impri_serial_number VARCHAR(255) NOT NULL, impri_status VARCHAR(255) DEFAULT NULL, impri_feed_back VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE parametre_client (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, date_debut DATETIME DEFAULT NULL, date_fin DATETIME DEFAULT NULL, qrcode VARCHAR(255) DEFAULT NULL, lien_gallerie VARCHAR(255) DEFAULT NULL, autorisation_partage_gallerie TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE prospect (id INT AUTO_INCREMENT NOT NULL, prospect_mail VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE templates_photo (id INT AUTO_INCREMENT NOT NULL, portrait1p VARCHAR(255) DEFAULT NULL, portrait4p VARCHAR(255) DEFAULT NULL, centrer1p VARCHAR(255) DEFAULT NULL, centrer4p VARCHAR(255) DEFAULT NULL, paysage1p VARCHAR(255) DEFAULT NULL, paysage4p VARCHAR(255) DEFAULT NULL, strip VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, user_name VARCHAR(255) NOT NULL, user_password VARCHAR(255) DEFAULT NULL, user_mail VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE image');
        $this->addSql('DROP TABLE imprimante');
        $this->addSql('DROP TABLE parametre_client');
        $this->addSql('DROP TABLE prospect');
        $this->addSql('DROP TABLE templates_photo');
        $this->addSql('DROP TABLE user');
    }
}
