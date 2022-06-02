<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220602153330 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE tblclient (id INT AUTO_INCREMENT NOT NULL, client_login VARCHAR(180) NOT NULL, roles JSON NOT NULL, client_pass VARCHAR(255) NOT NULL, client_txt_lg1 LONGTEXT DEFAULT NULL, client_date DATE NOT NULL, client_img VARCHAR(255) NOT NULL, client_fichier VARCHAR(255) NOT NULL, client_date_on DATE NOT NULL, client_date_off DATE NOT NULL, client_nom VARCHAR(255) NOT NULL, client_prenom VARCHAR(255) NOT NULL, client_titre VARCHAR(255) NOT NULL, client_adresse VARCHAR(255) NOT NULL, client_adresse2 VARCHAR(255) DEFAULT NULL, client_cp VARCHAR(255) NOT NULL, client_ville VARCHAR(255) NOT NULL, client_pays VARCHAR(255) NOT NULL, client_mail VARCHAR(255) NOT NULL, client_tel VARCHAR(255) NOT NULL, client_tel2 VARCHAR(255) DEFAULT NULL, client_pseudo VARCHAR(255) NOT NULL, client_token VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_E318A2D696557A7 (client_login), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tbltranscriptionupload (id INT AUTO_INCREMENT NOT NULL, tblclient_id INT NOT NULL, itm_titre_lg1 VARCHAR(255) NOT NULL, itm_txt_client_lg1 LONGTEXT DEFAULT NULL, itm_date DATE NOT NULL, itm_type VARCHAR(255) NOT NULL, itm_taille INT NOT NULL, itm_duree INT DEFAULT NULL, itm_atranscrire TINYINT(1) NOT NULL, itm_deadline_requise DATE DEFAULT NULL, itm_fichier VARCHAR(255) NOT NULL, INDEX IDX_D958CEF56018CA6C (tblclient_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE tbltranscriptionupload ADD CONSTRAINT FK_D958CEF56018CA6C FOREIGN KEY (tblclient_id) REFERENCES tblclient (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tbltranscriptionupload DROP FOREIGN KEY FK_D958CEF56018CA6C');
        $this->addSql('DROP TABLE tblclient');
        $this->addSql('DROP TABLE tbltranscriptionupload');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
