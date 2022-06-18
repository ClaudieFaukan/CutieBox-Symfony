<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210218111137 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE parametre_client_user DROP FOREIGN KEY FK_E890C93E1FF211A8');
        $this->addSql('DROP TABLE parametre_client');
        $this->addSql('DROP TABLE parametre_client_user');
        $this->addSql('ALTER TABLE user CHANGE uniq_id uniq_id VARCHAR(255) DEFAULT NULL, CHANGE date_debut date_debut DATE DEFAULT NULL, CHANGE date_fin date_fin DATE DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE parametre_client (id INT AUTO_INCREMENT NOT NULL, templates_photo_id INT DEFAULT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, date_debut DATETIME DEFAULT NULL, date_fin DATETIME DEFAULT NULL, qrcode VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, lien_gallerie VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, autorisation_partage_gallerie TINYINT(1) NOT NULL, INDEX IDX_9DE5192ECC6C9C04 (templates_photo_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE parametre_client_user (parametre_client_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_E890C93E1FF211A8 (parametre_client_id), INDEX IDX_E890C93EA76ED395 (user_id), PRIMARY KEY(parametre_client_id, user_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE parametre_client ADD CONSTRAINT FK_9DE5192ECC6C9C04 FOREIGN KEY (templates_photo_id) REFERENCES templates_photo (id)');
        $this->addSql('ALTER TABLE parametre_client_user ADD CONSTRAINT FK_E890C93E1FF211A8 FOREIGN KEY (parametre_client_id) REFERENCES parametre_client (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE parametre_client_user ADD CONSTRAINT FK_E890C93EA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user CHANGE uniq_id uniq_id INT DEFAULT NULL, CHANGE date_debut date_debut VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE date_fin date_fin VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
