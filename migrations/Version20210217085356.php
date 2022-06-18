<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210217085356 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        //$this->addSql('DROP TABLE parametre_client');
        $this->addSql('ALTER TABLE user ADD templates_photo_id_id INT DEFAULT NULL, ADD date_debut VARCHAR(255) DEFAULT NULL, ADD date_fin VARCHAR(255) DEFAULT NULL, ADD qr_code VARCHAR(255) DEFAULT NULL, ADD lien_gallerie VARCHAR(255) DEFAULT NULL, ADD autorisation_partage_gallerie TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649F8B88545 FOREIGN KEY (templates_photo_id_id) REFERENCES templates_photo (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649F8B88545 ON user (templates_photo_id_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE parametre_client (id INT AUTO_INCREMENT NOT NULL, templates_photo_id INT DEFAULT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, date_debut DATETIME DEFAULT NULL, date_fin DATETIME DEFAULT NULL, qrcode VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, lien_gallerie VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, autorisation_partage_gallerie TINYINT(1) NOT NULL, INDEX IDX_9DE5192ECC6C9C04 (templates_photo_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE parametre_client ADD CONSTRAINT FK_9DE5192ECC6C9C04 FOREIGN KEY (templates_photo_id) REFERENCES templates_photo (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649F8B88545');
        $this->addSql('DROP INDEX UNIQ_8D93D649F8B88545 ON user');
        $this->addSql('ALTER TABLE user DROP templates_photo_id_id, DROP date_debut, DROP date_fin, DROP qr_code, DROP lien_gallerie, DROP autorisation_partage_gallerie');
    }
}
