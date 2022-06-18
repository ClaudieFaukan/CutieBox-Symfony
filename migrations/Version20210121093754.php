<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210121093754 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE parametre_client_user (parametre_client_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_E890C93E1FF211A8 (parametre_client_id), INDEX IDX_E890C93EA76ED395 (user_id), PRIMARY KEY(parametre_client_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE parametre_client_user ADD CONSTRAINT FK_E890C93E1FF211A8 FOREIGN KEY (parametre_client_id) REFERENCES parametre_client (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE parametre_client_user ADD CONSTRAINT FK_E890C93EA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE imprimante ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE imprimante ADD CONSTRAINT FK_4DF2C3AAA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_4DF2C3AAA76ED395 ON imprimante (user_id)');
        $this->addSql('ALTER TABLE parametre_client ADD templates_photo_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE parametre_client ADD CONSTRAINT FK_9DE5192ECC6C9C04 FOREIGN KEY (templates_photo_id) REFERENCES templates_photo (id)');
        $this->addSql('CREATE INDEX IDX_9DE5192ECC6C9C04 ON parametre_client (templates_photo_id)');
        $this->addSql('ALTER TABLE prospect ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE prospect ADD CONSTRAINT FK_C9CE8C7DA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_C9CE8C7DA76ED395 ON prospect (user_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE parametre_client_user');
        $this->addSql('ALTER TABLE imprimante DROP FOREIGN KEY FK_4DF2C3AAA76ED395');
        $this->addSql('DROP INDEX IDX_4DF2C3AAA76ED395 ON imprimante');
        $this->addSql('ALTER TABLE imprimante DROP user_id');
        $this->addSql('ALTER TABLE parametre_client DROP FOREIGN KEY FK_9DE5192ECC6C9C04');
        $this->addSql('DROP INDEX IDX_9DE5192ECC6C9C04 ON parametre_client');
        $this->addSql('ALTER TABLE parametre_client DROP templates_photo_id');
        $this->addSql('ALTER TABLE prospect DROP FOREIGN KEY FK_C9CE8C7DA76ED395');
        $this->addSql('DROP INDEX IDX_C9CE8C7DA76ED395 ON prospect');
        $this->addSql('ALTER TABLE prospect DROP user_id');
    }
}
